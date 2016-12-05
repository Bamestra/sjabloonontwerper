<?php

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

Route::get('/', 'SjabloonController@index');

Route::resource('sjabloon', 'SjabloonController');
//Route::post('sjabloon', 'SjabloonController@store');
//Route::get('onderdelen', 'OnderdeelController@geef_children');

Route::get('onderdelen', function () {

//    $data = array(
//        array("id" => "ajson1", "parent" => "#", "text" => "Simple root node1"),
//        array("id" => "ajson2", "parent" => "#", "text" => "Root node 2", "children" => true),
//    );
    
    $data = array(
        array("id" => "ajson1", "parent" => "#", "text" => "Sjabloon"),
    );

    return response($data, 200)
                        ->header('Content-Type', 'application/json');
});

Route::get('onderdelen/{id}', function ($id) {

    $data = array();
    if ($id === "#") {
        $data = array(
            array("id" => "ajson1", "parent" => "#", "text" => "Simple root node2"),
            array("id" => "ajson2", "parent" => "#", "text" => "Root node 2", "children" => true),
        );
    } else if ($id === "ajson2") {
        $data = array(
            array("id" => "ajson3", "parent" => "ajson2", "text" => "Child 1"),
            array("id" => "ajson4", "parent" => "ajson2", "text" => "Child 2")
        );
    }

    return response($data, 200)
                        ->header('Content-Type', 'application/json');
});
