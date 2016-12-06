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

Route::get('onderdelen/{sjabloon_id}/{id}', function ($sjabloon_id, $id) {

    $sql1 = <<<EOD
SELECT P.id AS id,
       CASE P.parent_id WHEN 0 THEN '#' ELSE P.parent_id END AS parent,
       P.naam AS text,
       P.soort,
       COUNT(C.id) > 0 AS children
FROM onderdeel P
LEFT JOIN onderdeel C ON C.parent_id = P.id
WHERE P.sjabloon_id = :sjabloon_id
  AND P.parent_id = :parent_id
GROUP BY P.id
ORDER BY P.volgorde
EOD;
    $data = DB::select($sql1, ['sjabloon_id' => $sjabloon_id, 'parent_id' => $id]);

    foreach ($data as $onderdeel) {

        // De query geeft als resultaat een 0/1. Zet om voor jsTree.
        if ($onderdeel->children === 1) {
            $onderdeel->children = true;
        } else {
            $onderdeel->children = false;
        }
    }

    return response($data, 200)
                    ->header('Content-Type', 'application/json');
});
