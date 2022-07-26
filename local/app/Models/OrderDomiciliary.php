<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDomiciliary extends Model
{
    use HasFactory;

    protected $table = 'order_domiciliary';

    protected $fillable = [
        'order_id', 'user_id',
    ];

    protected $guarded=[];

    public function orders()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
