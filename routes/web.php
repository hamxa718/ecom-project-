<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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


Route::get('home', 'admin\orderController@dashboard')->name('home')->middleware('admin');
Route::middleware(['admin'])->group(function () {

//admin category routes
Route::get('/viewCategory', 'admin\categoryController@allCategory')->name('viewCategory');
Route::get('/add-category', 'admin\categoryController@index')->name('add-category');
Route::get('deletecategory/{id}', 'admin\categoryController@deleteCategory')->name('deletecategory');
Route::get('editCategory/{id}', 'admin\categoryController@editCategory')->name('editcategory');
Route::post('categoryUpdate/{id}', 'admin\categoryController@categoryUpdate')->name('categoryUpdate');
Route::post('category_submit', 'admin\categoryController@store')->name('category_submit');
//admin product routes
Route::get('/addProduct', 'admin\productController@index')->name('addProduct');
Route::post('/productSubmit', 'admin\productController@store')->name('productSubmit');
Route::get('/viewProduct', 'admin\productController@allProduct')->name('viewProduct');
Route::get('/deleteProduct/{id}', 'admin\productController@deleteProduct')->name('deleteProduct');
Route::get('/editProduct/{id}', 'admin\productController@editProduct')->name('editProduct');
Route::post('/productUpdate/{id}', 'admin\productController@productUpdate')->name('productUpdate');
//admin order routes
Route::get('allorders', 'admin\orderController@allorder')->name('allorders');
Route::get('/viewOrderProduct/{id}', 'admin\orderController@allorderproducts')->name('viewOrderProduct');
});
//user panel

route::get('user','user\categoryController@index')->name('user')->middleware('user');
route::get('index','user\categoryController@index')->name('index');
route::get('shop','user\productController@shopsProduct')->name('shop');
route::get('shopdetails/{id}','user\productController@shopsDetails')->name('shopdetails');
route::get('categoriesShop/{id}','user\productController@categoriesShop')->name('categoriesShop');
route::view('aboutUs','user.aboutus')->name('aboutUs');
route::view('contactUs','user.contactus')->name('contactUs');
route::get('orderstatuspage','user\orderController@orderstatuspage')->name('orderstatuspage');
route::get('/myorders/{id}','user\orderController@myorders')->name('myorders');
route::get('/downloadorderid/{id}','user\orderController@downloadorderid')->name('downloadorderid');


route::post('/searchorder','user\orderController@searchorder')->name('searchorder');
route::get('/statuschange','user\orderController@statuschange')->name('statuschange');
route::get('/shopsearch','user\productController@shopsearch')->name('shopsearch');
//cart
route::get('/addToCart/{id}','user\cartController@addtocart')->name('addToCart');
route::get('/cartShow','user\cartController@cartShow')->name('cartShow');
route::get('/cartdata','user\cartController@cartdata')->name('cartdata');
route::get('/deleteCartItem/{id}','user\cartController@deleteCartItem')->name('deleteCartItem');
route::get('/deleteCart','user\cartController@deleteCart')->name('deleteCart');
route::get('/cartQuantityIncrease','user\cartController@cartQuantityIncrease')->name('cartQuantityIncrease');
route::get('/cartQuantityDecrease','user\cartController@cartQuantityDecrease')->name('cartQuantityDecrease');
//checkout
route::get('/checkOut','user\orderController@index')->name('checkOut');
route::post('/placeorder','user\orderController@placeorder')->name('placeorder');

Route::get('/stripeCheckout','user\orderController@checkout');
Route::post('/Stripecheckout','user\orderController@afterpayment')->name('stripeAfterCheckout');

Route::view('/thankyou','user.thankyou');
route::get('/logout','HomeController@logout')->name('logout');
Auth::routes();
