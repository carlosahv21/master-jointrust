<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftSet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'value',
    ];

    protected $guarded=[];

    public function orders()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}
