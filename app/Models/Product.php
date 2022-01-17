<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded=[];
    use SoftDeletes;


    public function registerMediaConversions(Media $media = null) : void
    {
            $this->addMediaConversion('thumb')
                    ->crop('crop-center', 500, 500);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function features(){
        return $this->hasMany(Feature::class);
    }


    public function orders(){
        return $this->belongsToMany(Order::class);
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%'.$search.'%');
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            //$query->where('status', '=', $trashed);
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
            if ($trashed === '1') {
                $query->where('avaible', '1');
            } elseif ($trashed === '0') {
                $query->where('avaible','<>', '1');
            }
        });
        // ->when($filters['avaible'] ?? null, function ($query, $avaible) {
        //     //$query->where('status', '=', $trashed);
        //     if ($avaible === '1') {
        //         $query->where('avaible', '1');
        //     } elseif ($avaible === '0') {
        //         $query->where('avaible', '0');
        //     }
        // });
    }
}
