<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
        'name',
        'reference',
        'presentation',
        'price',
        'product_image',
    ];
    protected $guarded=[];

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }
}
