<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\Order;
use App\Models\Antrian;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PaymentController extends Controller
{
    //
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        // Set midtrans configuration
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function index()
    {
        return view('Payment.index');
    }

    public function createTransaction(Request $request)
    {
        $order = Order::create([
            'user_id' => '1',
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->amount,
            ],
            'customer_details' => [
                'first_name' => 'nama_01',
                'email' => 'email_01@gmail.com',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('Payment.pay', compact('snapToken', 'order'));
    }

    public function notificationHandler(Request $request)
    {
        $notification = new Notification();

        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraudStatus = $notification->fraud_status;

        $order = Order::find($orderId);

        if ($transactionStatus == 'capture') {
            if ($paymentType == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $order->update(['status' => 'challenge']);
                } else {
                    $order->update(['status' => 'success']);
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            $order->update(['status' => 'success']);
        } elseif ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
        } elseif ($transactionStatus == 'deny') {
            $order->update(['status' => 'failed']);
        } elseif ($transactionStatus == 'expire') {
            $order->update(['status' => 'expired']);
        } elseif ($transactionStatus == 'cancel') {
            $order->update(['status' => 'failed']);
        }

        return response()->json(['status' => 'ok']);
    }

    public function updateStatus(Request $request)
    {
        $transactionStatus = $request->input('result.transaction_status');
        $paymentType = $request->input('result.payment_type');
        $orderId = $request->input('result.order_id');
        $fraudStatus = $request->input('result.fraud_status');
        $order = Order::find($orderId);

        if ($transactionStatus == 'capture') {
            if ($paymentType == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $order->update(['status' => 'challenge']);
                } else {
                    $order->update(['status' => 'success']);
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            $order->update(['status' => 'success']);
        } elseif ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
        } elseif ($transactionStatus == 'deny') {
            $order->update(['status' => 'failed']);
        } elseif ($transactionStatus == 'expire') {
            $order->update(['status' => 'expired']);
        } elseif ($transactionStatus == 'cancel') {
            $order->update(['status' => 'failed']);
        }

        // Return a response
        return response()->json(['message' => 'Payment status updated successfully!']);
        // return redirect()->route('payment.index');
    }

    public function sse()
    {
        return view('Sound.index');
    }

    public function console()
    {
        $antri = Antrian::find('1');
        return view('Sound.console', compact('antri'));
    }

    public function stream()
    {
        $response = new StreamedResponse();
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->setCallback(
            function () {
                $score = Antrian::find('1');
                echo "data: " . json_encode($score) . "\n\n";
                echo "retry: 1000\n\n"; // no retry would default to 3 seconds.
                ob_end_flush();
                // ob_flush();
                flush();
            }
        );
        $response->send();
    }

    public function updateAntrian(Request $request)
    {
        $score = Antrian::find('1');
        $result_fix = ($score->nomor_antrian) + 1;
        $score->nomor_antrian = $result_fix;
        $score->save();
        $data = $score;
        //dd($data);
        return response()->json($data);
    }

    public function resetAntrian(Request $request)
    {
        $score = Antrian::find('1');
        $score->nomor_antrian = '1';
        $score->save();
        $data = $score;
        return response()->json($data);
    }
}
