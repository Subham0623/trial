<?php

namespace App\Http\View\Composers;

use App\ProductCategory;
use Illuminate\View\View;

class FrontPageComposer
{
    private $frontCategories;

    public function __construct()
    {
        // multiple category with product count
        
        // $this->frontCategories = cache()->remember('frontCategories', 3, function () {
        //     return ProductCategory::whereNull('category_id')
        //         ->with(['childCategories.childCategories.childCategories' => function ($query) {
        //             $query->withCount('products');
        //         }, 'childCategories.products'])
        //         ->get();
        //     }); 

        // summing up product counts

        // foreach ($this->frontCategories as $parentCategory) {
        //     foreach($parentCategory->childCategories as $category) {
        //         foreach($category->childCategories as $cat) {
        //             $cat->products_count = $cat->childCategories->sum('products_count');
        //         }
        //         $category->products_count = $category->childCategories->sum('products_count');
        //     }
        //     $parentCategory->products_count = $parentCategory->childCategories->sum('products_count');
        // }

        // Just multiple category without product count
        // $this->frontCategories = cache()->remember('frontCategories', 3, function () {
        //     return ProductCategory::whereNull('category_id')
        //         ->with(['childCategories.childCategories.childCategories','childCategories.products'])
        //         ->get();
        //     });

            $this->frontCategories = ProductCategory::whereNull('category_id')
                ->with(['childCategories.childCategories.childCategories','childCategories.products'])
                ->orderBy('sort_order', 'ASC')
                ->get();
    }

    public function compose(View $view)
    {
        $view->with('frontCategories', $this->frontCategories);
    }
}
