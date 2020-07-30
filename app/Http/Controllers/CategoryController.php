<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
{
    public function addCategory(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            $category = new Category;
            $category->name = $data['category_name'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->save();

            return redirect('/admin/view-categories')->with('flash_message_success', 'Category created successfully');

            //echo'<pre>'; print_r($data); die;
        }

        return view('admin.categories.add_category');
    }

    public function viewCategories(){
        $categories = Category::get();
        return view('admin.categories.view_categories')->with(compact('categories'));
    }

    public function editCategory(Request $request, $id = null){
        $categoryDetails = category::where(['id' => $id])->first();
        return view('admin.categories.edit_category')->compact('categoryDetails');
    }
}
