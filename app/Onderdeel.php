<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Onderdeel extends Model {

    protected $table = 'onderdeel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naam',
    ];

    public static function delete_onderdeel($onderdeel) {
        return DB::table('onderdeel')->where('id', $onderdeel->id)->delete();
    }

    public static function verwissel_plaats($richting, $onderdeel) {
        if ($richting === "omhoog") {
            // Verplaats het hogere onderdeel omlaag.
            $sql1 = 'UPDATE onderdeel SET volgorde = volgorde + 1 WHERE volgorde = :volgorde - 1 AND parent_id = :parent_id; ';
            // Verplaats het lagere onderdeel omhoog.
            $sql2 = 'UPDATE onderdeel SET volgorde = volgorde - 1 WHERE id = :id AND volgorde > 1';

            DB::update($sql1, ['volgorde' => $onderdeel->volgorde, 'parent_id' => $onderdeel->parent_id]);
            DB::update($sql2, ['id' => $onderdeel->id]);
        } else {
            // Verplaats het lagere onderdeel omhoog.
            $sql1 = 'UPDATE onderdeel SET volgorde = volgorde - 1 WHERE volgorde = :volgorde + 1 AND parent_id = :parent_id';
            $affected_rows = DB::update($sql1, ['volgorde' => $onderdeel->volgorde, 'parent_id' => $onderdeel->parent_id]);

            // Als het gekozen onderdeel onderaan staat heeft de bovenstaande UPDATE geen rows gewijzigd.
            // Als dat zo is maken we de volgorde van de onderste ook niet hoger.
            if ($affected_rows > 0) {
                // Verplaats het hogere onderdeel omlaag.
                $sql2 = 'UPDATE onderdeel SET volgorde = volgorde + 1 WHERE id = :id';
                DB::update($sql2, ['id' => $onderdeel->id]);
            }
        }
    }

    // Hernummer alle onderdelen die onder deze staan.
    public static function hernummer_volgorde($onderdeel, $optel) {
        $sql1 = <<<EOD
UPDATE onderdeel
SET volgorde = volgorde + :optel
WHERE parent_id = :parent_id
AND volgorde > :volgorde
EOD;
        DB::update($sql1, ['parent_id' => $onderdeel->parent_id, 'volgorde' => $onderdeel->volgorde, 'optel' => $optel]);
    }

    // Maak een nieuwe onderdeel dat in de boom onder deze komt.
    public static function create_onderdeel($onderdeel) {
        return DB::table('onderdeel')->insertGetId(
                        array(
                            'sjabloon_id' => $onderdeel->sjabloon_id,
                            'parent_id' => $onderdeel->parent_id,
                            'volgorde' => $onderdeel->volgorde + 1,
                            'naam' => 'Nieuw onderdeel',
                            'soort' => 1)
        );
    }

    public static function geef_onderdeel($onderdeel_id) {
        return DB::table('onderdeel')->where('id', $onderdeel_id)->first();
    }

    public static function geef_paginas($sjabloon_id) {
        $sql1 = <<<EOD
SELECT P.id AS id,
       '#' AS parent,
       P.naam AS text,
       P.soort,
       COUNT(C.id) > 0 AS children
FROM onderdeel P
LEFT JOIN onderdeel C ON C.parent_id = P.id
WHERE P.sjabloon_id = :sjabloon_id
    AND P.parent_id = 0
GROUP BY P.id
ORDER BY P.volgorde
EOD;
        return DB::select($sql1, ['sjabloon_id' => $sjabloon_id]);
    }

    public static function geef_children($onderdeel_id) {
        $sql1 = <<<EOD
SELECT P.id AS id,
       CASE P.parent_id WHEN 0 THEN '#' ELSE P.parent_id END AS parent,
       P.naam AS text,
       P.soort,
       COUNT(C.id) > 0 AS children
FROM onderdeel P
LEFT JOIN onderdeel C ON C.parent_id = P.id
WHERE P.parent_id = :parent_id
GROUP BY P.id
ORDER BY P.volgorde
EOD;
        return DB::select($sql1, ['parent_id' => $onderdeel_id]);
    }

}
