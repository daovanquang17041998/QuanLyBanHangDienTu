<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout.header',function ($view){
            $loai_sp = Category::all();
            $view->with('loai_sp',$loai_sp);
        });
        view()->composer('layout.header',function ($view){
            if(Session('cart')){
                $old_cart = Session::get('cart');
                $cart = new Cart($old_cart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
        view()->composer('page.dat_hang',function ($view){
            $loai_sp = ProductType::all();
            $view->with('loai_sp',$loai_sp);
        });
        view()->composer('page.dat_hang',function ($view){
            if(Session('cart')){
                $old_cart = Session::get('cart');
                $cart = new Cart($old_cart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
    }
}
