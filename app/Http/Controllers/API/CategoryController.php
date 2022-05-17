<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hadith;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $categories = Category::all();
        return $this-> returnData('categories', $categories);
    }




    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $newCategory = new Category([
            'name' => $request->get('name'),
        ]);
        $newCategory->save();
        return $this-> returnData('category', $newCategory);
    }



    public function show($id)
    {
        $category = Category::findOrFail($id);
        return $this-> returnData('category', $category);
    }




    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => '',
        ]);
        $category->name = $request->get('name');
        $category->save();
        return $this-> returnData('category', $category);
    }




    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $this-> returnData('categories', $category::all());
    }




    //method to attach a hadith to a category
    public function categoryAttach($categoryId ,$hadithId){
        $category = Category::findOrFail($categoryId);
        $hadith = Hadith::findOrFail($hadithId);
        $category -> hadiths()-> attach($hadith);
        return $this->returnSuccessMessage("added a hadith to the category..");
    }


    //get all hadiths that is attached to a category
    public function categoryHadiths($id){
        $category =  Category::findOrFail($id);
        $categoryHadiths = $category->hadiths;
        return $this->returnData('categoryHadiths', $categoryHadiths);
    }
    
}
