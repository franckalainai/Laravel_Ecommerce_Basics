<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Category;
use App\Product;

class ProductsController extends Controller
{
    public function addProduct(Request $request){
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option select desabled>Select</option>";
        foreach($categories as $cat){
            $categories_dropdown .="<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach($sub_categories as $sub_cat){
                $categories_dropdown .="<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }

        if($request->isMethod('post')){
            $data = $request->all();
            echo '<pre>'; print_r($data); die;

            $product = new Product;
            $product->product_name = $data['product_name'];
            $product->product_name = $data['product_code'];
            $product->product_name = $data['product_color'];
            $product->product_name = $data['description'];
            $product->product_name = $data['price'];
        }

        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }
}
