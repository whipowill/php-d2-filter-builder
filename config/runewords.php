<?php

// based on https://github.com/fabd/diablo2-runewizard/blob/main/src/data/runewords.js
// modified to include preferential items lists

return [
	/* 1.09 */
	[
		"title" => "Ancient's Pledge",
		"runes" => ["Ral", "Ort", "Tal"],
		"level" => 21,
		"bases" => ["SHIELD"],
		"prefer" => ["kit", "xit"], // kite shield, dragon shield
	],
	[
		"title" => "Black",
		"runes" => ["Thul", "Io", "Nef"],
		"level" => 35,
		"bases" => ["CLUB", "HAMMER", "MACE"],
		"prefer" => ["fla", "9fl"], // flail, knout
	],
	[
		"title" => "Fury",
		"runes" => ["Jah", "Gul", "Eth"],
		"level" => 65,
		"bases" => ["WEAPON"],
		"prefer" => ["7wa", "ELT SIN"], // berserker axe, elite claws
	],
	[
		"title" => "Holy Thunder",
		"runes" => ["Eth", "Ral", "Ort", "Tal"],
		"level" => 21,
		"bases" => ["SCEPTER"],
		"prefer" => ["wsp", "9ws"], // war scepter, divine scepter
	],
	[
		"title" => "Honor",
		"runes" => ["Amn", "El", "Ith", "Tir", "Sol"],
		"level" => 27,
		"bases" => ["WEAPON"],
		"prefer" => ["PREF_POLES_NORMAL", "PREF_POLES_EXCEPTIONAL", "wax", "9wa", "flb", "9fb", "wsp", "9ws"], // normal and exceptional polearms, war axe, naga, flamberge, zweihander, war scepter, divine scepter
	],
	[
		"title" => "King's Grace",
		"runes" => ["Amn", "Ral", "Thul"],
		"level" => 25,
		"bases" => ["SWORD", "SCEPTER"],
		"prefer" => ["wsp", "9ws"], // war scepter, divine scepter
	],
	[
		"title" => "Leaf",
		"runes" => ["Tir", "Ral"],
		"level" => 19,
		"bases" => ["STAFF"],
		"tinfos" => "Not Orbs/WAND",
		"prefer" => ["NORM STAFF"], // normal staves
	],
	[
		"title" => "Lionheart",
		"runes" => ["Hel", "Lum", "Fal"],
		"level" => 41,
		"bases" => ["ARMOR"],
		"prefer" => ["PREF_ARMOR_EXCEPTIONAL"], // exceptional armors
	],
	[
		"title" => "Lore",
		"runes" => ["Ort", "Sol"],
		"level" => 27,
		"bases" => ["HELM"],
		"prefer" => ["CIRC", "BARB", "DRU"], // could limit to NORM only?
	],
	[
		"title" => "Malice",
		"runes" => ["Ith", "El", "Eth"],
		"level" => 15,
		"bases" => ["WEAPON"],
		"prefer" => ["PREF_POLES_NORMAL"], // normal polearms (assuming would only use on merc due to life drain issues)
	],
	[
		"title" => "Melody",
		"runes" => ["Shael", "Ko", "Nef"],
		"level" => 39,
		"bases" => ["MISSILE"],
		"prefer" => ["am6", "am7"], // ashwood bow, ceremonial bow
	],
	[
		"title" => "Memory",
		"runes" => ["Lum", "Io", "Sol", "Eth"],
		"level" => 37,
		"bases" => ["STAFF"],
		"tinfos" => "Not Orbs",
		"prefer" => ["EXC STAFF"], // exceptional staves
	],
	[
		"title" => "Nadir",
		"runes" => ["Nef", "Tir"],
		"level" => 13,
		"bases" => ["HELM"],
		"prefer" => [], // nobody uses this
	],
	[
		"title" => "Radiance",
		"runes" => ["Nef", "Sol", "Ith"],
		"level" => 27,
		"bases" => ["HELM"],
		"prefer" => ["CIRC", "BARB", "DRU", "uh9"], // class helms, bone visage
	],
	[
		"title" => "Rhyme",
		"runes" => ["Shael", "Eth"],
		"level" => 29,
		"bases" => ["SHIELD"],
		"prefer" => ["bsh", "xsh", "NORM DIN", "EXC DIN"], // bone shield, grim shield, normal and exceptional paladin shields
	],
	[
		"title" => "Silence",
		"runes" => ["Dol", "Eld", "Hel", "Ist", "Tir", "Vex"],
		"level" => 55,
		"bases" => ["WEAPON"],
		"prefer" => ["amb", "amc", "7gd"], // matriarchal bow, grand matron bow, colossus blade (HT kruggers)
	],
	[
		"title" => "Smoke",
		"runes" => ["Nef", "Lum"],
		"level" => 37,
		"bases" => ["ARMOR"],
		"prefer" => ["PREF_ARMOR_EXCEPTIONAL"], // exceptional armors
		"is_priority" => true,
	],
	[
		"title" => "Stealth",
		"runes" => ["Tal", "Eth"],
		"level" => 17,
		"bases" => ["ARMOR"],
		"prefer" => ["PREF_ARMOR_NORMAL"], // normal armors
	],
	[
		"title" => "Steel",
		"runes" => ["Tir", "El"],
		"level" => 13,
		"bases" => ["SWORD", "AXE", "MACE"],
		"prefer" => ["lsd", "flb", "2ax", "wax", "fla"], // long sword, flamberge, double axe, war axe, flail
	],
	[
		"title" => "Strength",
		"runes" => ["Amn", "Tir"],
		"level" => 25,
		"bases" => ["WEAPON"],
		"prefer" => ["flb", "9fb", "wax", "9wa", "fla", "9fl", "PREF_POLES_NORMAL", "PREF_POLES_EXCEPTIONAL"], // flamberge, zweihander, war axe, naga, flail, knout, normal and exceptional polearms
	],
	[
		"title" => "Venom",
		"runes" => ["Tal", "Dol", "Mal"],
		"level" => 49,
		"bases" => ["WEAPON"],
		"prefer" => [], // nobody uses this
	],
	[
		"title" => "Wealth",
		"runes" => ["Lem", "Ko", "Tir"],
		"level" => 43,
		"bases" => ["ARMOR"],
		"prefer" => ["PREF_ARMOR_EXCEPTIONAL"], // exceptional armors
	],
	[
		"title" => "White",
		"runes" => ["Dol", "Io"],
		"level" => 35,
		"bases" => ["WAND"],
		"prefer" => ["(EXC OR ELT) WAND"], // exceptional or elite wands
	],
	[
		"title" => "Zephyr",
		"runes" => ["Ort", "Eth"],
		"level" => 21,
		"bases" => ["MISSILE"],
		"prefer" => ["am1", "am2"], // stag bow, reflex bow
	],
	/* 1.10 */
	[
		"title" => "Beast",
		"runes" => ["Ber", "Tir", "Um", "Mal", "Lum"],
		"level" => 63,
		"bases" => ["AXE", "SCEPTER", "HAMMER"],
		"prefer" => ["7wa", "7cr"], // berserker axe, phase blade
	],
	[
		"title" => "Bramble",
		"runes" => ["Ral", "Ohm", "Sur", "Eth"],
		"level" => 61,
		"bases" => ["ARMOR"],
		"prefer" => ["PREF_ARMOR_ELITE"], // elite armors
	],
	[
		"title" => "Breath of the Dying",
		"runes" => ["Vex", "Hel", "El", "Eld", "Zod", "Eth"],
		"level" => 69,
		"bases" => ["WEAPON"],
		"prefer" => ["7wa", "7gd", "7p7", "6lw"], // berserker axe, colossus blade, war pike, hydra bow
		"is_eth" => true,
	],
	[
		"title" => "Call to Arms",
		"runes" => ["Amn", "Ral", "Mal", "Ist", "Ohm"],
		"level" => 51,
		"bases" => ["WEAPON"],
		"prefer" => ["fla", "crs"], // flail, crystal sword
	],
	[
		"title" => "Chaos",
		"runes" => ["Fal", "Ohm", "Um"],
		"level" => 57,
		"bases" => ["CLAW"],
		"prefer" => ["ELT SIN"], // elite claws
	],
	[
		"title" => "Chains of Honor",
		"runes" => ["Dol", "Um", "Ber", "Ist"],
		"level" => 63,
		"bases" => ["ARMOR"],
		"prefer" => ["PREF_ARMOR_ELITE"], // elite armors
		"is_priority" => true,
	],
	[
		"title" => "Crescent Moon",
		"runes" => ["Shael", "Um", "Tir"],
		"level" => 47,
		"bases" => ["AXE", "SWORD", "POLEARM"],
		"prefer" => ["PREF_POLES_EXCEPTIONAL", "9fb", "9wa"], // exceptional polearms, zweihander, naga
	],
	[
		"title" => "Delirium",
		"runes" => ["Lem", "Ist", "Io"],
		"level" => 51,
		"bases" => ["HELM"],
		"prefer" => ["ELT CIRC", "ELT BARB", "ELT DRU", "uh9"], // class helms, bone visage
	],
	[
		"title" => "Doom",
		"runes" => ["Hel", "Ohm", "Um", "Lo", "Cham"],
		"level" => 67,
		"bases" => ["AXE", "POLEARM", "HAMMER"],
		"prefer" => ["PREF_POLES_ELITE", "7wa"], // elite polearms, berserker axe
	],
	[
		"title" => "Duress",
		"runes" => ["Shael", "Um", "Thul"],
		"level" => 47,
		"bases" => ["ARMOR"],
		"prefer" => ["PREF_ARMOR_EXCEPTIONAL", "PREF_ARMOR_ELITE"], // exceptional and elite armors
	],
	[
		"title" => "Enigma",
		"runes" => ["Jah", "Ith", "Ber"],
		"level" => 65,
		"bases" => ["ARMOR"],
		"prefer" => ["PREF_ARMOR_ELITE"], // elite armors
	],
	[
		"title" => "Eternity",
		"runes" => ["Amn", "Ber", "Ist", "Sol", "Sur"],
		"level" => 63,
		"bases" => ["WEAPON"],
		"prefer" => [], // no one uses this, too expensive
	],
	[
		"title" => "Exile",
		"runes" => ["Vex", "Ohm", "Ist", "Dol"],
		"level" => 57,
		"bases" => ["DIN"],
		"tinfos" => "Not regular SHIELD",
		"prefer" => ["ELT DIN"], // elite paladin shields
		"is_priority" => true,
	],
	[
		"title" => "Famine",
		"runes" => ["Fal", "Ohm", "Ort", "Jah"],
		"level" => 65,
		"bases" => ["AXE", "HAMMER"],
		"prefer" => [], // too expensive, nobody uses this
	],
	[
		"title" => "Gloom",
		"runes" => ["Fal", "Um", "Pul"],
		"level" => 47,
		"bases" => ["ARMOR"],
		"prefer" => ["PREF_ARMOR_EXCEPTIONAL"], // exceptional armors
	],
	[
		"title" => "Hand of Justice",
		"runes" => ["Sur", "Cham", "Amn", "Lo"],
		"level" => 67,
		"bases" => ["WEAPON"],
		"prefer" => ["7wa", "7cr"], // berserker axe, phase blade
	],
	[
		"title" => "Heart of the Oak",
		"runes" => ["Ko", "Vex", "Pul", "Thul"],
		"level" => 55,
		"bases" => ["STAFF", "MACE"],
		"prefer" => ['fla'], // flail
	],
	[
		"title" => "Kingslayer",
		"runes" => ["Mal", "Um", "Gul", "Fal"],
		"level" => 53,
		"bases" => ["SWORD", "AXE"],
		"prefer" => ["7wa", "7cr", "7gd"], // berserker axe, phase blade, colossus blade
	],
	[
		"title" => "Passion",
		"runes" => ["Dol", "Ort", "Eld", "Lem"],
		"level" => 43,
		"bases" => ["WEAPON"],
		"prefer" => ["7cr"], // phase blade (according to Luigi's guide)
	],
	[
		"title" => "Prudence",
		"runes" => ["Mal", "Tir"],
		"level" => 49,
		"bases" => ["ARMOR"],
		"prefer" => ["PREF_ARMOR_EXCEPTIONAL", "PREF_ARMOR_ELITE"], // exceptional and elite armors
	],
	[
		"title" => "Sanctuary",
		"runes" => ["Ko", "Ko", "Mal"],
		"level" => 49,
		"bases" => ["SHIELD"],
		"prefer" => ["tow", "ush", "ELT DIN"], // tower shield, troll nest, elite paladin shields (per Luigi's guide)
	],
	[
		"title" => "Splendor",
		"runes" => ["Eth", "Lum"],
		"level" => 37,
		"bases" => ["SHIELD"],
		"prefer" => ["xsh"], // grim shield (runeword replacement for lidless wall)
	],
	[
		"title" => "Stone",
		"runes" => ["Shael", "Um", "Pul", "Lum"],
		"level" => 47,
		"bases" => ["ARMOR"],
		"prefer" => ["PREF_ARMOR_EXCEPTIONAL", "PREF_ARMOR_ELITE"], // exceptional and elite armors
	],
	[
		"title" => "Wind",
		"runes" => ["Sur", "El"],
		"level" => 61,
		"bases" => ["WEAPON"],
		"prefer" => [], // nobody uses this
	],
	/* 1.10 LADDER */
	[
		"title" => "Brand",
		"runes" => ["Jah", "Lo", "Mal", "Gul"],
		"level" => 65,
		"bases" => ["MISSILE"],
		"ladder" => true,
		"prefer" => ["amb", "6cb"], // matriarchal bow, great bow
	],
	[
		"title" => "Death",
		"runes" => ["Hel", "El", "Vex", "Ort", "Gul"],
		"level" => 55,
		"bases" => ["SWORD", "AXE"],
		"ladder" => true,
		"prefer" => ["7wa", "7gd"], // berserker axe, colossus blade
	],
	[
		"title" => "Destruction",
		"runes" => ["Vex", "Lo", "Ber", "Jah", "Ko"],
		"level" => 65,
		"bases" => ["POLEARM", "SWORD"],
		"ladder" => true,
		"prefer" => ["7gd"], // colossus blade
	],
	[
		"title" => "Dragon",
		"runes" => ["Sur", "Lo", "Sol"],
		"level" => 61,
		"bases" => ["ARMOR", "SHIELD"],
		"ladder" => true,
		"prefer" => ["PREF_ARMOR_ELITE", "ELT DIN"], // elite armors, elite paladin shields
	],
	[
		"title" => "Dream",
		"runes" => ["Io", "Jah", "Pul"],
		"level" => 65,
		"bases" => ["HELM", "SHIELD"],
		"ladder" => true,
		"prefer" => ["CIRC", "BARB", "DRU", "uh9", "tow", "ush"], // class helms, bone visage, tower shield, troll nest
	],
	[
		"title" => "Edge",
		"runes" => ["Tir", "Tal", "Amn"],
		"level" => 25,
		"bases" => ["MISSILE"],
		"ladder" => true,
		"prefer" => ["am1", "am2", "am6", "am7"], // stag bow, reflex bow ,ashwood bow, ceremonial bow
	],
	[
		"title" => "Faith",
		"runes" => ["Ohm", "Jah", "Lem", "Eld"],
		"level" => 65,
		"bases" => ["MISSILE"],
		"ladder" => true,
		"prefer" => ["amb", "amc"], // matriarchal bow, grand matron bow
		"is_priority" => true,
	],
	[
		"title" => "Fortitude",
		"runes" => ["El", "Sol", "Dol", "Lo"],
		"level" => 59,
		"bases" => ["WEAPON", "ARMOR"],
		"ladder" => true,
		"prefer" => ["PREF_ARMOR_ELITE"], // elite armors
	],
	[
		"title" => "Grief",
		"runes" => ["Eth", "Tir", "Lo", "Mal", "Ral"],
		"level" => 59,
		"bases" => ["SWORD", "AXE"],
		"ladder" => true,
		"prefer" => ["7wa", "7cr"], // berserker axe, phase blade
		"is_priority" => true,
	],
	[
		"title" => "Harmony",
		"runes" => ["Tir", "Ith", "Sol", "Ko"],
		"level" => 39,
		"bases" => ["MISSILE"],
		"ladder" => true,
		"prefer" => ["am6", "am7"], // ashwood bow, ceremonial bow
	],
	[
		"title" => "Ice",
		"runes" => ["Amn", "Shael", "Jah", "Lo"],
		"level" => 65,
		"bases" => ["MISSILE"],
		"ladder" => true,
		"prefer" => ["amb", "amc"], // matriarchal bow, grand matron bow
	],
	[
		"title" => "Infinity",
		"runes" => ["Ber", "Mal", "Ber", "Ist"],
		"level" => 63,
		"bases" => ["POLEARM"],
		"ladder" => true,
		"prefer" => ["PREF_POLES_ELITE"], // elite polearms
		"is_priority" => true,
	],
	[
		"title" => "Insight",
		"runes" => ["Ral", "Tir", "Tal", "Sol"],
		"level" => 27,
		"bases" => ["POLEARM", "STAFF"],
		"ladder" => true,
		"prefer" => ["PREF_POLES_NORMAL", "PREF_POLES_EXCEPTIONAL", "PREF_POLES_ELITE"], // all polearms
	],
	[
		"title" => "Last Wish",
		"runes" => ["Jah", "Mal", "Jah", "Sur", "Jah", "Ber"],
		"level" => 65,
		"bases" => ["SWORD", "HAMMER", "AXE"],
		"ladder" => true,
		"prefer" => ["7wa", "7cr"], // berserker axe, phase blade
	],
	[
		"title" => "Lawbringer",
		"runes" => ["Amn", "Lem", "Ko"],
		"level" => 43,
		"bases" => ["SWORD", "HAMMER", "SCEPTER"],
		"ladder" => true,
		"prefer" => ["72h"], // legend sword (ideal for A5 mercs aparently)
	],
	[
		"title" => "Oath",
		"runes" => ["Shael", "Pul", "Mal", "Lum"],
		"level" => 49,
		"bases" => ["SWORD", "AXE", "MACE"],
		"ladder" => true,
		"prefer" => ["7wa", "7gd"], // berserker axe, colossus blade
	],
	[
		"title" => "Obedience",
		"runes" => ["Hel", "Ko", "Thul", "Eth", "Fal"],
		"level" => 41,
		"bases" => ["POLEARM"],
		"ladder" => true,
		"prefer" => ["PREF_POLES_EXCEPTIONAL", "PREF_POLES_ELITE"], // exceptional and elite polearms
	],
	[
		"title" => "Phoenix",
		"runes" => ["Vex", "Vex", "Lo", "Jah"],
		"level" => 65,
		"bases" => ["WEAPON", "SHIELD"],
		"ladder" => true,
		"prefer" => ["uit", "ELT DIN"], // monarch, paladin shield
	],
	[
		"title" => "Pride",
		"runes" => ["Cham", "Sur", "Io", "Lo"],
		"level" => 67,
		"bases" => ["POLEARM"],
		"ladder" => true,
		"prefer" => ["PREF_POLES_ELITE"], // elite polearms
	],
	[
		"title" => "Rift",
		"runes" => ["Hel", "Ko", "Lem", "Gul"],
		"level" => 53,
		"bases" => ["POLEARM", "SCEPTER"],
		"ladder" => true,
		"prefer" => ["wsp"], // war scepter
	],
	[
		"title" => "Spirit",
		"runes" => ["Tal", "Thul", "Ort", "Amn"],
		"level" => 30,
		"bases" => ["SWORD", "SHIELD"],
		"ladder" => true,
		"prefer" => ["crs", "uit", "NORM DIN", "EXC DIN", "ELT DIN"], // crystal sword, monarch, all paladin shields
	],
	[
		"title" => "Voice of Reason",
		"runes" => ["Lem", "Ko", "El", "Eld"],
		"level" => 43,
		"bases" => ["SWORD", "MACE"],
		"ladder" => true,
		"prefer" => [], // nobody uses this
	],
	[
		"title" => "Wrath",
		"runes" => ["Pul", "Lum", "Ber", "Mal"],
		"level" => 63,
		"bases" => ["MISSILE"],
		"ladder" => true,
		"prefer" => ["amb", "amc"], // matriarchal bow, grand matron bow
	],
	/* 1.11 */
	[
		"title" => "Bone",
		"runes" => ["Sol", "Um", "Um"],
		"level" => 47,
		"bases" => ["ARMOR"],
		"tinfos" => "Necromancer",
		"prefer" => [],
	],
	[
		"title" => "Enlightenment",
		"runes" => ["Pul", "Ral", "Sol"],
		"level" => 45,
		"bases" => ["ARMOR"],
		"tinfos" => "Sorceress",
		"prefer" => [],
	],
	[
		"title" => "Myth",
		"runes" => ["Hel", "Amn", "Nef"],
		"level" => 25,
		"bases" => ["ARMOR"],
		"tinfos" => "Barbarian",
		"prefer" => [],
	],
	[
		"title" => "Peace",
		"runes" => ["Shael", "Thul", "Amn"],
		"level" => 29,
		"bases" => ["ARMOR"],
		"tinfos" => "Amazon",
		"prefer" => [],
	],
	[
		"title" => "Principle",
		"runes" => ["Ral", "Gul", "Eld"],
		"level" => 53,
		"bases" => ["ARMOR"],
		"tinfos" => "Paladin",
		"prefer" => [],
	],
	[
		"title" => "Rain",
		"runes" => ["Ort", "Mal", "Ith"],
		"level" => 49,
		"bases" => ["ARMOR"],
		"tinfos" => "Druid",
		"prefer" => [],
	],
	[
		"title" => "Treachery",
		"runes" => ["Shael", "Thul", "Lem"],
		"level" => 43,
		"bases" => ["ARMOR"],
		"tinfos" => "Assassin",
		"prefer" => ["PREF_ARMOR_EXCEPTIONAL", "PREF_ARMOR_ELITE"], // exceptional and elite armors
	],

];