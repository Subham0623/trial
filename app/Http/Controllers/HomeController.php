<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use App\Slider;
use App\Popup;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status',0)->latest()->get();
        $popups = Popup::where('status',0)->latest()->get();
        // dd($sliders);
        return view('site.index', compact('sliders','popups'));
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
        return view('site.category-product', compact('products', 'selectedCategories', 'featured_products', 'latest_products'));
    }

    public function product(Product $product, $productSlug, $category)
    {
    //    dd($product->photo->geturl());
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
            
        return view('site.product', compact('product', 'selectedCategories','related_products'));
    }

    public function search(Request $request) 
    {
        $request->validate([
            'query' => 'required',
        ]);
        $query = $request->input('query');
            
        // $products = Product::where('name', 'like', "%$query%")
        //     ->with('categories.parentCategory.parentCategory.parentCategory')
        //     ->paginate(9);

        // using laravel searchable
        $products = Product::search($query)
            ->with('authors')
            ->paginate(9);
        $products->withPath('search?query='.$query);
        // $featured_products = Product::where('name', 'like', "%$query%")
        //     ->where('featured',1)
        //     ->with('categories.parentCategory.parentCategory.parentCategory')
        //     ->take(4)
        //     ->get();

        // using laravel searchable
        $featured_products = Product::search($query)
            ->where('featured',1)
            ->with('categories.parentCategory.parentCategory.parentCategory')
            ->take(4)
            ->get();

        $latest_products = collect();
        // if(!$featured_products->count()) {
        //     $latest_products = Product::where('name', 'like', "%$query%")
        //         ->with('categories.parentCategory.parentCategory.parentCategory')
        //         ->latest()
        //         ->take(4)
        //         ->get();
        //     }
        
        // using laravel searchable
        if(!$featured_products->count()) {
            $latest_products = Product::search($query)
                ->with('categories.parentCategory.parentCategory.parentCategory')
                ->latest()
                ->take(4)
                ->get();
            }
        return view('site.category-product', compact('products','featured_products','latest_products'));
    }

    public function getSpecificTags(Request $request) {
        $tags = ProductTag::whereHas('levels', function ($query) use ($request) {
            $query->where('level_id', $request->level_id);
        })
        ->pluck('name','id');
        return $tags;
    }

}
