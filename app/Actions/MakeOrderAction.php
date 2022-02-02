<?php

namespace App\Actions;

use App\Models\Order;

class MakeOrderAction{

    public static function handle($infoRecipient, $payment, $user, $cart): Order
    {

        
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
                    'recipient_sexe'=>$infoRecipient['recipient_sexe'] ,
                    'recipient_place'=>$infoRecipient['recipient_place'] ,
                    'recipient_own_product'=>0,//$infoRecipient['recipient_premium']?1000:0 ,

                ]);
            
            foreach($cart as $item){
                $order->products()
                    ->attach($item->id,["qty"=>$item->quantity,"cprice"=>$item->price ]);
            }

            return $order;
    }
}