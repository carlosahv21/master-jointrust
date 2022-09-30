<?php

use App\Http\Livewire\BootstrapTables;
use App\Http\Livewire\Components\Buttons;
use App\Http\Livewire\Components\Forms;
use App\Http\Livewire\Components\Modals;
use App\Http\Livewire\Components\Notifications;
use App\Http\Livewire\Components\Typography;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Err404;
use App\Http\Livewire\Err500;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Lock;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\ForgotPasswordExample;
use App\Http\Livewire\Index;
use App\Http\Livewire\LoginExample;
use App\Http\Livewire\ProfileExample;
use App\Http\Livewire\RegisterExample;
use App\Http\Livewire\Transactions;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ResetPasswordExample;
use App\Http\Livewire\UpgradeToPro;
use App\Http\Livewire\Users;
use App\Http\Livewire\Guests;
use App\Http\Livewire\Products;
use App\Http\Livewire\Orders;
use App\Http\Livewire\ListOrders;
use App\Http\Livewire\ListDomiciliary;
use App\Http\Livewire\GiftSets;
use App\Http\Livewire\Shippings;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login');

Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::get('/404', Err404::class)->name('404');
Route::get('/500', Err500::class)->name('500');
Route::get('/upgrade-to-pro', UpgradeToPro::class)->name('upgrade-to-pro');

Route::middleware('auth')->group(function () {
    // Rutas de Usuario
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/users', Users::class)->name('users');
    Route::post('/shipping', [ Users::class, 'updateShipping' ]);

    // Rutas de Invitados
    Route::get('/referals/{id}', [Guests::class, 'show']);
    Route::get('/invite/{id}', [Guests::class, 'inviteReferrals'])->name('invite');
    
    // Rutas de Productos
    Route::get('/list-products', Products::class)->name('products');

    // Rutas de Ordenes
    Route::get('/orders', Orders::class)->name('orders');
    Route::get('markAsRead', function(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('markAsRead');
    Route::get('/view-order/{id}/{notification_id?}', [Orders::class, 'show']);
    Route::get('/confirmation/{id}', [Orders::class, 'confirmation'])->name('confirmation');
    Route::get('/list-order', ListOrders::class)->name('list-order');

    // Rutas de Domiciliarios
    Route::get('/list-domiciliary', ListDomiciliary::class)->name('list-domiciliary');
    
    // Rutas de Kit de Regalos
    Route::get('/gift-sets', GiftSets::class)->name('gift-sets');

    // Rutas de Dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/foo', function () {
        Artisan::call('storage:link');
    });

    // Rutas de Domicilio
    Route::get('/shippings', Shippings::class)->name('shippings');

});
Route::get('/config-cache', function() {      $exitCode = Artisan::call('config:cache');  $exitCode = Artisan::call('config:clear');    return '<h1>Clear Config cleared</h1>';  });
