<?php

return [

    // Will supress any output that involves superior weapons.
    'is_ignore_superior' => true,

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
        'CIRC' => [
            'ci0', 'ci1', 'ci2', 'ci3',
        ],
        'NORM BARB' => [
            'ba1', 'ba2', 'ba3', 'ba4', 'ba5',
        ],
        'EXC BARB' => [
            'ba6', 'ba7', 'ba8', 'ba9', 'baa',
        ],
        'ELT BARB' => [
            'bab', 'bac', 'bad', 'bae', 'baf',
        ],
        'NORM DRU' => [
            'dr1', 'dr2', 'dr3', 'dr4', 'dr5',
        ],
        'EXC DRU' => [
            'dr6', 'dr7', 'dr8', 'dr9', 'dra',
        ],
        'ELT DRU' => [
            'drb', 'drc', 'drd', 'dre', 'drf',
        ],
        'NORM DIN' => [
            'pa1', 'pa2', 'pa3', 'pa4', 'pa5',
        ],
        'EXC DIN' => [
            'pa6', 'pa7', 'pa8', 'pa9', 'paa',
        ],
        'ELT DIN' => [
            'pab', 'pac', 'pad', 'pae', 'paf',
        ],
        'NORM STAFF' => [
            'sst', 'lst', 'cst', 'bst', 'wst',
        ],
        'EXC STAFF' => [
            '8ss', '8ls', '8cs', '8bs', '8ws',
        ],
        'ELT STAFF' => [
            '6ss', '6ls', '6cs', '6bs', '6ws',
        ],
        'NORM WAND' => [
            'wnd', 'ywn', 'bwn', 'gwn',
        ],
        'EXC WAND' => [
            '9wn', '9yw', '9bw', '9gw',
        ],
        'ELT WAND' => [
            '7wn', '7yw', '7bw', '7gw',
        ],
        'NORM SCEPTER' => [
            'scp', 'gsc', 'wsp',
        ],
        'EXC SCEPTER' => [
            '9sc', '9qs', '9ws',
        ],
        'ELT SCEPTER' => [
            '7sc', '7qs', '7ws',
        ],
        'NORM SIN' => [
            'clw', 'btl', 'skr',
        ],
        'EXC SIN' => [
            '9lw', '9tw', '9qr',
        ],
        'ELT SIN' => [
            '7ar', '7wb', '7lw', '7tw', '7qr'
        ],
    ],

    // Whenever these items are used we always add these params.
    'params' => [
        // pally shields always want +35 resistance
        'NORM DIN' => 'RES>34',
        'EXC DIN' => 'RES>34',
        'ELT DIN' => 'RES>34',
        // barb hats always want +battle orders
        'NORM BARB' => 'SK149>0',
        'EXC BARB' => 'SK149>1',
        'ELT BARB' => 'SK149>2',
        // druid pelts always want +tornado or +oak sage or +hotw or +werewolf or +shapeshifting or +spirit wolf or +dire wolf
        'NORM DRU' => '(SK245>0 OR SK226>0 OR SK236>0 OR SK223>0 OR SK224>0 OR SK227>0 OR SK237>0)',
        'EXC DRU' => '(SK245>1 OR SK226>1 OR SK236>1 OR SK223>1 OR SK224>1 OR SK227>1 OR SK237>1)',
        'ELT DRU' => '(SK245>2 OR SK226>2 OR SK236>2 OR SK223>2 OR SK224>2 OR SK227>2 OR SK237>2)',
        // assassin claws always want +lightning sentry or +venom
        'NORM SIN' => '(SK271>0 OR SK278>0)',
        'EXC SIN' => '(SK271>1 OR SK278>1)',
        'ELT SIN' => '(SK271>2 OR SK278>2)',
        '9tw' => '(SK271>2 OR SK278>2)', // greater talons bc I referenced it specifically for chaos
        // pally scepter always want +3 conviction or +3 fist of heavens
        'NORM SCEPTER' => '(SK121>2 OR SK123>2)',
        'EXC SCEPTER' => '(SK121>2 OR SK123>2)',
        'ELT SCEPTER' => '(SK121>2 OR SK123>2)',
        // sorc staves always want +enchant or +energy shield
        'NORM STAFF' => '(SK52>0 OR SK58>0)',
        'EXC STAFF' => '(SK52>1 OR SK58>1)',
        'ELT STAFF' => '(SK52>2 OR SK58>2)',
        // nercro wands always want +bone spear
        'NORM WAND' => 'SK84>2',
        'EXC WAND' => 'SK84>2',
        'ELT WAND' => 'SK84>2',
        // amazon bows always want +amazon skills
        'am1' => 'TABSK0>0',
        'am2' => 'TABSK0>0',
        'am6' => 'TABSK0>1',
        'am7' => 'TABSK0>1',
        'amb' => 'TABSK0>2',
        'amc' => 'TABSK0>2',
    ],

];