<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class PageController extends Controller
{
    public function index()
    {
        return view('customer.index', [
            'categories' => Category::all(),
        ]);
    }
    public function getProductsByCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $category->id)->paginate(6);
        return view('customer.category', [
            'products' => $products,
            'name' => $category->name
        ]);
    }
    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        //page view
        $now = date('Y-m-d');
        if ($product->date_view == $now) {
            $product->counter++;
        } else {
            $product->counter = 1;
            $product->date_view = $now;
        }
        $product->save();
        return view('customer.product', ['product' => $product]);
    }
}