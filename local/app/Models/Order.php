<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'subtotal',
        'tax',
        'total',
        'date_order',
        'state',
        'user_id',
    ];
    protected $guarded=[];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function gifts()
    {
        return $this->belongsToMany('App\Models\GiftSet');
    }
}