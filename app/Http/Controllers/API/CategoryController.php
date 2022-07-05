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


    //get all categories and hadiths with pivot table
    //an android developer in my team asked for it, He needs it for cashing
    public function categoriesHadiths(){
        $categories =  Category::all();
        $categoriesHadiths = array();
        for ($i=0; $i < count($categories) ; $i++) { 
            $new = $categories[$i]->hadiths()->get();
            array_push($categoriesHadiths, $new);
        }
        return $this->returnData('categoriesHadiths', $categoriesHadiths);
    }
    
}
