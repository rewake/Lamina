<?php

namespace Rewake\Lamina\Common\Conversions;

// Base length unit is Meter.
class Length
{
    public $Conversions_Length = [
        'm' => [
            'name' => 'Meter',
            'abbr' => ['M'],
            'conv' => 1,
        ],
        'Em' => [
            'name' => 'Exameter',
            'abbr' => ['Em'],
            'conv' => 1e-18,
        ],
        'Pm' => [
            'name' => 'Petameter',
            'abbr' => ['Pm'],
            'conv' => 1e-15,
        ],
        'Tm' => [
            'name' => 'Terameter',
            'abbr' => ['Tm'],
            'conv' => 1e-12,
        ],
        'Gm' => [
            'name' => 'Gigameter',
            'abbr' => ['Gm'],
            'conv' => .000000001,
        ],
        'Mm' => [
            'name' => 'Megameter',
            'abbr' => ['Mm'],
            'conv' => .000001,
        ],
        'km' => [
            'name' => 'Kilometer',
            'abbr' => ['km'],
            'conv' => .001,
        ],
        'hm' => [
            'name' => 'Hectometer',
            'abbr' => ['hm'],
            'conv' => .01,
        ],
        'dam' => [
            'name' => 'Dekaameter',
            'abbr' => ['dam'],
            'conv' => .1,
        ],
        'dm' => [
            'name' => 'Decimeter',
            'abbr' => ['dm'],
            'conv' => 10,
        ],
        'cm' => [
            'name' => 'Centimeter',
            'abbr' => ['cm'],
            'conv' => 100,
        ],
        'mm' => [
            'name' => 'Millimeter',
            'abbr' => ['mm'],
            'conv' => 1000,
        ],
        // NOTE: using "u" instead of correct "u" symbol for ease of use
        'um' => [
            'name' => 'Micrometer',
            'abbr' => ['um'],
            'conv' => 100000,
        ],
        // NOTE: using "u" instead of correct "u" symbol for ease of use
        'u' => [
            'name' => 'Micron',
            'abbr' => ['u'],
            'conv' => 100000,
        ],
        'nm' => [
            'name' => 'Nanometer',
            'abbr' => ['nm'],
            'conv' => 100000000,
        ],
        'pm' => [
            'name' => 'Picometer',
            'abbr' => ['pm'],
            'conv' => 1e+12,
        ],
        'fm' => [
            'name' => 'Femtoometer',
            'abbr' => ['pm'],
            'conv' => 1e+15,
        ],
        'Mpc' => [
            'name' => 'Megaparsec',
            'abbr' => ['Mpc'],
            'conv' => 3.24077929e-23,
        ],
        'kpc' => [
            'name' => 'Kiloparsec',
            'abbr' => ['kpc'],
            'conv' => 3.24077929e-20,
        ],
        'pc' => [
            'name' => 'Parsec',
            'abbr' => ['pc'],
            'conv' => 3.24077929e-17,
        ],
        'ly' => [
            'name' => 'Lightyear',
            'abbr' => ['Mpc'],
            'conv' => 1.057000834e-16,
        ],
        'AU' => [
            'name' => 'Astronomical Unit',
            'abbr' => ['AU', 'UA'],
            'conv' => 6.684587123e-12,
        ],
        // TODO: once you figure out how to translate multiple abbreviations, you might want to remove this even though it's common.
        'UA' => [
            'name' => 'Astronomical Unit',
            'abbr' => ['UA', 'AU'],
            'conv' => 6.684587123e-12,
        ],
        'lea' => [
            'name' => 'League',
            'abbr' => ['lea'],
            'conv' => .000207124,
        ],
        'n.league' => [
            'name' => 'Nautical League',
            'abbr' => ['n.league', 'n.lea'], // TODO: see if this is used
            'conv' => .000179871,
        ],
        // TODO: how do I do this one? See if there's one out there already.
        'n.league.i' => [
            'name' => 'Nautical League (International)',
            'abbr' => ['n.league.i', 'n.lea.i'],
            'conv' => .0001799986,
        ],
        'st.league' => [
            'name' => 'League (Statute)',
            'abbr' => ['st.league', 'st.lea'], // TODO: see if this is used
            'conv' => .000207123,
        ],
        'mi.i' => [
            'name' => 'Mile (International)',
            'abbr' => ['mi.i'],
            'conv' => .000621371,
        ],
    //    '' => [
    //        'name' => 'Nautical Mile (UK)',
    //        'abbr' => ['mi.i'],
    //        'conv' => .000621371,
    //    ],
    //    '' => [
    //        'name' => 'Nautical Mile (International)',
    //        'abbr' => ['mi.i'],
    //        'conv' => .000621371,
    //    ],
        'mi' => [
            'name' => 'Mile',
            'abbr' => ['mi'],
            'conv' => .00062137,
        ],
        'mi.r' => [
            'name' => 'Roman Mile',
            'abbr' => ['mi.r'],
            'conv' => .000675765,
        ],
        'kyd' => [
            'name' => 'Kiloyard',
            'abbr' => ['kyd'],
            'conv' => .001093613,
        ],
        'fur' => [
            'name' => 'Furlong',
            'abbr' => ['fur'],
            'conv' => .00497097,
        ],
        'fur.us' => [
            'name' => 'Furlong (US Survey)',
            'abbr' => ['fur.us'],
            'conv' => .00497096,
        ],
        'ch' => [
            'name' => 'Chain',
            'abbr' => ['ch'],
            'conv' => .049709695,
        ],
        'ch.us' => [
            'name' => 'Chain (US Survey)',
            'abbr' => ['ch'],
            'conv' => .049709596,
        ],

    ];
}
