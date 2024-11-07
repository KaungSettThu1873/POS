<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;

// Register & Login

Route::middleware(['Admin_Auth'])->group(function(){
    Route::redirect('/','LoginPage');
    Route::get('/RegisterPage',[AuthController::class,'RegisterPageDirect'])->name('Register#Page');
    Route::get('/LoginPage',[AuthController::class,'LoginPageDirect'])->name('Login#Page');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    // Admin
    Route::group(['middleware'=>'Admin_Auth'],function(){
        Route::get('/AdminPasswordPage',[AdminController::class,'AdminPasswordPage'])->name('Admin#PasswordPage');
        Route::post('/AdminPasswordChange',[AdminController::class,'AdminPasswordChange'])->name('Admin#PasswordChange');
        Route::get('/AdminAccountPage',[AdminController::class,'AdminAccountPage'])->name('Admin#AccountPage');
        Route::get('/AdminAccountUpdatePage',[AdminController::class,'AdminAccountUpdatePage'])->name('Admin#AccountUpdatePage');
        Route::post('/AdminAccountUpdate/{id}',[AdminController::class,'AdminAccountUpdate'])->name('Admin#AccountUpdate');

        // Admin List Page
        Route::get('/AdminListPage',[AdminController::class,'AdminListPage'])->name('Admin#ListPage');
        Route::get('/AdminListEditPage/{id}',[AdminController::class,'AdminListEditPage'])->name('Admin#ListEditPage');
        Route::post('/AdminListEdit/{id}',[AdminController::class,'AdminListEdit'])->name('Admin#ListEdit');
        Route::get('/AdminDelete/{id}',[AdminController::class,'AdminDelete'])->name('Admin#Delete');
        Route::get('/AdminRoleChange',[AjaxController::class,'AdminRoleChange'])->name('Admin#RoleChange');

        //Products
        Route::get('/AdminProductsLists',[ProductController::class,'AdminProductsLists'])->name('Admin#ProductsLists');
        Route::get('/AdminProductsCreatePage',[ProductController::class,'AdminProductsCreatePage'])->name('Admin#ProductsCreatePage');
        Route::post('/AdminProductsCreate',[ProductController::class,'AdminProductsCreate'])->name('Admin#ProductsCreate');
        Route::get('/AdminProductDelete/{id}',[ProductController::class,'AdminProductDelete'])->name('Admin#ProductDelete');
        Route::get('/AdminProductDetail/{id}',[ProductController::class,'AdminProductDetail'])->name('Admin#ProductDetail');
        Route::get('/AdminProductEditPage/{id}',[ProductController::class,'AdminProductEditPage'])->name('Admin#ProductEditPage');
        Route::post('/AdminProductEdit/{id}',[ProductController::class,'AdminProductEdit'])->name('Admin#ProductEdit');

        //Order Lists
        Route::get('/OrderList',[OrderController::class,'OrderList'])->name('Order#List');
        Route::get('/OrderStatus',[OrderController::class,'OrderStatus'])->name('Order#Status');
        Route::get('/OrderStatusChange',[OrderController::class,'OrderStatusChange'])->name('Order#StatusChange');
        Route::get('/OrderDetailList/{orderCode}',[OrderController::class,'OrderDetailList'])->name('Order#DetailList');

        //User Lists
        Route::get('/UserListPage',[AdminController::class,'UserListPage'])->name('User#ListPage');
        Route::get('/UserListEditPage/{id}',[AdminController::class,'UserListEditPage'])->name('User#ListEditPage');
        Route::post('/UserListEdit/{id}',[AdminController::class,'UserListEdit'])->name('User#ListEdit');

        // Customer Message Lists
        Route::get('CustomerMessageLists',[AdminController::class,'CustomerMessageLists'])->name('Customer#MessageLists');
        Route::get('CustomerMessageDelete/{id}',[AdminController::class,'CustomerMessageDelete'])->name('Customer#MessageDelete');
        Route::get('CustomerMessageDetail/{id}',[AdminController::class,'CustomerMessageDetail'])->name('Customer#MessageDetail');

    });



    // Admin
    Route::group(['prefix'=>'Category','middleware'=>'Admin_Auth'],function(){
        Route::get('/list',[CategoryController::class,'CategoryLists'])->name("Category#lists");
        Route::get('/CreatePage',[CategoryController::class,'CategoryCreatePage'])->name('Category#createPage');
        Route::post('/Create',[CategoryController::class,'CategoryCreate'])->name('Category#Create');
        Route::get('/Delete/{id}',[CategoryController::class,'CategoryDelete'])->name('Category#Delete');
        Route::get('/EditPage/{id}',[CategoryController::class,'CategoryEditPage'])->name('Category#EditPage');
        Route::post('/Update',[CategoryController::class,'CategoryUpdate'])->name('Category#Update');


    });

    //User
    Route::group(['prefix'=>'User','middleware'=>'User_Auth'],function(){
        Route::get('/Home',[UserController::class,'UserHome'])->name('User#Home');
        Route::get('/ProductsDetail/{id}',[UserController::class,'UserProductsDetail'])->name('User#ProductsDetail');
        Route::get('OrderList/{id}',[UserController::class,'UserOrderList'])->name('User#OrderList');


        //User Account
        Route::get('/AccountPasswordPage',[UserController::class,'UserAccountPasswordPage'])->name('User#AccountPasswordPage');
        Route::post('/PasswordChange',[UserController::class,'UserPasswordChange'])->name('User#PasswordChange');
        // Route::get('/AccountDetail',[UserController::class,'UserAccountDetail'])->name('User#AccountDetail');
        Route::get('/AccountEdit',[UserController::class,'UserAccountEdit'])->name('User#AccountEdit');
        Route::post('/UserAccountUpdate/{id}',[UserController::class,'UserAccountUpdate'])->name('User#AccountUpdate');

        //Cart
        Route::get('/CartPage/{id}',[CartController::class,'CartPage'])->name('Cart#Page');


        //Contact
        Route::get('/ContactPage',[ContactController::class,'ContactPage'])->name('Contact#Page');
        Route::post('/ContactAdmin',[ContactController::class,'ContactAdmin'])->name('Contact#Admin');

        //Ajax
        Route::get('/AjaxProductsList',[AjaxController::class,'AjaxProductsList'])->name('Ajax#ProductsList');
        Route::get('/AddToCart',[AjaxController::class,'AddToCart'])->name('Add#ToCart');
        Route::get('/Order',[AjaxController::class,'Order'])->name('Ajax#Order');
        Route::get('ClearCart',[AjaxController::class,'ClearCart'])->name('Clear#Cart');
        Route::get('CurrentClearCart',[AjaxController::class,'CurrentClearCart'])->name('Current#ClearCart');
        Route::get('/AjaxViewCount',[AjaxController::class,'AjaxViewCount'])->name('Ajax#ViewCount');

        //Filter
        Route::get('/CategoryFilter/{id}',[UserController::class,'CategoryFilter'])->name('Category#Filter');

    });


});





