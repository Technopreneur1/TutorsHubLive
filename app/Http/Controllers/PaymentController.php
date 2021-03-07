<?php

namespace App\Http\Controllers;

use App\Earning;
use App\Payment;
use PayPal\Api\Payout;
use PayPal\Api\Currency;
use PayPal\Api\PayoutItem;
use PayPal\Rest\ApiContext;
use App\Mail\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\PayoutSenderBatchHeader;
use App\Mail\PaymentRequestConfirmation;

class PaymentController extends Controller
{
    //


    public function requestBank()
    {
        if (auth()->user()->currency == "USD") {
            $currency = "USD";
        } else{
            $currency = "CAD";
        }
        
        Mail::to('info@tutors-hub.com')->send(new PaymentRequest(auth()->user(), Earning::balance(auth()->user()->profile), $currency));
        Mail::to(auth()->user()->email)->send(new PaymentRequestConfirmation(auth()->user(), Earning::balance(auth()->user()->profile), $currency));
        return response()->json(['msg' => 'success']);
    }

    public function index()
    {
        if(auth()->user()->type == 'teacher')
        {
            $profile = auth()->user()->profile;
            $payments = auth()->user()->profile->payments;
            $gross = Earning::gross($profile);
            $net = Earning::total($profile);
            $withdrawn = $payments->sum('amount');
            $balance = Earning::balance($profile);
            // dd($gross);
            return view('pages.payments.index', ['payments' => $payments, 'gross' => $gross, 'net' => $net, 'withdrawn' => $withdrawn, 'balance' => $balance]);
        }else {
            abort(404);
        }
    }

    public function getpayout()
    {


        $user = auth()->user();
        $id = $user->profile->id;
        $paypal_id = $user->paypal;
        $balance = Earning::balance($user->profile);

        if(!$paypal_id)
        {

            return redirect()->back()->with(['error' => 'Transaction Failed.. ! Please try again in 24 hours and if still issue occurs please contact support center.']);

        }else{

            //dd(auth()->user()->country->name);
            if (auth()->user()->currency == "USD") {
                $currency = "USD";
            } else{
                $currency = "CAD";
            }
            
            $paypal_conf = \Config::get('paypal');
            $this->_api_context = new ApiContext(new OAuthTokenCredential(
                    $paypal_conf['client_id'],
                    $paypal_conf['secret'])
            );
            $this->_api_context->setConfig($paypal_conf['settings']);

            $payouts = new Payout();
            $senderBatchHeader = new PayoutSenderBatchHeader();

            $senderBatchHeader->setSenderBatchId(uniqid())
                ->setEmailSubject("You have a Payout!");


            $senderItem = new PayoutItem();
            $senderItem->setRecipientType('Email')
                ->setNote('Thanks for your service!')
                ->setReceiver($paypal_id)
                ->setSenderItemId(uniqid())
                ->setAmount(new Currency('{
                                "value":"'.$balance.'",
                                "currency":"'.$currency.'"
                            }'));

            $payouts->setSenderBatchHeader($senderBatchHeader)
                ->addItem($senderItem);

            $request = clone $payouts;

            try {
                $output = $payouts->createSynchronous($this->_api_context);
            } catch (Exception $ex) {
                // dd($request);
                dd($ex);
                // print("Created Single Synchronous Payout", "Payout", null, $request, $ex);
                exit(1);
            }

            $transcation_id = $output->getBatchHeader()->getPayoutBatchId();
            $payout_status = $output->getBatchHeader()->getBatchStatus();
            $payoutItems = $output->getItems();
            $payoutItem = $payoutItems[0];
            $payoutId = $payoutItem->getPayoutItemId();
            $transactionid = $payoutItem->getTransactionId();
            $activityid = $payoutItem->activity_id;
            $transactionstatus = $payoutItem->getTransactionStatus();


            if($payout_status == 'SUCCESS'){

                Payment::create([
                    'teacher_id' => $id,
                    'amount' => $balance,
                    'proff' => $activityid,
                    'type' => 'Paypal'
                ]);

                return redirect()->back()->with(['message' => ' Transaction Successful .. ! Payment has been sent to your PayPal Account.']);


            } else{

                return redirect()->back()->with(['error' => 'Failed! Try Again Later After 24 Hours']);

            }

        }


    }

    public function post(Request $request)
    {
        $name = '';
        if($request->hasFile('image'))
        {
            $file = $request->image;
            $name = uniqid(true) . 'proff' . rand(99, 9999) . "." . $file->getClientOriginalExtension();
            $file->storeAs('public/proffs', $name);
        }

        Payment::create([
            'teacher_id' => $request->teacher,
            'amount' => $request->amount,
            'proff' => $name,
            'type' => 'Bank Transfer'
        ]);


        session('message', 'Payment Added');
        return back();
    }


}
