<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/admin', [App\Http\Controllers\LoginController::class, 'adminLogin'])->name('admin');
Route::post('/custom-login', [App\Http\Controllers\LoginController::class, 'authenticate'])->name('custom-login');
Route::get('/password', [App\Http\Controllers\LoginController::class, 'showChangePasswordForm'])->name('password');
Route::post('/password/change', [App\Http\Controllers\LoginController::class, 'changePassword'])->name('password.change');

Route::middleware('auth')->group(function () {
Route::post('/store-feedback', [App\Http\Controllers\HomeController::class, 'storeFeedback'])->name('store-feedback');
Route::get('/vote/{feedback}', App\Http\Controllers\VoteController::class)->name('vote');

Route::get('/index', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('index');
Route::get('/general', [App\Http\Controllers\GeneralSettingController::class, 'GeneralSetting'])->name('general');
});

Route::post('/update', [App\Http\Controllers\GeneralSettingController::class, 'updateSetting'])->name('update.GeneralSetting');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'ProductList'])->name('products');
Route::get('/add-product', [App\Http\Controllers\ProductController::class, 'addProduct'])->name('add-product');
Route::post('/store-product', [App\Http\Controllers\ProductController::class, 'storeProduct'])->name('store-product');
Route::post('/delete-product', [App\Http\Controllers\ProductController::class, 'delete'])->name('delete-product');


Route::get('/users', [App\Http\Controllers\UserController::class, 'users'])->name('users');
Route::post('/delete-user', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('delete-user');

Route::get('/view-feedback', [App\Http\Controllers\FeedbackController::class, 'feedbackList'])->name('view-feedback');
Route::post('/delete-feedback', [App\Http\Controllers\FeedbackController::class, 'delete'])->name('delete-feedback');

//frontend route
Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/product-detail/{product_id}', [App\Http\Controllers\HomeController::class, 'productDetail'])->name('product-detail');
Route::get('/login', [App\Http\Controllers\LoginController::class, 'userLogin'])->name('login');
Route::get('/register', [App\Http\Controllers\LoginController::class, 'registerIndex'])->name('registr');
Route::post('/user-register', [App\Http\Controllers\LoginController::class, 'userRegister'])->name('user-register');
Route::post('/authenticate-user', [App\Http\Controllers\LoginController::class, 'authenticateUser'])->name('authenticate-user');
Route::get('/user-logout', [App\Http\Controllers\LoginController::class, 'userLogout'])->name('user-logout');
Route::post('/store-comment', [App\Http\Controllers\HomeController::class, 'storeComment'])->name('store-comment');








