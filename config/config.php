<?php

return [

    // Will supress any output that involves superior weapons.
    'is_ignore_superior' => true,

    // Whenever these item types are used we always add these params.
    'params' => [
        'DIN' => 'RES>34', // pally shields always want +35 resistance
        'BARB' => 'SK149>2', // barb hats always want +3 battle orders
        'DRU' => 'SK245>2', // druid pelts always want +3 tornado
        'SIN' => '(SK271>2 OR SK278>2)', // assassin claws always want +3 lightning sentry or +3 venom
        'SCEPTER' => '(SK121>2 OR SK123>2)', // pally scepter always want +3 conviction or +3 fist of heavens
        'STAFF' => '(SK52>2 OR SK58>2)', // sorc staves always want +3 enchant or +3 energy shield
        'WAND' => 'SK84>2', // nercro wands always want +3 bone spear
        'am1' => 'TABSK0>0', // normal amazon bows always want +1 amazon skills
        'am2' => 'TABSK0>0', // normal amazon bows always want +1 amazon skills
        'am6' => 'TABSK0>1', // exceptional amazon bows always want +2 amazon skills
        'am7' => 'TABSK0>1', // exceptional amazon bows always want +2 amazon skills
        'amb' => 'TABSK0>2', // elite amazon bows always want +3 amazon skills
        'amc' => 'TABSK0>2', // elite amazon bows always want +3 amazon skills
    ],

    // Set the colors you want to use on tier item notifications.
    'tiers' => [
        'colors' => [
            1 => '%ORANGE%',
            2 => '%PURPLE%',
            3 => '%RED%',
            4 => '%GOLD%',
            5 => '%SAGE%',
            6 => '%LIGHT_GRAY%',
        ],
    ],

    // Use shorthand code references in your spreadsheets.
    'codes' => [
        'PREF_ARMOR_NORMAL' => [
            'stu', 'ltp', // studded leather, light plate
        ],
        'PREF_ARMOR_EXCEPTIONAL' => [
            'xtu', 'xtp', // trellised armor, mage plate
        ],
        'PREF_ARMOR_ELITE' => [
            'utu', 'utp', 'uui', // wire fleece, archon plate, dusk shroud
        ],
        'PREF_POLES_NORMAL' => [
            'scy', 'wsc', // scythe, war scythe
        ],
        'PREF_POLES_EXCEPTIONAL' => [
            '9s8', '9wc', // battle scythe, grim scythe
        ],
        'PREF_POLES_ELITE' => [
            '7s8', '7wc', // thresher, giant thresher
        ],
    ],

];