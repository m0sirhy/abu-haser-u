<?php

Route::get('/', 'WelcomeController@index')->name('welcome')->middleware('auth');
;

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

    Route::get('/', 'WelcomeController@index')->name('welcome');

    //category routes
    Route::resource('categories', 'CategoryController')->except(['show']);

    //product routes
    Route::resource('products', 'ProductController')->except(['show']);

    //outlay routes
    Route::resource('outlays', 'OutlayController')->except(['show']);
    Route::get('outlay/categories', 'OutlayController@cat');

    //outlayscategory routes
    Route::resource('outlay_categories', 'OutlayCategoryController');

    //product routes
    //payment routes
    Route::resource('payments', 'PaymentController')->except(['show']);

    //client routes
    Route::resource('clients', 'ClientController')->except(['show']);
    Route::resource('clients.orders', 'Client\OrderController')->except(['show']);
    Route::resource('clients.orders_returns', 'Client\OrderReturnController')->except(['show']);

    //order routes
    Route::resource('orders', 'OrderController');
    Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');

    //order return routes

    Route::resource('orders_returns', 'OrderReturnController');
    Route::get('/orders_returns/{order_return}/products', 'OrderReturnController@products')->name('orders_returns.products');


    //supplier routes
    Route::resource('suppliers', 'SupplierController')->except(['show']);
    Route::resource('suppliers.purchaces', 'Supplier\PurchaceController')->except(['show']);

    //purchaces routes
    Route::resource('purchaces', 'PurchaceController');
    Route::get('/purchaces/{purchace}/products', 'PurchaceController@products')->name('purchaces.products');



    //user routes
    Route::resource('users', 'UserController')->except(['show']);

    Route::get('importExport', 'GateController@importExport')->name('importExport');
    Route::get('export', 'GateController@export')->name('export');
    Route::post('import', 'GateController@import')->name('import');
    Route::get('consume', function () {
        return view('dashboard.consumes.index');
    })->name('consume');
    Route::get('empty', 'ConsumeController@empty')->name('empty');
    Route::get('wrong', 'ConsumeController@wrong')->name('wrong');
    Route::get('disc', 'ConsumeController@disc')->name('disc');

}); //end of dashboard routes
