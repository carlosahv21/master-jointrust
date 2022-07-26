<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class Dashboard extends Component
{  
    
    public function render()
    {
        
        return view('dashboard',
            [
                'products'  => DB::table('products')->orderBy('id', 'desc')->get()
            ]
        );   
    }
}
