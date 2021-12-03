<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use App\Author;
use App\ProductCategory;
use App\ProductTag;
use App\Book;
use App\Manual;
use App\Level;
use App\Role;
use App\License;
use App\ProductDetail;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $categories = ProductCategory::with('parentCategory.parentCategory')
        //     ->whereHas('parentCategory.parentCategory')
        //     ->get();
        $categories = ProductCategory::whereNull('category_id')
            ->with('childCategories')
            ->orderBy('sort_order', 'ASC')
            ->get();
        // dd($categories);
        $tags = ProductTag::all()->pluck('name', 'id');

        $authors = Author::all()->pluck('name', 'id');

        $licenses = License::all();

        // $books = Book::all()->pluck('title', 'id');

        // $levels = Level::all()->pluck('title', 'id');
        
        $roles = Role::all()->except(1)->pluck('title', 'id');
        
        return view('admin.products.create', compact('categories', 'authors', 'roles','tags','licenses'));
    }

    public function store(StoreProductRequest $request)
    {   
        
        // dd($request->input('licenses',[]));
        // dd( collect($request['licenses'])->map(function ($i) {
        //     return ['price' => $i];
        // })
    // );
        // dd($request->input('categories', []));
        if ($request->book) {
            $book = Book::create([
                'title' => $request->name,
            ]);
            $filename = md5($request->file('book')->getClientOriginalName()) . '.' . $request->file('book')->getClientOriginalExtension();
            $book->addMediaFromRequest('book')->setFileName($filename)->toMediaCollection('book');
            // $book->addMediaFromRequest('book')->toMediaCollection('book');
        }

        if ($request->manual) {
            $manual = Manual::create([
                'title' => $request->name,
            ]);
            $filename = md5($request->file('manual')->getClientOriginalName()) . '.' . $request->file('manual')->getClientOriginalExtension();
            $manual->addMediaFromRequest('manual')->setFileName($filename)->toMediaCollection('manual');
            // $manual->addMediaFromRequest('manual')->toMediaCollection('manual');
        }

        $data = [
            'name'          =>$request->name,
            'framework'   =>$request->framework,
            'published_date'         =>$request->published_date,
            'slug'          =>$request->slug,
            'compatible_browsers' => $request->compatible_browsers,
            'software_version' => $request->software_version,
            // 'book_id'       =>$book->id, 
            // 'manual_id'       =>$manual->id, 
            // 'level_id'      =>$request->level_id,
            // 'featured'      =>$request->featured,
        ];

        $product = Product::create($data);
        $product->categories()->sync($request->input('categories', []));
        $product->tags()->sync($request->input('tags', []));
        $product->authors()->sync($request->input('authors', []));
        $product->roles()->sync($request->input('availToRole', []));
        // $product->licenses()->sync($request->input('licenses',[]));
        // $product->licenses()->attach([$request['license_id'][0] => ['price' => $request['price']]]);
        // dd(collect($request->input('licenses',[])));
        
        // $licenses = collect($request->input('licenses',[]))
        // ->map(function($license){
           
        //     return ['price'=>$license];
        // });
        // // dd($licenses);
        // $product->licenses()->sync($licenses);       
        $product->licenses()->sync($this->mapLicenses($request['licenses']));

        // $product->book_id = $request->book_id;
        
        // dd($product->licenses());
       


        if ($request->input('photo', false)) {
            
            $product->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            
        }

        foreach ($request->input('resource', []) as $file) {
            $ext = array_map('strrev', explode('.', strrev($file)));
            $encrypt_filename = md5($file). '.' . $ext[0];
            
            $product->addMedia(storage_path('tmp/uploads/' . $file))->setFileName($encrypt_filename)->toMediaCollection('resource');
            // $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('resource');
        }
// dd($request->input('ck-media', false));
       
        // dd($product);

        $details = [
            'overview' => $request->overview,
            'features' => $request->features,
            'requirements' => $request->requirements,
            'instructions' => $request->instructions,
            'product_id' => $product->id,  
        ];

        $product_details = ProductDetail::create($details);
        // if ($media = $request->input('ck-media', false)) {
        //     Media::whereIn('id', $media)->update(['model_id' => $product_details->id]);
        //     dd($model_id);
        // }
        return redirect()->route('admin.products.index');

    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $categories = ProductCategory::with('parentCategory.parentCategory')
        //     ->whereHas('parentCategory.parentCategory')
        //     ->get();
        $categories = ProductCategory::whereNull('category_id')
            ->with('childCategories')
            ->orderBy('sort_order', 'ASC')
            ->get();

        // $tags = ProductTag::whereHas('levels', function ($query) use ($product) {
        //     $query->where('level_id', $product->level_id);
        // })
        // ->pluck('name', 'id');
        $tags = ProductTag::all()->pluck('name', 'id');

        $authors = Author::all()->pluck('name', 'id');

        // $licenses = License::all();
        
        $licenses = license::get()->map(function($license) use ($product) {
            $license->value = data_get($product->licenses->firstWhere('id', $license->id), 'pivot.price') ?? null;
            return $license;
        });
        // dd($licenses);
        // $product_details = ProductDetail::all()->pluck('name', 'id');
        // dd($product->productdetail()->exists());
        // dd($product->productdetail()->photo);
        

        // $books = Book::all()->pluck('title', 'id'); 

        // $levels = Level::all()->pluck('title', 'id');

        $product->load('categories', 'tags','authors', 'roles','licenses');
    // dd($product->licenses[0]->pivot->price);
        $roles = Role::all()->except(1)->pluck('title', 'id');

        
        return view('admin.products.edit', compact('categories', 'tags', 'product', 'authors', 'roles','licenses'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        // dd($request->input('product_licenses',[]));
        $book = null;
        $manual = null;
        if ($request->book) {
            if($product->book) {
                if($product->book->getFirstMedia('book')){
                    $product->book->getFirstMedia('book')->delete();
                }
            }

            $book = Book::updateOrCreate([
                    'id' => $product->book_id,
                ],[
                    'title' => $request->name,
                ]);
            
            $filename = md5($request->file('book')->getClientOriginalName()) . '.' . $request->file('book')->getClientOriginalExtension();
            $book->addMediaFromRequest('book')->setFileName($filename)->toMediaCollection('book');
        }

        if ($request->manual) {
            if($product->manual) {
                if($product->manual->getFirstMedia('manual')){
                    $product->manual->getFirstMedia('manual')->delete();
                }
            }

            $manual = Manual::updateOrCreate([
                    'id' => $product->manual_id,
                ],[
                    'title' => $request->name,
                ]);
            
            $filename = md5($request->file('manual')->getClientOriginalName()) . '.' . $request->file('manual')->getClientOriginalExtension();
            $manual->addMediaFromRequest('manual')->setFileName($filename)->toMediaCollection('manual');
        }

        $data = [
            'name'          =>$request->name,
            'framework'   =>$request->framework,
            'published_date'         =>$request->published_date,
            'slug'          =>$request->slug,
            'compatible_browsers' => $request->compatible_browsers,
            'software_version' => $request->software_version,
            
        ];

        $product->update($data);
        $product->categories()->sync($request->input('categories', []));
        $product->tags()->sync($request->input('tags', []));
        $product->authors()->sync($request->input('authors', []));
        // $product->licenses()->syn($request->input('licenses',[]));
        $product->roles()->sync($request->input('availToRole', []));
        $product->licenses()->sync($this->mapLicenses($request['licenses']));
        // $product->licenses()->attach($this->mapProductLicenses($request['product_licenses']));

        
        if ($request->input('photo', false)) {
            if (!$product->photo || $request->input('photo') !== $product->photo->file_name) {
                $product->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }

        } elseif ($product->photo) {
            $product->photo->delete();
        }
        
        if (count($product->resource) > 0) {
            foreach ($product->resource as $media) {
                if (!in_array($media->file_name, $request->input('resource', []))) {
                    $media->delete();
                }
            }
        }

        $media = $product->resource->pluck('file_name')->toArray();
        
        foreach ($request->input('resource', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $ext = array_map('strrev', explode('.', strrev($file)));
                $encrypt_filename = md5($file). '.' . $ext[0];
                
                $product->addMedia(storage_path('tmp/uploads/' . $file))->setFileName($encrypt_filename)->toMediaCollection('resource');
            }
        }
// dd($product);

        $details = [
            'overview' => $request->overview,
            'features' => $request->features,
            'requirements' => $request->requirements,
            'instructions' => $request->instructions,
            'product_id' => $product->id,  
        ];

        $product->productdetail->update($details);

        return redirect()->route('admin.products.index');

    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('categories', 'tags', 'authors','licenses');

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();

    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductDetail();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');
        
        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }


    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);

    }

    
    public function cart()
    {
        return view('cart');
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        //   dd($product);
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->photo->file_name
            ];
        }
        //   dd($cart);
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    
    private function mapLicenses($licenses)
    {
    return collect($licenses)->map(function ($i) {
        return ['price' => $i];
    });
    }

    // private function mapProductLicenses($product_licenses)
    // {
    // return collect($product_licenses)->map(function ($i) {
    //     return ['price' => $i];
    // });
    // }

}
