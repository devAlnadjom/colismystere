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

        $infoRecipient= $request->session()->get("recipientInfo");
        
        //chech if $total = Cart::getTotal()+$this->calculPrice($infoRecipient) == $request->input('total') frontend 

        //create user
        


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
                    'recipient_basic'=>$infoRecipient['recipient_basic']?1500:0 ,
                    'recipient_tracking'=>$infoRecipient['recipient_tracking']?200:0 ,
                    'recipient_premium'=>$infoRecipient['recipient_premium']?1500:0 ,
                    'recipient_own_product'=>0,//$infoRecipient['recipient_premium']?1000:0 ,

                ]);
            
            $cart = Cart::getContent();
            
            foreach($cart as $item){
                $order->products()
                    ->attach($item->id,["qty"=>$item->quantity,"cprice"=>$item->price ]);
            }

            //$order->load('products');

            //dd($order);
            //go to route to show sumary
            $request->session()->put("last_order", $order->id);
           // $request->session()->forget('recipientInfo');
            $request->session()->save();
            
            return redirect()->route('order.sumary');

        }
        catch(\Exception $e){
            // throw exception
            $message_error= $e->getMessage();
            dd($e);
            //redirect()->back();
        }

        //create order and fetch all cart info in order product
       

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
