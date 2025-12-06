<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories(){
        $categories = Category::all();
        return $categories;
    }
    public function create(Request $request){
        $category = Category::create($request->all());
        return "category added successfully";
}
    public function update(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return "category updated";
    }
    public function delete(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->delete();
        return "category deleted";
    }
    public function show($id){
        $category = Category::findOrFail($id);
        return $category;
        
    }


}