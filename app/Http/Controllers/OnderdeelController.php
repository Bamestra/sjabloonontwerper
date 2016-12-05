<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnderdeelController extends Controller {

    // Geef de children van een geselecteerde tree node.
    public function geef_children(Request $request) {
        //return '[{"id":1,"text":"Root node","children":[{"id":2,"text":"Child node 1"},{"id":3,"text":"Child node 2"}]}]';

        $data = array();
        if ($id === "#") {
            $data = array(
                array("id" => "ajson1", "parent" => "#", "text" => "Simple root node"),
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
    }

}
