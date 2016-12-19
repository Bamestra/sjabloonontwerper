<?php

namespace App\Http\Controllers;

use Response;
use App\Onderdeel;

class OnderdeelController extends Controller {

    public function verplaats($richting, $onderdeel_id) {

        // Vraag het geselecteerde onderdeel op.
        $onderdeel = Onderdeel::geef_onderdeel($onderdeel_id);

        // Verwissel de volgorde op de betrokken onderdelen.
        Onderdeel::verwissel_plaats($richting, $onderdeel);

        return Response::json();
    }

    public function create($onderdeel_id) {

        // Vraag het geselecteerde onderdeel op.
        $onderdeel = Onderdeel::geef_onderdeel($onderdeel_id);

        // Hernummer alle onderdelen die een volgorde nummer hoger hadden,
        // en tel bij de volgorde 1 op.
        Onderdeel::hernummer_volgorde($onderdeel, 1);

        // Maak het nieuwe onderdeel aan, met volgorde + 1.
        $last_insert_id = Onderdeel::create_onderdeel($onderdeel);

        // Vraag het nieuwe onderdeel op.
        $data = Onderdeel::geef_onderdeel($last_insert_id);

        return Response::json($data);
    }

    public function delete($onderdeel_id) {

        // Vraag het geselecteerde onderdeel op.
        $onderdeel = Onderdeel::geef_onderdeel($onderdeel_id);

        // Verwijder het onderdeel uit de database.
        Onderdeel::delete_onderdeel($onderdeel);

        // Hernummer alle onderdelen die een volgorde nummer hoger hadden,
        // en trek van de volgorde 1 af.
        Onderdeel::hernummerVolgorde($onderdeel, -1);

        return Response::json();
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
