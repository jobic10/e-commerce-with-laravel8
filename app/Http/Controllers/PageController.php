<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use stdClass;

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
                    'title' => '🛒'
                ]);
            } else return response()->json([
                'msg' => 'Product already in cart',
                'type' => 'info',
                'title' => '🤓'

            ]);
        } else {
            // return response()->json([
            //     'msg' => 'You need to be logged in!',
            //     'type' => 'error',
            //     'title' => 'Oops'
            // ]);
            if (!Session::has('cart')) {
                session('cart', array());
            }
            $exist = array();
            if (session('cart'))
                foreach (session('cart') as $row) {
                    array_push($exist, $row['product_id']);
                }
            if (in_array($product->id, $exist)) {
                return response()->json([
                    'msg' => 'Product already in cart',
                    'type' => 'info',
                    'title' => '🤓'
                ]);
            } else {
                $data = array();
                $data['product_id'] = $product->id;
                $data['quantity'] = $quantity;

                $request->session()->push('cart', $data);
                return response()->json([
                    'msg' => 'Product added to cart!',
                    'type' => 'success',
                    'title' => '🛒'
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
                $output['list'] .= "<li class='dropdown-item'>" . $productname . " &times; " . $cart->quantity . "</li>";
            }
        } else {
            if (!Session::has('cart')) {
                session('cart', array());
            }

            if (count(session('cart')) < 1) {
                $output['count'] = 0;
            } else {
                foreach (session('cart') as $row) {
                    $product = Product::find($row['product_id']);
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
        return json_encode($output);
    }
    public function previewCart()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('customer.cart_view', [
            'carts' => $carts
        ]);
    }
    public function fetchCart()
    {
        $output = "";
        $subtotal = 0;
        $total = 0;
        if (Auth::user()) {
            $carts = Cart::where('user_id', Auth::id())->get();
            foreach ($carts as $cart) {
                $subtotal = $cart->product->price * $cart->quantity;
                $total += $subtotal;
                $output .= '
            <tr>
            <td><button type="button" data-id="' . $cart->id . '"
                    class="btn btn-danger btn-sm cart_delete"><i
                    class="fa fa-trash fa-xs "></i></button></td>
                    <td><img src="https://via.placeholder.com/30" width="20px" height="20px">
            </td>
            <td>' . $cart->product->name . '</td>
            <td>&#8358;' . number_format($cart->product->price) . '</td>


            <td>
                <div class="input-group mb-3">
                <div class="input-group-prepend">

                        <button type="button" id="minus" class="btn btn-outline-primary btn-sm minus"
                            data-id="' . $cart->id . '"><i class="fa fa-minus fa-xs"></i></button>
                            </div>
                            <input type="text" id="qty_' . $cart->id . '" value="' . $cart->quantity . '" class="form-control" readonly>
                            <div class="input-group-append">
                            <button type="button" id="add" class="btn btn-outline-primary btn-sm add"
                            data-id="' . $cart->id . '"><i class="fa fa-plus fa-xs"></i></button>
                            </div>
                            </div>
                            </td>
                            <td>$ ' . number_format($subtotal) . '</td>
                            </tr>';
            }
        } else {
            //Fetch from session
            if (!Session::has('cart')) {
                session('cart', array());
            }
            foreach (session('cart') as $key => $row) {
                $product = Product::find($row['product_id']);
                if (!$product) {
                    //Remove this product from the array and continue
                    Session::forget("cart.$key");
                    continue;
                }
                $subtotal = $product->price * $row['quantity'];
                $total += $subtotal;
                $output .= '
                <tr>
                <td><button type="button" data-id="' . $key . '"
                        class="btn btn-danger btn-sm cart_delete"><i
                        class="fa fa-trash fa-xs "></i></button></td>
                        <td><img src="https://via.placeholder.com/30" width="20px" height="20px">
                </td>
                <td>' . $product->name . '</td>
                <td>&#8358;' . number_format($product->price) . '</td>


                <td>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">

                            <button type="button" id="minus" class="btn btn-outline-primary btn-sm minus"
                                data-id="' . $key . '"><i class="fa fa-minus fa-xs"></i></button>
                                </div>
                                <input type="text" id="qty_' . $key . '" value="' . $row['quantity'] . '" class="form-control" readonly>
                                <div class="input-group-append">
                                <button type="button" id="add" class="btn btn-outline-primary btn-sm add"
                                data-id="' . $key . '"><i class="fa fa-plus fa-xs"></i></button>
                                </div>
                                </div>
                                </td>
                                <td>&#8358; ' . number_format($subtotal) . '</td>
                                </tr>';
            }
        }
        $output .= "
        <tr>
        <td colspan='5' align='right'><b>Total</b></td>
        <td><b>&#36; " . number_format($total, 2) . "</b></td>
        <tr>
        ";
        return response()->json($output);
    }
    public function updateCart(Request $request)
    {

        $id = $request->id;
        $quantity = $request->qty;
        if (Auth::user()) {
            $cart = Cart::findOrFail($id);
            // echo $cart->product->name;
            // dd($cart);
            if ($cart->user_id != Auth::id() || !is_int($quantity)) {
                // $output = [
                //     'title' => 'Access Denied',
                //     'msg' => 'You do not have access to this resource',
                //     'type' => 'error'
                // ];
            }
            $cart->quantity = $quantity;
            $cart->save();
        } else {
            //*Update Session Cart Array

            if (session("cart.$id")) {
                Session::put("cart.$id.quantity", $quantity);
            }
        }
        // $output = [
        //     'title' => 'Cart updated',
        //     'msg' => 'Cart has been updated',
        //     'type' => 'success'
        // ];
        // return response()->json($output);
        return response()->json(true);
    }
    public function getCartTotal()
    {
        $total = 0;
        if (Auth::user()) {
            $carts = Cart::where('user_id', Auth::id())->get();
            foreach ($carts as $cart) {
                $total += ($cart->product->price * $cart->quantity);
            }
        } else {
            $carts = session('cart', []);
            foreach ($carts as $key => $cart) {
                $product = Product::find($cart['product_id']);
                if (!$product) {
                    Session::forget("cart.$key");
                    continue;
                }
                $total += ($product->price * $cart['quantity']);
            }
        }
        return  response()->json(number_format($total));
    }
    public function initPayment()
    {
        $pay = curl_init();
        $email = Auth::user()->email;
        $json_amount = json_decode($this->getCartTotal()->getContent());
        $json_amount = str_replace(",", "", $json_amount);
        $amount = is_float($json_amount) ? floatval($json_amount) : intval($json_amount);
        $amount *= 100; //amount in kobo
        $paystack = env('PAYSTACK_KEY', 'PAYSTACK');
        // dd($amount * 100);
        // dd($amount);
        //the amount in kobo. This value is actually NGN 5000

        curl_setopt_array($pay, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_CUSTOMREQUEST => "POST",

            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount,
                'email' => $email,
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer $paystack", //replace this with your own test key
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        ));
        $response = curl_exec($pay);
        $err = curl_error($pay);
        if ($err) {
            return redirect(route('previewCart'))->with('status', [
                'title' => 'Payment Error',
                'type' => 'warning',
                'msg' => 'We are deeply sorry. Please try making payment again!'
            ]);
        }
        $tranx = json_decode($response);
        if (!$tranx->status or empty($tranx->status)) {
            // there was an error from the API
            return redirect(route('previewCart'))->with('status', [
                'title' => 'Payment Error',
                'type' => 'warning',
                'msg' => 'Payment server error!'
            ]);
        }
        return redirect($tranx->data->authorization_url);
    }
    public function verifyPayment(Request $request)
    {
        $reference = $request->reference;
        $pay = curl_init();
        $json_amount = json_decode($this->getCartTotal()->getContent());
        $json_amount = str_replace(",", "", $json_amount);
        $amount = is_float($json_amount) ? floatval($json_amount) : intval($json_amount);
        $amount *= 100; //amount in kobo
        $paystack = env('PAYSTACK_KEY', 'PAYSTACK');

        curl_setopt_array($pay, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer $paystack",
                "cache-control: no-cache"
            ],
        ));
        $response = curl_exec($pay);
        $err = curl_error($pay);
        if ($err) {
            return redirect(route('previewCart'))->with('status', [
                'title' => 'Payment Error',
                'type' => 'warning',
                'msg' => 'We are deeply sorry. Please try making payment again!'
            ]);
        }
        // dd($response);
        if ($response) {
            $result = json_decode($response, true);

            if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success') && ($result['data']['requested_amount'] === intval($amount))) {
                //confirm access to payment success page
                $reference = strtoupper($reference);
                //User might not be online. Use the email of the payer and get the id
                $payer_email = ($result['data']['customer']['email']);
                $amount = $result['data']['requested_amount'] / 100;
                $user = User::where('email', $payer_email)->firstOrFail();

                //To prevent using same reference, check to see if payment reference exists
                $check_existing = Transaction::where('ref', $reference)->exists();
                if ($check_existing)
                    return redirect(route('viewProfile'))->with('status', [
                        'title' => 'Payment already verified',
                        'type' => 'error',
                        'msg' => 'Payment reference already used!'
                    ]);
                //Insert into transaction
                try {

                    $transaction = Transaction::create([
                        'ref' => $reference,
                        'user_id' => $user->id,
                        'amount' => $amount
                    ]);
                } catch (\Exception $e) {
                    return redirect(route('viewProfile'))->with('status', [
                        'title' => 'Duplicate Reference',
                        'type' => 'error',
                        'msg' => 'Payment reference already exist!'
                    ]);
                }
                //Move cart to transaction
                $carts = Cart::where('user_id', $user->id)->get();
                foreach ($carts as $cart) {
                    Sale::create([
                        'user_id' => $user->id,
                        'product_id' => $cart->product->id,
                        'quantity' => $cart->quantity,
                        'transaction_id' => $transaction->id
                    ]);
                    $cart->delete();
                }
                return redirect(route('viewProfile'))->with('status', [
                    'title' => 'Thank you ✅',
                    'type' => 'success',
                    'msg' => 'Payment Successful!'
                ]);
            } else {
                return redirect(route('previewCart'))->with('status', [
                    'title' => 'Payment not valid',
                    'type' => 'warning',
                    'msg' => 'Amount paid is not sufficient!'
                ]);
            }
        }
        return redirect(route('previewCart'))->with('status', [
            'title' => 'Payment Error',
            'type' => 'warning',
            'msg' => 'We are deeply sorry. Please try making payment again!'
        ]);
        dd($request);
    }
    public function deleteCart(Request $request)
    {
        $id = $request->id;
        if (Auth::user()) {
            $cart = Cart::find($id);
            if (!$cart) return [
                'title' => 'Access Denied',
                'type' => 'error',
                'msg' => 'You are not allowed to do this!'
            ];
            if ($cart->user_id != Auth::id())
                return [
                    'title' => 'Access Denied',
                    'type' => 'error',
                    'msg' => 'You do not have access to this resource!'
                ];
            $cart->delete();
            return [
                'title' => 'Action Completed',
                'type' => 'success',
                'msg' => 'Product has been removed from cart'
            ];
        } else {
            //Delete from session cart
        }
    }
    public function viewProfile()
    {
        return view('customer.profile', [
            'transactions' => Transaction::where('user_id', Auth::id())->paginate(10)
        ]);
    }
}