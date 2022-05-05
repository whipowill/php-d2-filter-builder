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

];