<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        //chech if total_server == total_from frontend 

        //create user
        $infoRecipient= $request->session()->get("recipientInfo");

        $user= User::firstOrCreate([
                'email'=>$request->input('email')
            ],
            [
                'password'=>Hash::make(Str::random(12)),
                'name'=>$request->input('email'),
                'address'=>$request->input('email'),
                'contact'=>$request->input('contact'),
                'city'=>$request->input('city'),
                'state'=>$request->input('state'),
                'zip_code'=>$request->input('zip_code'),
                'admoo'=>0,
            ]
            );

        //charge user
        try{
            $payment= $user->charge(
                $request->input('total'),
                $request->input('payment_id')
            );

            $payment= $payment->asStripePaymentIntent();
            $order= $user->orders()
                ->create([
                    'transaction_id'=>$payment->charges->data[0]->id,
                    'total'=>$payment->charges->data[0]->amount,
                    'status'=>1, // 1 payed, 2 process, 3,on way to deliver, 4 delivered, 5 canceld, 6 remboused
                    'sha_key'=>substr(sha1(time()),20) ,
                    'recipient_name'=>$infoRecipient['recipient_name']." ".$infoRecipient['recipient_surname'] ,
                    'recipient_contact'=>$infoRecipient['recipient_contact'] ,
                    'recipient_address'=>$infoRecipient['recipient_address'] ,
                    'recipient_state'=>"Quebec" , //$infoRecipient['recipient_state'] ,
                    'recipient_zip_code'=>$infoRecipient['recipient_zip_code'] ,
                    'recipient_comment'=>$infoRecipient['recipient_comment'] ,

                ]);
            
            $cart = Cart::getContent();
            
            foreach($cart as $item){
                $order->products()
                    ->attach($item->id,["qty"=>$item->quantity,"cprice"=>$item->price ]);
            }

            $order->load('products');

            dd($order);

        }
        catch(\Exception $e){
            // throw exception
            $message_error= $e->getMessage();
            dd($e);
            //redirect()->back();
        }

        //create order and fetch all cart info in order product

        

    }
}
