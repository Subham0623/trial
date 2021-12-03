<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductCategoryRequest;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\ProductCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use DB;

class ProductCategoryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('product_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategories = ProductCategory::whereNull('category_id')
            ->with('childCategories.childCategories')
            ->get();

        return view('admin.productCategories.index', compact('productCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::whereNull('category_id')
            ->with('childCategories')
            ->orderBy('sort_order', 'ASC')
            ->get();
        // dd($categories);
        return view('admin.productCategories.create', compact('categories'));
    }

    public function store(StoreProductCategoryRequest $request)
    {
        // dd($request->all());
        $productCategory = ProductCategory::create($request->all());

        if ($request->input('photo', false)) {
            $productCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $productCategory->id]);
        }

        return redirect()->route('admin.product-categories.index');

    }

    public function edit(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::whereNull('category_id')
            ->with('childCategories')
            ->orderBy('sort_order', 'ASC')
            ->get();

        $productCategory->load('parentCategory');

        return view('admin.productCategories.edit', compact('categories', 'productCategory'));
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->all());

        if ($request->input('photo', false)) {
            if (!$productCategory->photo || $request->input('photo') !== $productCategory->photo->file_name) {
                $productCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }

        } elseif ($productCategory->photo) {
            $productCategory->photo->delete();
        }

        return redirect()->route('admin.product-categories.index');

    }

    public function show(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategory->load('parentCategory');

        return view('admin.productCategories.show', compact('productCategory'));
    }

    public function destroy(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategory->delete();

        return back();

    }

    public function massDestroy(MassDestroyProductCategoryRequest $request)
    {
        ProductCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_category_create') && Gate::denies('product_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(ProductCategory::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);

    }

    public function sortList(Request $request)
    {
        $info = [
            'categories' => ProductCategory::whereNull('category_id')->orderBy('sort_order', 'ASC')->get(),
        ];
        // dd($info);
        return view('admin.productCategories.sort', $info);
    }

    public function saveNestedCategories(Request $request)
    {
        // $arr = [7,7,7,9,9];
        // dd(array_shift($arr));
        $json = $request->nested_category_array;
        // dd($json);
        $decoded_json = json_decode($json, TRUE);
        // dd($decoded_json);

        $simplified_list = [];
        $this->recur1($decoded_json, $simplified_list, $parent=null);

        DB::beginTransaction();
        try {
            $info = [
                "success" => FALSE,
            ];
            // dd($simplified_list);
            foreach($simplified_list as $k => $v){
                $category = ProductCategory::find($v['id']);
                $category->fill([
                    "category_id" => $v['category_id'],
                    "sort_order" => $v['sort_order'],
                ]);

                $category->save();
            }

            DB::commit();
            $info['success'] = TRUE;
        } catch (\Exception $e) {
            DB::rollback();
            $info['success'] = FALSE;
        }

        if($info['success']){
            $request->session()->flash('success', "All Categories updated.");
        }else{
            $request->session()->flash('error', "Something went wrong while updating...");
        }

        return redirect(route('admin.product-categories.list'));
    }

    public function recur1($nested_array=[], &$simplified_list=[], $parent){
        //print porent
        foreach($nested_array as $k => $v){
            
            $sort_order = $k+1;
            $simplified_list[] = [
                "id" => $v['id'], 
                "category_id" => $parent, 
                "sort_order" => $sort_order
            ];
            
            if(!empty($v["children"])){
                $this->recur1($v["children"], $simplified_list, $v['id']);
            }

        }
    }

    // public function recur1($nested_array=[], &$simplified_list=[]){
        
    //     static $counter = 0;
        
    //     foreach($nested_array as $k => $v){
            
    //         $sort_order = $k+1;
    //         $simplified_list[] = [
    //             "id" => $v['id'], 
    //             "category_id" => null, 
    //             "sort_order" => $sort_order
    //         ];
            
    //         if(!empty($v["children"])){
    //             $counter+=1;
    //             $this->recur2($v['children'], $simplified_list, $v['id']);
    //         }

    //     }
    // }

    // public function recur2($sub_nested_array=[], &$simplified_list=[], $parent_id = NULL, $store_sub_nested_array=[], $store_parent_id = NULL){
        
    //     static $counter = 0;
    //     // $nested_array[$counter] = $sub_nested_array;
    //     // array_shift($nested_array[$counter]);
    //     // dd($sub_nested_array);
    //     foreach($sub_nested_array as $k => $v){
            
    //         $sort_order = $k+1;
    //         $simplified_list[] = [
    //             "id" => $v['id'], 
    //             "category_id" => $parent_id, 
    //             "sort_order" => $sort_order
    //         ];
            
    //         if(!empty($v["children"])){
    //             $counter+=1;
    //             return $this->recur2($v['children'], $simplified_list, $v['id'], $sub_nested_array, $parent_id);
    //         } 
    //     }
    //     if($store_sub_nested_array){
    //         array_shift($store_sub_nested_array);
    //         // dd($store_sub_nested_array);
    //         if(count($store_sub_nested_array)!=0) {
                
    //             return $this->recur2($store_sub_nested_array, $simplified_list, $store_parent_id, $store_sub_nested_array, $store_parent_id);
    //         }
    //     }

    // }
}
