<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function products(){
        return $this->belongsToMany(Product::class)
         ->withPivot(['qty','cprice']);
    }

    public function deliveries(){
        return $this->hasMany(Delivery::class);
    }


    public function planOrder()
    {
       return $this->update(['status'=>2]);
    }

    public function markAsOneWay()
    {
        return $this->update(['status'=>3]);
    }

    public function markAsCompleted()
    {
        return $this->update(['status'=>4]);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('recipient_name', 'like', '%'.$search.'%');
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            $query->where('status', '=', $trashed);
            /*if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }*/
        });
    }


}
