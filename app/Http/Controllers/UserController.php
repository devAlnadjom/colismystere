<?php

namespace App\Http\Controllers;

use App\Actions\CreateCustumerAction;
use App\Actions\MakeOrderAction;
use App\Models\User;
use App\Notifications\NewOrderReceived;
use Inertia\Inertia;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::paginate()
        ]);
    }

    public function purchase(Request $request){

        $infoRecipient= $request->session()->get("recipientInfo");
        
        //chech if $total = Cart::getTotal()+$this->calculPrice($infoRecipient) == $request->input('total') frontend 

        
        $user= CreateCustumerAction::handle($request);

        try{
                $payment= $user->charge(
                    $request->input('total'),
                    $request->input('payment_id')
                );

                $cart = Cart::getContent();
                $payment= $payment->asStripePaymentIntent();
                
                $order = MakeOrderAction::handle($infoRecipient, $payment, $user, $cart);
    
                $request->session()->put("last_order", $order->id);
                $request->session()->forget('recipientInfo');
                $request->session()->save();

                $admin= User::first();
                $admin->notify(new NewOrderReceived($order));

                return redirect()->route('order.sumary');


        }
        catch(\Exception $e){
            // throw exception
            $message_error= $e->getMessage();
            return redirect()->back()->with('success',"SOMETHING went wrong with your payment. ". $message_error);
        }

       

    }

    private function calculPrice($data){
        $total=0;
        $basic_price=15;
        
        if($data['recipient_tracking'])
            $total+=2;

        if($data['recipient_premium'])
            $total+=10;

        return $total+$basic_price;

    }
}
