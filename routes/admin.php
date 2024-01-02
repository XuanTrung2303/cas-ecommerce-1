<?php

use Illuminate\Support\Facades\Route;


Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {

    Route::get('/admin/home', 'AdminController@admin')->name('admin.home');
    Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');
    Route::get('/admin/password/change', 'AdminController@PasswordChange')->name('admin.password.change');
    Route::post('/admin/password/update', 'AdminController@PasswordUpdate')->name('admin.password.update');

    // Category routes
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::post('/store', 'CategoryController@store')->name('category.store');
        Route::get('/edit/{id}', 'CategoryController@edit');
        Route::post('/update', 'CategoryController@update')->name('category.update');
        Route::get('/delete/{id}', 'CategoryController@destroy')->name('category.delete');
    });

    // subCategory routes
    Route::group(['prefix' => 'subcategory'], function () {
        Route::get('/', 'SubcategoryController@index')->name('subcategory.index');
        Route::post('/store', 'SubcategoryController@store')->name('subcategory.store');
        Route::get('/edit/{id}', 'SubcategoryController@edit');
        Route::post('/update', 'SubcategoryController@update')->name('subcategory.update');
        Route::get('/delete/{id}', 'SubcategoryController@destroy')->name('subcategory.delete');
    });

    // childCategory routes
    Route::group(['prefix' => 'childcategory'], function () {
        Route::get('/', 'ChildcategoryController@index')->name('childcategory.index');
        Route::post('/store', 'ChildcategoryController@store')->name('childcategory.store');
        Route::get('/edit/{id}', 'ChildcategoryController@edit');
        Route::post('/update', 'ChildcategoryController@update')->name('childcategory.update');
        Route::get('/delete/{id}', 'ChildcategoryController@destroy')->name('childcategory.delete');
    });

    // Brand routes
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', 'BrandController@index')->name('brand.index');
        Route::post('/store', 'BrandController@store')->name('brand.store');
        Route::get('/edit/{id}', 'BrandController@edit');
        Route::post('/update', 'BrandController@update')->name('brand.update');
        Route::get('/delete/{id}', 'BrandController@destroy')->name('brand.delete');
    });

    // Setting routes
    Route::group(['prefix' => 'setting'], function () {
        // SEO Setting
        Route::group(['prefix' => 'seo'], function () {
            Route::get('/', 'SettingController@seo')->name('seo.setting');
            Route::post('/update/{id}', 'SettingController@seoUpdate')->name('seo.setting.update');
            // Route::get('/edit/{id}', 'BrandController@edit');
            // Route::post('/update', 'BrandController@update')->name('brand.update');
            // Route::get('/delete/{id}', 'BrandController@destroy')->name('brand.delete');
        });
    });
});
