<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use ValidatesRequests;

    /**
     * create new transaction IDs to be submitted by the customers.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function createTransactionID(Request $request)
    {

        // ZainCash Credentials
        $phone_no = env('ZAINCASH_PHONE_NO');
        $merchantSecret = env('ZAINCASH_SECRET');
        $merchantId = env('ZAINCASH_MERCHANT_ID');

        // Building Order Details Data
        $data = [
            'merchantId' => $merchantId,
            'amount' => 250, // Amount of the Order
            'msisdn' => $phone_no, // Your wallet phone number in Zaincash
            'orderId' => 'bill_12345', // TODO order_id
            'redirectUrl' => 'http:/127.0.0.1:8000', // The Customer will redirect to this url
            'serviceType' => 'IDK', // Todo Service Type is Required
            'iat' => time(),
            'exp' => time() + 60 * 60 * 4, // 4 hours
        ];

        // Encoding Token
        $newtoken = JWT::encode(
            $data, //Data to be encoded in the JWT
            $merchantSecret, // secret is requested from ZainCash
            'HS256' // algorithm HS256
        );

        // Check if test or live mode
        $tUrl = 'https://test.zaincash.iq/transaction/init';
        $rUrl = 'https://test.zaincash.iq/transaction/pay?id=';
        // if (env('APP_ENV') === 'local') {
        //     $tUrl = 'https://test.zaincash.iq/transaction/init';
        //     $rUrl = 'https://test.zaincash.iq/transaction/pay?id=';
        // } else {
        //     // live
        //     $tUrl = 'https://api.zaincash.iq/transaction/init';
        //     $rUrl = 'https://api.zaincash.iq/transaction/pay?id=';
        // }

        // Posting data to ZainCash API
        $data_to_post = array();
        $data_to_post['token'] = urlencode($newtoken);
        $data_to_post['merchantId'] = $merchantId; // Your merchant ID is requested from ZainCash
        $data_to_post['lang'] = 'en'; // ZainCash support 3 languages ar, en, ku
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data_to_post),
            ),
        );
        $context = stream_context_create($options);
        $response = file_get_contents($tUrl, false, $context);

        // Parsing response
        $transaction = json_decode($response, true);
        //dd($transaction);
        if (isset($transaction['id'])) {
            $payment_url = $rUrl . $transaction['id'];
            // dd(1);
            // update wallet
            // $this->checkPaymentStatus($transaction['id']);
            return redirect($payment_url);
        }
        return $transaction;
    }
    /**
     * Callback Validation For ZainCash
     *
     * @var array
     */
    public static $callbackValidation = [
        'token' => 'required|string',
    ];

    /**
     * Callback Function Payment
     *
     * @param [type] $input
     *
     * @return void
     */
    // public function callbackPayment($input)
    // {
    //     $secret = env('ZAINCASH_SECRET');
    //     $credentials = JWT::decode($input['token'], new Key($secret, 'HS256'));

    //     // Check Payment Status From ZainCash API
    //     $status = $this->checkPaymentStatus($credentials->id);
    //     return $status;
    // }
    /**
     * check on the state of the transaction IDs submitted by the customers.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function checkPaymentStatus(Request $request)
    {
        $validated = $request->validate([
            "paymentId" => "string|required",
        ]);
        // building data
        $data = [
            'id' => $validated['paymentId'], // The ID for the transaction you want to check
            'msisdn' => (int) env('ZAINCASH_PHONE_NO'), // Your wallet phone number in Zaincash
            'iat' => time(),
            'exp' => time() + 60 * 60 * 4,
        ];

        // Encoding Token
        $newtoken = JWT::encode(
            $data, // Data to be encoded in the JWT
            env('ZAINCASH_SECRET'), // secret is requested from ZainCash
            'HS256' // algorithm HS256
        );

        // Check if test or live mode
        if (env('APP_ENV') === 'local') {
            $rUrl = 'https://test.zaincash.iq/transaction/get';
        } else {
            $rUrl = 'https://api.zaincash.iq/transaction/get';
        }

        // POST data to ZainCash API
        $data_to_post = array();
        $data_to_post['token'] = urlencode($newtoken);
        $data_to_post['merchantId'] = env('ZAINCASH_MERCHANT_ID'); // Your merchant ID is requested from ZainCash
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data_to_post),
            ),
        );
        $context = stream_context_create($options);
        $response = file_get_contents($rUrl, false, $context);
        $response = json_decode($response, true);

        // Update the Status if it not updated from callback
        // $wallet = WalletTopup::where('payment_id', $paymentId)->firstOrfail();
        // $status = $wallet->checkStatus($response['status']);
        return $response;
    }
}
