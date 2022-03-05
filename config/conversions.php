<?php

// Used to convert item types that the game may recognize, but which
// the loot filter doesn't.

return [

	'ARMOR' => [
		#'HELM',
		'CHEST',
		#'SHIELD',
		#'GLOVES',
		#'BOOTS',
		#'BELT',
		#'CIRC',
	],
	'HELM' => [
		'HELM',
		'CIRC',
		'BARB',
		'DRU',
	],
	'MISSILE' => [
		'BOW',
	    'XBOW',
	],
	'WEAPON' => [
	    'AXE',
	    'MACE',
	    'SWORD',
	    #'DAGGER',
	    #'THROWING',
	    #'JAV',
	    'SPEAR',
	    'POLEARM',
	    #'BOW',
	    #'XBOX',
	    'STAFF',
	    #'WAND',
	    'SCEPTER',
	],
	'CLUB' => [
		'MACE',
	],
	'HAMMER' => [
		'MACE',
	],
	'CLAW' => [
		'SIN',
	],
	## preferences
	'PREF_ARMOR_NORMAL' => [
		'hla', 'stu', 'ltp', // hard leather, studded leather, light plate
	],
	'PREF_ARMOR_EXCEPTIONAL' => [
		'xla', 'xtu', 'xtp', // demonhide armor, trellised armor, mage plate
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

];