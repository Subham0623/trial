<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductCategory;
use App\ProductTag;
use App\Book;
use App\Slider;
use App\Popup;


class HomeApiController extends Controller
{

    public function hello(){
        return response()->json([Product::all(),200]);
    }

    public function index()
    {
        $products = Product::with('categories.parentCategory.parentCategory.parentCategory')
            ->inRandomOrder()
            ->take(6)
            ->get();
        
        $recent_products = Product::with('categories.parentCategory.parentCategory.parentCategory')
            ->latest()
            ->take(10)
            ->get();

        $featured_products = Product::where('featured',1)->with('categories.parentCategory.parentCategory.parentCategory')
        ->inRandomOrder()
        ->take(8)
        ->get();
        // dd($featured_products);
        $sliders = Slider::where('status',0)->latest()->get();
        // dd($sliders);
        $popups = Popup::where('status',0)->latest()->get();
        return Response()->json(array(
            'products' => $products,
            'recent_products' => $recent_products,
            'featured_products' => $featured_products,
            'sliders' => $sliders,
            'popups' => $popups,
        ));
    }

    public function category(ProductCategory $category, ProductCategory $childCategory = null, $childCategory2 = null, $childCategory3 = null)
    {
        $products = null;
        $ids = collect();
        $selectedCategories = [];
        // dd($childCategory);
        if ($childCategory3) {
            $cat = $childCategory->childCategories()->where('slug', $childCategory2)->firstOrFail();
            $subCategory = $cat->childCategories()->where('slug', $childCategory3)->firstOrFail();
            $ids = collect($subCategory->id);
            $selectedCategories = [$category, $childCategory, $cat, $subCategory];
        } elseif ($childCategory2) {
            $subCategory = $childCategory->childCategories()->where('slug', $childCategory2)->firstOrFail();
            $ids = $subCategory->childCategories->pluck('id');
            $selectedCategories = [$category, $childCategory, $subCategory];
        } elseif ($childCategory) {
            $childCategory->load('childCategories.childCategories');
            $ids = collect();
            $selectedCategories = [$category, $childCategory];

            if ($childCategory->childcategories->count()) {
                foreach ($childCategory->childCategories as $subCategory) {
                    if ($subCategory->childcategories->count()) {
                        $ids = $ids->merge($subCategory->childCategories->pluck('id'));
                    } else {
                        $ids = $ids->merge($childCategory->childCategories->pluck('id'));
                    }
                }
            } else {
                $ids = collect($childCategory->id);
            }
        } elseif ($category) {
            $category->load('childCategories.childCategories.childCategories');
            $ids = collect();
            $selectedCategories[] = $category;

            if ($category->childCategories->count()) {
                foreach ($category->childCategories as $subCategory) {
                    if ($subCategory->childCategories->count()) {
                        foreach ($subCategory->childCategories as $cat) {
                            if ($cat->childCategories->count()) {
                                $ids = $ids->merge($cat->childCategories->pluck('id'));
                            } else {
                                $ids = $ids->merge($subCategory->childCategories->pluck('id'));
                            }
                        }
                    } else {
                        $ids = $ids->merge($category->childCategories->pluck('id'));
                    }
                }
            } else {
                $ids = collect($category->id);
            }
        }
        
        $products = Product::whereHas('categories', function ($query) use ($ids) {
                $query->whereIn('id', $ids);
            })
            ->with('categories.parentCategory.parentCategory.parentCategory')
            ->paginate(9);

        $featured_products = Product::where('featured',1)->whereHas('categories', function ($query) use ($ids) {
                $query->whereIn('id', $ids);
            })
            ->with('categories.parentCategory.parentCategory.parentCategory')
            ->take(4)
            ->get();

        $latest_products = collect();
        if(!$featured_products->count()) {
            $latest_products = Product::whereHas('categories', function ($query) use ($ids) {
                    $query->whereIn('id', $ids);
                })
                ->with('categories.parentCategory.parentCategory.parentCategory')
                ->latest()
                ->take(4)
                ->get();
            }
        // dd($latest_products);
        return Response()->json(array(
            'products' => $products,
            'selectedCategories' => $selectedCategories,
            'featured_products' => $featured_products,
            'latest_products' => $latest_products,
        ));
    }

    public function product(Product $product, $productSlug, $category)
    {
       
        $product->load('categories.parentCategory.parentCategory.parentCategory', 'tags');
        $category = $product->categories->where('slug', $category)->first();
        $selectedCategories = [];

        if ($category) {
            $selectedCategories = [
                $category->parentCategory->parentCategory->parentCategory ?? null,
                $category->parentCategory->parentCategory ?? null,
                $category->parentCategory ?? null,
                $category
            ];
        }
        
        $tags = $product->tags->pluck('id');
        
        $related_products = Product::where('id', '!=', $product->id)
            ->whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('id', $tags);
            })
            ->with('tags')
            ->inRandomOrder()
            ->take(8)
            ->get();
            // dd($product);
            return Response()->json(array(
                'product' => $product,
                'selectedCategories' => $selectedCategories,
                'related_products' => $related_products,
            ));
            
    }

    
}
