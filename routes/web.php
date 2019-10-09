<?php

Route::get('/welcome', function () {
    return view('welcome');
});
/* user */
Route::get('dang-nhap',['as'=>'dangnhap', 'uses'=>'PageController@getLogin']);

Route::post('dang-nhap',['as'=>'dangnhap', 'uses'=>'PageController@postLogin']);

Route::get('dang-xuat',['as'=>'dangxuat', 'uses'=>'PageController@getLogout']);

Route::get('dang-ky',['as'=>'dangky', 'uses'=>'PageController@getSignup']);

Route::post('dang-ky',['as'=>'dangky', 'uses'=>'PageController@postSignup']);

Route::get('tim-kiem',['as'=>'search', 'uses'=>'PageController@getSearch']);

Route::get('loai-san-pham/{type}',['as'=>'loaisanpham','uses'=>'PageController@getLoaisanpham']);

Route::get('chi-tiet-san-pham/{id}',['as'=>'chitietsanpham', 'uses'=>'PageController@getChitietsanpham']);

Route::get('lien-he',['as'=>'thongtinlienhe', 'uses'=>'PageController@getLienhe']);

Route::get('gioi-thieu',['as'=>'gioithieu', 'uses'=>'PageController@getGioithieu']);

Route::get('add-to-cart/{id}',['as'=>'themgiohang', 'uses'=>'PageController@getAddToCart']);

Route::get('del-cart/{id}',['as'=>'xoagiohang', 'uses'=>'PageController@getDelItemCart']);

Route::get('dat-hang',['as'=>'dathang', 'uses'=>'PageController@getCheckout']);

Route::post('dat-hang',['as'=>'dathang', 'uses'=>'PageController@postCheckout']);

Route::get('/',['as'=>'trang-chu','uses'=>'PageController@getIndexPage']);

Route::get('danh-muc/{id}/{url}',['as'=>'chuyen-muc','uses'=>'PageController@getCategory']);

Route::get('san-pham/{id}/{url}',['as'=>'san-pham','uses'=>'PageController@getDetailProduct']);

Route::group(['prefix'=>'user','middleware'=>'userLogin'], function (){

    Route::get('profile',['as'=>'user.profile', 'uses'=>'PageController@getUserProfile']);

    Route::post('profile',['as'=>'user.profile', 'uses'=>'PageController@postEditProfile']);

    Route::get('password',['as'=>'get.password', 'uses'=>'PageController@getChangePassword']);

    Route::post('password',['as'=>'post.password', 'uses'=>'PageController@postChangePassword']);

    Route::get('danh-sach-hoa-don',['as'=>'list.bill', 'uses'=>'PageController@getListBill']);

    Route::post('danh-sach-hoa-don','AjaxController@postAjaxShowBills');
});
/* admin */

/*login*/
Route::get('admin/dang-nhap','Admin\UserController@getAdminLogin');

Route::post('admin/dang-nhap','Admin\UserController@postAdminLogin');

Route::get('admin/logout','Admin\UserController@getAdminLogout');

/*admin*/

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'loginAdmin'],function(){
    /*trang chủ*/
    Route::get('/',['as'=>'admin-index','uses'=>'CategoryController@getIndexAdmin']);
    /*trang danh mục*/
    Route::group(['prefix'=>'danh-muc'],function(){
        Route::get("them",['as'=>'themdanhmuc','uses'=>'CategoryController@getAddCate']);

        Route::post("them",['as'=>'themdanhmuc','uses'=>'CategoryController@postAddCate']);

        Route::get("sua/{id}",['as'=>'suadanhmuc','uses'=>'CategoryController@getEditCate']);

        Route::post("sua/{id}",['as'=>'suadanhmuc','uses'=>'CategoryController@postEditCate']);

        Route::get("danh-sach",['as'=>'listdanhmuc','uses'=>'CategoryController@getListCate']);

        Route::get('xoa/{id}',"CategoryController@getDelCate");

    });
    /*trang sản phẩm*/
    Route::group(['prefix'=>'san-pham'],function () {

        Route::get("them",['as'=>'themsanpham','uses'=>'ProductController@getAddProduct']);

        Route::post("them",['as'=>'themsanpham','uses'=>'ProductController@postAddProduct']);

        Route::get("danh-sach",['as'=>'listsanpham','uses'=>'ProductController@getListProduct']);

        Route::get("sua/{id}","ProductController@getEditProduct");

        Route::post("sua/{id}","ProductController@postEditProduct");

        Route::get('xoa/{id}',"ProductController@getDelProduct");

        Route::get('chi-tiet/{id}',['as'=>'admin.detail.product', 'uses'=>'ProductController@getDetailProduct']);

        Route::get('chi-tiet/xoa/{id}','ProductController@getDelDetailProduct');

    });
    /*trang nhà cung cấp*/

    Route::group(['prefix'=>'nha-cung-cap'],function (){
        Route::get('danh-sach','SupplierController@getListSupplier');

        Route::get('them','SupplierController@getAddSupplier');

        Route::post('them','SupplierController@postAddSupplier');

        Route::get('sua/{id}','SupplierController@geteditSupplier');

        Route::post('sua/{id}','SupplierController@postEditSupplier');

        Route::get('xoa/{id}','SupplierController@getDelSupplier');

    });
    /*trang nhập hàng*/

    Route::group(['prefix'=>'nhap-hang'],function (){

        Route::get('danh-sach','BillImportController@getListBillImport');

        Route::get('xoa/{id}','BillController@getDelBillImport');

        Route::get('chi-tiet/{id}',['as'=>'admin.detail.billimport', 'uses'=>'BillController@getDetailBillImport']);

        Route::get('chi-tiet/xoa/{id}','BillController@getDelDetailBillImport');
    });
    /*trang đơn hàng*/

    Route::group(['prefix'=>'don-hang'],function (){

        Route::get('danh-sach','BillController@getListBill');

        Route::get('xoa/{id}','BillController@getDelBill');

        Route::get('chi-tiet/{id}',['as'=>'admin.detail.bill', 'uses'=>'BillController@getDetailBill']);

        Route::get('chi-tiet/xoa/{id}','BillController@getDelDetailBill');
    });
    /*trang tài khoản*/

    Route::group(['prefix'=>'user'],function (){
        Route::get('them','UserController@getAddUser');

        Route::post('them','UserController@postAddUser');

        Route::get('danh-sach','UserController@getListUser');

        Route::get('sua/{id}','UserController@getEditUser');

        Route::post('sua/{id}','UserController@postEditUser');

        Route::get('xoa/{id}','UserController@getDelUser');


    });
});


