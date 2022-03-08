<?php

class App
{
	public static function run()
	{
		// init
		$lines = [];

		// print unique codes
		$lines[] = '';
		$lines[] = '// Unique Items';
		$lines[] = '// -----------';
		$items = csv(path('storage/data/UniqueItems.txt'), true, "\t");
		$lines = array_merge($lines, static::build_items('unique', $items));

		// print set codes
		$lines[] = '';
		$lines[] = '// Set Items';
		$lines[] = '// -----------';
		$items = csv(path('storage/data/SetItems.txt'), true, "\t");
		$lines = array_merge($lines, static::build_items('set', $items));

		// print runeword codes
		$lines[] = '';
		$lines[] = '// Runeword Items';
		$lines[] = '// -----------';
		$items = csv(path('storage/data/Runes.txt'), true, "\t");
		#$lines = array_merge($lines, static::build_items('runeword', $items)); // cannot score runewords w/ current loot filter limitations

		// print base codes
		$lines[] = '';
		$lines[] = '// Base Items';
		$lines[] = '// -----------';
		$lines = array_merge($lines, static::build_base_items());

		// save to file
		tofile($lines);

		// report
		terminal('File "output.txt" saved.');
	}

	protected static function build_items($mode, $items)
	{
		// init
		$lines = [];

		// build working arrays
		$itemtypes = csv(path('storage/items.csv'), false, "|");
		$item_types2names = [];
		$item_types2class = [];
		$item_names2types = [];
		foreach ($itemtypes as $item)
		{
			$item_types2names[ex($item, 1)] = ex($item, 0);
			$item_types2class[ex($item, 1)] = ex($item, 2);
			$item_names2types[ex($item, 0)] = ex($item, 1);
		}

		// load data
		$properties = csv(path('storage/properties.csv'), true, ",");

		// build properties map (to convert game codes to loot filter codes)
		$map = [];
		foreach ($properties as $p)
		{
			$string = ex($p, 'lootfilter_code');
			if ($string)
			{
				$map[ex($p, 'game_code')] = $string;
			}
		}

		// set fields to look for...
		$fields = [];
		switch ($mode)
		{
			default:
				$fields = [
					'prop' => 'prop',
					'extra' => 'par',
					'min' => 'min',
					'max' => 'max',
				];
				break;
		}

		// foreach item...
		foreach ($items as $item)
		{
			// prep
			switch ($mode)
			{
				case 'unique':
					$name = ex($item, 'index');
					$code = ex($item, 'code');
					$string = 'UNI '.$code.' ';
					break;
				case 'set':
					$name = ex($item, 'index');
					$code = ex($item, 'item');
					$string = 'SET '.$code.' ';
					break;
			}

			$pass = true;
			if (!ex($item, 'enabled')) $pass = false;
			if (!ex($item_types2names, $code))
			{
				$pass = false;
				terminal('No item "'.$name.' ('.$code.')" in the game [mode='.$mode.'].');
			}

            // if item is enabled in the game and not an item in the ignore list...
			if ($code and !in_array($code, ['jew', 'rin', 'amu', 'uar', 'cm1', 'cm2', 'cm3']) and $pass)
			{
				// init
				$conditions = [];

				// foreach property...
				for ($i=1; $i<=9; $i++)
				{
					// if property has a range...
					if (ex($item, $fields['min'].$i) != ex($item, $fields['max'].$i))
					{
						// if it's a proptery we can actually check...
						$property = ex($item, $fields['prop'].$i);
						if ($property == 'oskill') $property = 'skill';
						if (in_array($property, ['skill', 'skilltab', 'oskill'])) $property = $property.'_'.slug(ex($item, $fields['extra'].$i));

						$ignore = [
							'*charged',
							'charged',
							'*hit-skill',
							'hit-skill',
							'*gethit-skill',
							'gethit-skill',
							'death-skill',
							'kill-skill',
							'att-skill',
							'dmg-pois',
							'dmg-fire',
							'dmg-cold',
							'dmg-ltng',
							'dmg-mag',
							'skill-rand', // random skill assigned
							'bloody', // attacker takes damage?
							###
							'ac', // +defense not working
							'dur', // +durability not actually in the game?
							'dmg', 'dmg-norm', // +damage not actually in the game?
						];
						if (!in_array($property, $ignore))
						{
							$translated = ex($map, $property);
							if ($translated)
							{
								$conditions[] = [
									'prop' => $translated,
									'extra' => ex($item, $fields['extra'].$i),
									'min' => ex($item, $fields['min'].$i),
									'max' => ex($item, $fields['max'].$i),
								];
							}
							else
							{
								// report
								terminal('Unable to convert proprty "'.$property.' ['.ex($item, $fields['extra'].$i).']['.ex($item, $fields['min'].$i).'/'.ex($item, $fields['max'].$i).']" to loot filter conditional on item "'.$name.' ('.$code.')".');
							}
						}
					}
				}

				#if ($name == 'Cliffkiller') xx($item);

				// we are going to print 4 versions of the item so we have
				// level A, level B, level C compared to perfect.

				// if scorable conditions...
				if (count($conditions))
				{
					$lines[] = '';
					$lines[] = '// '.$name.' ('.$code.')';

					foreach ([4, 3, 2, 1] as $tier)
					{
						// init
						$string2 = $string;

						foreach ($conditions as $condition)
						{
							$min = ex($condition, 'min');
							$max = ex($condition, 'max');
							$sub = ($max-$min) * .33;

							// look for properties that have OR in them...
							$property = ex($condition, 'prop');
							$ors = explode(' OR ', $property);
							if (count($ors) > 1)
							{
								$string2 .= '(';
								foreach ($ors as $or)
								{
									#$string2 .= trim($or).'>'.(ex($condition, 'max')-1).' OR ';
									switch ($tier)
									{
										case 1:
											// no math necessary
											break;
										case 4:
											$string2 .= trim($or).'>'.($max-1).' OR ';
											break;
										default:
											$string2 .= trim($or).'>'.($max-round($sub*(4-$tier))-1).' OR ';
											break;
									}
								}
								$string2 = substr($string2, 0, -4);
								$string2 .= ')';
							}
							else
							{
								switch ($tier)
								{
									case 1:
										// no math necessary
										break;
									case 4:
										$string2 .= trim($property).'>'.($max-1).' ';
										break;
									default:
										$string2 .= trim($property).'>'.($max-round($sub*(4-$tier))-1).' ';
										break;
								}
							}
						}

						// print
						$lines[] = 'ItemDisplay['.trim($string2).']: %NAME% %DARK_GREEN%'.$tier.'%WHITE%';
					}
				}
				else
				{
					// print item once marked perfect
					#$lines[] = 'ItemDisplay['.$string.']: %NAME% %DARK_GREEN%%WHITE%';
				}
			}
		}

		// return
		return $lines;
	}

	protected static function build_base_items()
	{
		// load resources
		$conversions = require(path('config/conversions.php'));
		$runewords = require(path('config/runewords.php'));
		$types = require(path('config/itemtypes.php'));

		// build working arrays
		$items = csv(path('storage/items.csv'), false, "|");
		$item_types2names = [];
		$item_types2class = [];
		$item_names2types = [];
		foreach ($items as $item)
		{
			$item_types2names[ex($item, 1)] = ex($item, 0);
			$item_types2class[ex($item, 1)] = ex($item, 2);
			$item_names2types[ex($item, 0)] = ex($item, 1);
		}

		// build array of larzuk levels
		$larzuk_item_types = csv(path('storage/sockets.csv'));

		// sort runewords
		$runewords = array_orderby($runewords, ['level' => SORT_DESC, 'title' => SORT_ASC]);

		// init
		$final = [];

		// foreach...
		foreach ($runewords as $runeword)
		{
			// info about this runeword
			$sockets = sizeof(ex($runeword, 'runes', []));

			// foreach preferred base item
			$item_types = [];
			foreach (ex($runeword, 'prefer', []) as $item_type)
			{
				$alt_item_types = ex($conversions, $item_type, []);
				if (sizeof($alt_item_types))
				{
					foreach ($alt_item_types as $alt_item_type)
					{
						$item_types[] = $alt_item_type;
					}
				}
				else
				{
					$item_types[] = $item_type;
				}
			}

			// foreach item type...
			foreach ($item_types as $item_type)
			{
				// save
				$final[$item_type][$sockets][] = $runeword;
			}
		}

		// init
		$lines = [];

		// foreach final...
		foreach ($final as $item_type => $sockets)
		{
			// get info
			$info = static::get_base_info($item_type, $item_types2names, $larzuk_item_types);

			// print
			$lines[] = '';
			$lines[] = '// '.ex($info, 'name').' ('.$item_type.')';
			#$lines[] = '// -------';

			#asort($sockets, SORT_NUMERIC);

			foreach ($sockets as $sockets => $runewords)
			{
				// build
				$label = static::get_base_label($runewords);
				$description = static::get_base_description($conversions, $runewords);

				// determine if larzuk is an option
				$is_larzukable = false;
				$ilvl_floor = null;
				$ilvl_ceil = null;
				if ($sockets == ex($info, 'larzuk.0', 0))
				{
					$is_larzukable = true;
					$ilvl_floor = 0;
					$ilvl_ceil = 25;
				}
				if ($sockets == ex($info, 'larzuk.25', 0))
				{
					$is_larzukable = true;
					$ilvl_floor = $ilvl_floor !== null ? $ilvl_floor : 25;
					$ilvl_ceil = 40;
				}
				if ($sockets == ex($info, 'larzuk.40', 0))
				{
					$is_larzukable = true;
					$ilvl_floor = $ilvl_floor !== null ? $ilvl_floor : 40;
					$ilvl_ceil = 99;
				}

				// print
				$lines[] = '// '.$sockets.' Sockets';
				foreach ($runewords as $runeword)
				{
					$lines[] = '// - '.ex($runeword, 'title').' ('.ex($runeword, 'level').')';
				}
				$lines[] = 'ItemDisplay[NMAG !INF !SUP !RW ('.$item_type.') (SOCK='.$sockets.($is_larzukable ? ' OR (SOCK=0 ILVL>'.$ilvl_floor.' ILVL<'.($ilvl_ceil+1).')' : '').')]: %NAME% %DARK_GREEN%'.$label.'%WHITE%%MAP%%TIER-2% {'.$description.'}';
			}

			// print
			$find = ex($item_types2class, $item_type);
			$class = ex($types, $find);
			switch ($class)
			{
				case 'helm':
					$description = '%WHITE%Socket with %ORANGE%RalThul %BLUE%o%WHITE%Perfect'; // saphire
					break;
				case 'armor':
					$description = '%WHITE%Socket with %ORANGE%TalThul o%WHITE%Perfect'; // topaz
					break;
				case 'shield':
					$description = '%WHITE%Socket with %ORANGE%TalAmn %RED%o%WHITEPerfect'; // ruby
					break;
				case 'weapon':
					$description = '%WHITE%Socket with %ORANGE%RalAmn %PURPLE%o%WHITE%Perfect'; // amythyst
					break;
			}
			if ($class)
			{
				$lines[] = '// 0 Sockets';
				$lines[] = 'ItemDisplay[NMAG !INF !SUP !RW ('.$item_type.') SOCK=0]: %NAME% %WHITE%%MAP%%TIER-2% {'.$description.'}';
			}
		}

		// return
		return $lines;
	}

	protected static function get_base_description($conversions, $runewords, $is_trimming = false)
	{
		// sort runewords by level
		$runewords = array_orderby($runewords, ['level' => SORT_ASC]);

		$description = '';
		foreach ($runewords as $runeword)
		{
			// if not trimming...
			if (!$is_trimming)
			{
				// determine name
				$name = ex($runeword, 'title');

				// shorten name
				$name = ex($conversions, 'rename.'.$name, $name);

				// add to description
				$description .= '%GOLD%'.$name.' %GRAY%'.ex($runeword, 'level').' ';
			}
		}
		$description = substr($description, 0, -1);

		// if too many words...
		$max_string = 128;
		if (strlen($description) >= $max_string)
		{
			terminal($description);
			terminal('OVER STRING LIMIT BY '.(strlen($description) - $max_string));
			die();
		}

		// return
		return $description;
	}

	protected static function get_base_info($item_code, $item_types2names, $larzuk_item_types)
	{
		// find item name
		$name = ex($item_types2names, $item_code, 'Unknown');

		// find larzuk socket counts
		$larzuk = [];
		foreach ($larzuk_item_types as $lookup)
		{
			if (trim(ex($lookup, 'item')) == $name)
			{
				$larzuk = $lookup;
				break;
			}
		}

		return [
			'code' => $item_code,
			'name' => $name,
			'larzuk' => [
				0 => ex($larzuk, 'ilvl_1_25'),
				25 => ex($larzuk, 'ilvl_26_40'),
				40 => ex($larzuk, 'ilvl_41'),
			],
		];
	}

	protected static function get_base_label($runewords)
	{
		$label = ex($runewords, '0.title');
		foreach ($runewords as $runeword)
		{
			if (ex($runeword, 'is_priority'))
			{
				return ex($runeword, 'title');
			}
		}

		return $label;
	}

	protected static function get_base_item_type_by_code($code, $items, $types)
	{
		$types =
		$items = csv(path('storage/items.csv'), false, "|");


	}
}