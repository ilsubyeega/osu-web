<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Tävla i andra sätt än att bara klicka cirklar.',
        'large' => 'Gemenskapstävlingar',
    ],

    'index' => [
        'nav_title' => '',
    ],

    'voting' => [
        'over' => 'Möjligheten att rösta i denna tävling har avslutats',
        'login_required' => 'Var vänlig logga in för att rösta.',

        'best_of' => [
            'none_played' => "Det ser inte ut som att du har spelat någon av beatmapsen som kvalificerar för denna tävling!",
        ],

        'button' => [
            'add' => 'Rösta',
            'remove' => 'Ta bort röstning',
            'used_up' => '',
        ],
    ],
    'entry' => [
        '_' => 'bidrag',
        'login_required' => 'Var vänlig logga in för att gå med i tävlingen.',
        'silenced_or_restricted' => 'Du kan inte gå med i en tävling när du är begränsad eller tystad.',
        'preparation' => 'Vi håller på att förbereda denna tävling. Var god vänta med tålamod!',
        'over' => 'Tack för era bidrag! Möjligheten att lägga till bidrag har stängt och röstning kommer öppnas snart.',
        'limit_reached' => 'Du har uppnått max antal bidrag i denna tävling',
        'drop_here' => 'Släpp ditt bidrag här',
        'download' => 'Ladda ner .osz',
        'wrong_type' => [
            'art' => 'Endast .jpg och .png filer är tillåtna i denna tävling.',
            'beatmap' => 'Endast .osu filer är tillåtna i denna tävling.',
            'music' => 'Endast .mp3 filer är tillåtna i denna tävling.',
        ],
        'too_big' => 'Bidrag till denna tävling får vara högst :limit.',
    ],
    'beatmaps' => [
        'download' => 'Ladda Ner Bidrag',
    ],
    'vote' => [
        'list' => 'röster',
        'count' => '',
        'points' => '',
    ],
    'dates' => [
        'ended' => 'Avlutad :date',
        'ended_no_date' => '',

        'starts' => [
            '_' => 'Startar :date',
            'soon' => 'snart™',
        ],
    ],
    'states' => [
        'entry' => 'Öppen För Bidrag',
        'voting' => 'Röstning Startad',
        'results' => 'Resultat Ute',
    ],
];
