<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function searchForProduct(Request $request)
    {
        $search = $request->search;
        // dd($request);
        if (empty($search)) abort(404);
        $searchResults = Product::where('name', 'LIKE', "%$search%")->paginate(6);
        return view('customer.search', [
            'products' => $searchResults,
            'name' => $search
        ]);
    }
    public function addToCart(Request $request)
    {


        $product = Product::find($request->product_id);
        $quantity = $request->quantity;
        if (!$product || $quantity < 1) return response()->json([
            'msg' => 'Product not found or invalid quantity specified!',
            'type' => 'error',
        ]);

        if (Auth::user()) {
            $check = Cart::firstOrCreate(['user_id' => Auth::id(), 'product_id' => $product->id]);
            if ($check->wasRecentlyCreated) {
                $check->quantity = $quantity;
                $check->save();
                return response()->json([
                    'msg' => 'Product added to cart!',
                    'type' => 'success',
                ]);
            } else return response()->json([
                'msg' => 'Product already in cart',
                'type' => 'info'
            ]);
        } else {
            if (!Session::has('cart')) {
                session('cart', array());
            }
            $exist = array();
            if (session('cart'))
                foreach (session('cart') as $row) {
                    array_push($exist, $row['productid']);
                }
            if (in_array($product->id, $exist)) {
                return response()->json([
                    'msg' => 'Product already in cart!',
                    'type' => 'info',
                ]);
            } else {
                $data = array();
                $data['productid'] = $product->id;
                $data['quantity'] = $quantity;

                $request->session()->push('cart', $data);
                return response()->json([
                    'msg' => 'Product added to cart!',
                    'type' => 'success',
                ]);
            }
        }
    }
    public function getCart()
    {

        $output = array('list' => '', 'count' => 0);

        if (Auth::user()) {
            $carts = Cart::where('user_id', Auth::id())->get();
            foreach ($carts as $cart) {
                $output['count']++;
                $productname = (strlen($cart->product->name) > 30) ? substr_replace($cart->product->name, '...', 27) : $cart->product->name;
                $output['list'] .= "
                <li class='dropdown-item'>
                                   " . $productname . " &times; " . $cart->quantity . "
                        </li>
                    ";
            }
        } else {
            if (!Session::has('cart')) {
                session('cart', array());
            }

            if (count(session('cart')) < 1) {
                $output['count'] = 0;
            } else {
                foreach (session('cart') as $row) {
                    $product = Product::find($row['productid']);
                    if (!$product) continue;
                    $output['count']++;

                    $output['list'] .= "
                        <li class='dropdown-item'>
                                   " . $product->name . " &times; " . $row['quantity'] . "
                        </li>
                    ";
                }
            }
        }

        $output['list'] .= '<li class="dropdown-item"><a href="' . route('previewCart') . '">Go to Cart</a></li>';
        echo json_encode($output);
    }
    public function previewCart()
    {
        return view('customer.cart_view');
    }
}