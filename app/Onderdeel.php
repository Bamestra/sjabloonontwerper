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
    
    // Hernummer alle onderdelen die onder deze staan.
    public static function hernummerVolgorde($onderdeel) {
        $sql1 = <<<EOD
UPDATE onderdeel
SET volgorde = volgorde + 1
WHERE parent_id = :parent_id
AND volgorde > :volgorde
EOD;
        DB::update($sql1, ['parent_id' => $onderdeel->parent_id, 'volgorde' => $onderdeel->volgorde]);
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
