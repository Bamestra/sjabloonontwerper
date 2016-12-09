<?php

namespace App\Http\Controllers;

use Response;
use App\Onderdeel;

class OnderdeelController extends Controller {

    public function create($onderdeel_id) {

        // Vraag het geselecteerde onderdeel op.
        $onderdeel = Onderdeel::geef_onderdeel($onderdeel_id);
                
        // Hernummer alle onderdelen met een volgorde hoger dan de geselecteerde.
        Onderdeel::hernummerVolgorde($onderdeel);
        
        // Maak het nieuwe onderdeel aan, met volgorde + 1.
        $last_insert_id = Onderdeel::create_onderdeel($onderdeel);
        
        // Vraag het nieuwe onderdeel op.
        $data = Onderdeel::geef_onderdeel($last_insert_id);

        return Response::json($data);
    }

    public function children($parent_id) {
        $data = Onderdeel::geef_children($parent_id);

        foreach ($data as $onderdeel) {
            // De query geeft als resultaat een 0/1. Zet om voor jsTree.
            if ($onderdeel->children === 1) {
                $onderdeel->children = true;
            } else {
                $onderdeel->children = false;
            }
        }
        return Response::json($data);
    }

    // Een aparte functie om de pagina's op te vragen.
    // Reden hiervoor is dat bij het opvragen van de children niet steeds
    // ook het sjabloon_id mee hoeft te worden gegeven. En dat is voor de
    // pagina's wel nodig.
    public function paginas($sjabloon_id) {
        $data = Onderdeel::geef_paginas($sjabloon_id);

        foreach ($data as $onderdeel) {
            // De query geeft als resultaat een 0/1. Zet om voor jsTree.
            if ($onderdeel->children === 1) {
                $onderdeel->children = true;
            } else {
                $onderdeel->children = false;
            }
        }
        return Response::json($data);
    }

}
