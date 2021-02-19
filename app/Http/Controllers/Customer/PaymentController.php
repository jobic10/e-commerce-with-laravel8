<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
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
}