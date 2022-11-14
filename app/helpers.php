<?php

use App\Models\Admin;
use App\Models\Category;
use App\Models\SubCategory;

    function getAdminData($id){
        $admin = Admin::find($id);
        return $admin;
    }
    function getCategory($slug){
        $category = Category::where('slug', $slug)->first();
        return $category;
    }

    function getSubCategory($slug){

        $subcategory = SubCategory::where('slug', $slug)->first();
        return $subcategory;
    }
    function getSingleImage($images){

        $image = explode(',', $images);
        return $image[0];
    }

    function categoryAll(){
        $category = Category::all();
        return $category;
    }
    function subcategoryAll($slug){
        $subcategory = SubCategory::where('category_slug', $slug)->get();
        return $subcategory;
    }
?>
