<?php

class App
{
	protected static $config,
		$item_codes2names,
		$item_codes2class,
		$item_names2types,
		$item_types_to_filter_types,
		$item_types_to_socket_types,
		$larzuk_item_types,
		$item_autoparams;


	public static function run()
	{
		// load config
		static::$config = require(path('config/config.php'));

		// build working arrays
		static::build_working_arrays();

		// compile
		$uniques = static::compile_uniques();
		$runewords = static::compile_runewords();

		// init
		$lines = [];

		$lines[] = '//=================================================';
		$lines[] = '// TIERS';
		$lines[] = '//=================================================';
		$lines[] = '';
		$lines[] = '// These filter codes are computer generated:';
		$lines[] = '// https://github.com/whipowill/php-d2-filter-builder';
		$lines[] = '';
		$lines = array_merge($lines, static::build_tier_notifications($uniques, $runewords));

		$lines[] = '//=================================================';
		$lines[] = '// RUNEWORDS';
		$lines[] = '//=================================================';
		$lines[] = '';
		$lines[] = '// These filter codes are computer generated:';
		$lines[] = '// https://github.com/whipowill/php-d2-filter-builder';
		$lines[] = '';
		$lines = array_merge($lines, static::build_runeword_recommendations($runewords));

		// save to file
		tofile($lines);

		// report
		terminal('File "output.txt" saved.');
	}

	protected static function build_tier_notifications($uniques, $runewords)
	{
		// merge the arrays together by item type
		$tiers = static::merge_uniques_and_runewords($uniques, $runewords);

		// hash checker to find duplicates
		$hashes = [];

		// init
		$lines = [];
		foreach ($tiers as $payload)
		{
			// load the items from the array
			$item_name = ex($payload, 'name');
			$item_code = ex($payload, 'code');
			$uniques = ex($payload, 'uniques', []);
			$runewords = ex($payload, 'runewords', []);

			if (count($uniques) or count($runewords))
			{
				$lines[] = '// '.$item_name.' ('.$item_code.')';

				// if uniques...
				if (count($uniques))
				{
					// foreach unique...
					foreach ($uniques as $item)
					{
						$tier = ex($item, 'tier');
						$tier_with_params = ex($item, 'tier_with_params');

						// if wanting tier notifications...
						if ($tier or $tier_with_params)
						{
							$name = ex($item, 'name');
							$type = ex($item, 'type');
							$params = ex($item, 'params');
							$note = ex($item, 'note');

							// print lines
							$l = static::print_tier_lines($item_name, $item_code, $name, $tier, $tier_with_params, $type, $params);

							// make hash
							$hash = md5($type.$item_code.$params);

							// if not a dupe...
							if (!isset($hashes[$hash]))
							{
								$lines = array_merge($lines, $l);
							}

							// if it is a dupe...
							else
							{
								static::print_tier_error($type, $item_code, $item_name, $l);
							}

							// add to dupe check
							$hashes[$hash] = 1;
						}
					}
				}

				// if runewords...
				if (count($runewords))
				{
					// The runewords array comes as a list of socket counts as the
					// key with lots of runewords for each.  We will sort through each
					// socket => runewords list as build a key to rename all the items
					// and average out the tier values.

					$key = [];
					$lowest_tier = null;
					$lowest_tier_with_params = null;

					// foreach socket count...
					foreach ($runewords as $sockets => $items)
					{
						// organize where the runewords w/ params are first
						$items = array_orderby($items, ['params' => SORT_DESC]);

						// foreach item in that traunch...
						foreach ($items as $item)
						{
							// if this item is even used...
							if (ex($item, 'tier') or ex($item, 'tier_with_params'))
							{
								#$hash = md5('sockets='.$sockets.'params='.ex($item, 'params'));
								$hash = md5('sockets='.$sockets);

								if (!isset($key[$sockets][$hash]))
								{
									$key[$sockets][$hash] = [
										'name' => $sockets.'os / '.ex($item, 'name'),
										'tier' => ex($item, 'tier'),
										'tier_with_params' => ex($item, 'tier_with_params'),
										'params' => ex($item, 'params'),
									];
								}
								else
								{
									$key[$sockets][$hash]['name'] .= ', '.ex($item, 'name');
									$key[$sockets][$hash]['tier'] = (ex($item, 'tier') and (!$key[$sockets][$hash]['tier'] or ex($item, 'tier') < $key[$sockets][$hash]['tier'])) ? ex($item, 'tier') : $key[$sockets][$hash]['tier'];
									$key[$sockets][$hash]['tier_with_params'] = (ex($item, 'tier_with_params') and (!$key[$sockets][$hash]['tier_with_params'] or ex($item, 'tier_with_params') < $key[$sockets][$hash]['tier_with_params'])) ? ex($item, 'tier_with_params') : $key[$sockets][$hash]['tier_with_params'];

									if (ex($item, 'params'))
									{
										if (!$key[$sockets][$hash]['params'])
										{
											$key[$sockets][$hash]['params'] = ex($item, 'params');
										}
										else
										{
											if (ex($item, 'params') == $key[$sockets][$hash]['params'])
											{
												// do nothing
											}
											else
											{
												xx(ex($item, 'params'));
											}
										}
									}
								}

								$lowest_tier = (ex($item, 'tier') and (!$lowest_tier or ex($item, 'tier') < $lowest_tier)) ? ex($item, 'tier') : $lowest_tier;
								$lowest_tier_with_params = (ex($item, 'tier_with_params') and (!$lowest_tier_with_params or ex($item, 'tier_with_params') < $lowest_tier_with_params)) ? ex($item, 'tier_with_params') : $lowest_tier_with_params;
							}
						}
					}

					// add to key a nosock entry
					$key[0][1] = [
						'name' => '0os',
						'tier' => !$lowest_tier_with_params ? $lowest_tier : null,
						'tier_with_params' => $lowest_tier_with_params,
						'params' => null,
					];

					#if ($item_code == '7wa') xx($key);

					// foreach socket count...
					foreach ($key as $sockets => $items)
					{
						// foreach item...
						foreach ($items as $item)
						{
							$tier = ex($item, 'tier');
							$tier_with_params = ex($item, 'tier_with_params');

							// if wanting tier notifications...
							if ($tier or $tier_with_params)
							{
								$name = ex($item, 'name');
								$type = 'NMAG';
								$params = ex($item, 'params');
								$note = ex($item, 'note');

								// make hash
								$hash = md5($type.$item_code.$params.$sockets);

								// build line
								$l = static::print_tier_lines($item_name, $item_code, $name, $tier, $tier_with_params, $type, $params, $sockets);

								// if not a dupe...
								if (!isset($hashes[$hash]))
								{
									$lines = array_merge($lines, $l);
								}

								// if it is a dupe...
								else
								{
									static::print_tier_error($type, $item_code, $item_name, $l);
								}

								// add to dupe check
								$hashes[$hash] = 1;
							}
						}
					}
				}

				// blank line
				$lines[] = '';
			}
		}

		// return
		return $lines;
	}

	protected static function print_tier_error($type, $item_code, $item_name, $lines)
	{
		if ($type != 'NMAG' and !in_array($item_code, ['rin', 'amu']))
		{
			// print to terminal
			terminal('------- REMOVED AS DUPE -------');
			terminal($item_name.' ('.$item_code.')');
			x($lines);
		}
	}

	protected static function print_tier_lines($item_name, $item_code, $name, $tier, $tier_with_params, $type, $params, $sockets = null)
	{
		// init
		$lines = [];

		// detect errors
		if ($tier_with_params and !$params)
		{
			#terminal('You have no params for item "'.$name.' ('.$item_code.')".');
			#die();
		}
		if (!$tier_with_params and $params)
		{
			#terminal('You have no tier_with_params item "'.$name.' ('.$item_code.')".');
			#die();
		}

		$lines[] = '// - '.$name;

		// if tier_with_params...
		if ($tier_with_params)
		{
			// never let tier_with_params be a worse tier than tier
			if ($tier) if ($tier_with_params > $tier) $tier_with_params = $tier;

			// patch the params
			$params = static::filter_params($type, $item_code, $params);

			// print the line
			$lines[] = 'ItemDisplay['
				.$type.' '
				.($type == 'NMAG' ? '!INF ' : '')
				.(ex(static::$config, 'is_ignore_superior') ? '!SUP ' : '')
				.$item_code
				.($sockets !== null ? ' SOCK='.$sockets : '')
				.($params ? ' '.$params : '')
				.']: '.(($type == 'NMAG' and $sockets === 0) ? '' : static::get_tier_color($tier_with_params).'T'.$tier.'%MAP% ').'%NAME%%TIER-'.$tier_with_params.'%';

			// if type is not base item and not a ring or ammy...
			if ($type != 'NMAG' and !in_array($item_code, ['rin', 'amu']))
			{
				// add version that has no params and is unID
				$lines[] = 'ItemDisplay['
					.$type.' '
					.($type == 'NMAG' ? '!INF ' : '')
					.(ex(static::$config, 'is_ignore_superior') ? '!SUP ' : '')
					.$item_code
					.' !ID'
					//.($sockets ? ' SOCK='.$sockets : '')
					//.($params ? ' '.$params : '')
					.']: '.static::get_tier_color($tier_with_params).'T'.$tier_with_params.'%MAP% %NAME%%TIER-'.$tier_with_params.'%';
			}
		}

		// if tier...
		if ($tier)
		{
			// patch the params
			$params = static::filter_params($type, $item_code, null); // send blank, autoadd params from config

			// print the line
			$lines[] = 'ItemDisplay['
				.$type.' '
				.($type == 'NMAG' ? '!INF ' : '')
				.(ex(static::$config, 'is_ignore_superior') ? '!SUP ' : '')
				.$item_code
				.($sockets !== null ? ' SOCK='.$sockets : '')
				.($params ? ' '.$params : '')
				.']: '.(($type == 'NMAG' and $sockets === 0) ? '' : static::get_tier_color($tier).'T'.$tier.'%MAP% ').'%NAME%%TIER-'.$tier.'%';
		}

		// return
		return $lines;
	}

	protected static function build_runeword_recommendations($runewords)
	{
		// print the lines
		$lines = [];
		foreach ($runewords as $payload)
		{
			$name = ex($payload, 'name');
			$item_code = ex($payload, 'code');
			$items = ex($payload, 'items', []);

			// load info about this item
			$info = static::get_base_info($item_code);

			// print
			$lines[] = '// '.$name.' ('.$item_code.')';
			#$lines[] = '// -------';

			foreach ($items as $sockets => $runewords)
			{
				// build
				$label = static::get_base_label($runewords);
				$description = static::get_base_description($item_code, $runewords);

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
				$line = '// - '.$sockets.'os / ';
				foreach ($runewords as $runeword)
				{
					$line .= ex($runeword, 'name').', ';
				}
				$lines[] = trim($line, ', ');
				#$lines[] = 'ItemDisplay[NMAG !INF '.(ex(static::$config, 'is_ignore_superior') ? '!SUP ' : '').'!RW ('.$item_code.') (SOCK='.$sockets.($is_larzukable ? ' OR (SOCK=0 ILVL>'.$ilvl_floor.' ILVL<'.($ilvl_ceil+1).')' : '').')]: %NAME% %DARK_GREEN%'.$label.'%WHITE%{'.$description.'}';
				$lines[] = 'ItemDisplay[NMAG !INF '.(ex(static::$config, 'is_ignore_superior') ? '!SUP ' : '').'!RW ('.$item_code.') (SOCK='.$sockets.($is_larzukable ? ' OR (SOCK=0 ILVL>'.$ilvl_floor.' ILVL<'.($ilvl_ceil+1).')' : '').')]: %NAME%%WHITE%{'.$description.'}';
			}

			// print
			$find = ex(static::$item_codes2class, $item_code);
			$class = ex(static::$item_types_to_socket_types, $find);
			switch ($class)
			{
				case 'CIRC':
				case 'BARB':
				case 'DRU':
				case 'helm':
					$description = '%WHITE%Socket with %ORANGE%RalThul %BLUE%o%WHITE%Perfect'; // saphire
					break;
				case 'armor':
					$description = '%WHITE%Socket with %ORANGE%TalThul o%WHITE%Perfect'; // topaz
					break;
				case 'DIN':
				case 'shield':
					$description = '%WHITE%Socket with %ORANGE%TalAmn %RED%o%WHITE%Perfect'; // ruby
					break;
				case 'WAND':
				case 'SIN':
				case 'STAFF':
				case 'weapon':
					$description = '%WHITE%Socket with %ORANGE%RalAmn %PURPLE%o%WHITE%Perfect'; // amythyst
					break;
				default:
					terminal('Unable to find socket reciple for item "'.$item_code.'".');
					die();
					break;
			}
			if ($class)
			{
				$lines[] = '// - 0os';
				$lines[] = 'ItemDisplay[NMAG !INF '.(ex(static::$config, 'is_ignore_superior') ? '!SUP ' : '').'!RW ('.$item_code.') SOCK=0]: %NAME%%WHITE%{'.$description.'}';
			}

			$lines[] = '';
		}

		// return
		return $lines;
	}

	protected static function compile_uniques()
	{
		// load tiered items
		$tiers = [
			'UNI' => csv(path('storage/uniques.csv')),
			'SET' => csv(path('storage/sets.csv')),
		];

		// compile by item type
		$compiled = [];
		foreach ($tiers as $type => $items)
		{
			foreach ($items as $item)
			{
				$code = ex($item, 'code');
				$item['type'] = $type;

				// if this is an item we even want to use...
				if (ex($item, 'tier') or ex($item, 'tier_with_params'))
				{
					// see if this item code includes ORs that can be split
					$code = str_ireplace(['(', ')'], ['', ''], $code); // filter out parenthesis
					$parts = explode(' OR ', $code);

					foreach ($parts as $part)
					{
						$part = trim($part);
						$compiled[$part][] = $item;
					}
				}
			}
		}

		// build into final array
		$final = [];
		foreach ($compiled as $item_code => $items)
		{
			$info = static::get_base_info($item_code);

			$final[$item_code] = [
				'name' => ex($info, 'name'),
				'code' => $item_code,
				'items' => $items,
			];
		}

		// sort the final array by item name
		$final = array_orderby($final, ['name' => SORT_ASC]);

		// return
		return $final;
	}

	protected static function compile_runewords()
	{
		// load resources
		$runewords = csv(path('storage/runewords.csv'));

		// compile into first array
		$compile = [];
		foreach ($runewords as $runeword)
		{
			// info about this runeword
			$sockets = sizeof(explode(',', ex($runeword, 'runes')));

			// foreach preferred base item
			$item_codes = [];
			foreach (explode(', ', ex($runeword, 'code')) as $item_code)
			{
				// trim
				$item_code = trim($item_code);

				// if item type isn't blank (bc we don't want to use that runeword)...
				if ($item_code)
				{
					// see if this item type should be renamed to match filter
					$alt_item_codes = ex(static::$item_types_to_filter_types, $item_code, []);
					if (sizeof($alt_item_codes))
					{
						foreach ($alt_item_codes as $alt_item_code)
						{
							$item_codes[] = $alt_item_code;
						}
					}
					else
					{
						$item_codes[] = $item_code;
					}
				}
			}

			// foreach item type...
			foreach ($item_codes as $item_code)
			{
				// save
				$compiled[$item_code][$sockets][] = $runeword;
			}
		}

		// sort into final array
		$final = [];
		foreach ($compiled as $item_code => $items)
		{
			$info = static::get_base_info($item_code);

			// sort the runewords by number of sockets needed desc
			krsort($items);

			// sort all the runewords for each socket count by level desc
			foreach ($items as $sockets => $list)
			{
				$list = array_orderby($list, ['level' => SORT_ASC]);
				$items[$sockets] = $list;
			}

			// save to final array
			$final[$item_code] = [
				'name' => ex($info, 'name'),
				'code' => $item_code,
				'items' => $items,
			];
		}

		// sort the final array by item name
		$final = array_orderby($final, ['name' => SORT_ASC]);

		// return
		return $final;
	}

	protected static function get_base_description($item_code, $runewords)
	{
		// sort runewords by level
		$runewords = array_orderby($runewords, ['level' => SORT_ASC]);

		$description = '';
		foreach ($runewords as $runeword)
		{
			// determine name
			$name = ex($runeword, 'name');

			// shorten name
			$name = ex(static::$item_types_to_filter_types, 'rename.'.$name, $name);

			// add to description
			$description .= '%GOLD%'.$name.' %GRAY%'.ex($runeword, 'level').' ';
		}
		$description = substr($description, 0, -1);

		// if too many words...
		$max_string = 128;
		if (strlen($description) >= $max_string)
		{
			terminal($item_code);
			terminal($description);
			terminal('OVER STRING LIMIT BY '.(strlen($description) - $max_string));
			die();
		}

		// return
		return $description;
	}

	protected static function get_base_info($item_code)
	{
		// find item name
		$name = ex(static::$item_codes2names, $item_code);

		if (!$name)
		{
			terminal('Please specify a valid item code, "'.$item_code.'" is invalid.');
			die();
		}

		// find larzuk socket counts
		$larzuk = [];
		foreach (static::$larzuk_item_types as $lookup)
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
		$label = ex($runewords, '0.name');
		foreach ($runewords as $runeword)
		{
			if (ex($runeword, 'is_priority'))
			{
				return ex($runeword, 'name');
			}
		}

		return $label;
	}

	protected static function get_tier_color($tier)
	{
		return ex(static::$config, 'tiers.colors.'.$tier);
	}

	protected static function merge_uniques_and_runewords($uniques, $runewords)
	{
		$merge = [];

		foreach ($uniques as $item)
		{
			$name = ex($item, 'name');
			$code = ex($item, 'code');

			$merge[$code] = [
				'name' => $name,
				'code' => $code,
			];

			$merge[$code]['uniques'] = ex($item, 'items', []);
		}

		foreach ($runewords as $item)
		{
			$name = ex($item, 'name');
			$code = ex($item, 'code');

			if (!isset($merge[$code]))
			{
				$merge[$code] = [
					'name' => $name,
					'code' => $code,
				];
			}

			$merge[$code]['runewords'] = ex($item, 'items', []);
		}

		// sort by item name
		$merge = array_orderby($merge, ['name' => SORT_ASC]);

		// return
		return $merge;
	}

	protected static function filter_params($item_type, $item_code, $params, $sockets = null)
	{
		// if we are ignoring superior items...
		if (ex(static::$config, 'is_ignore_superior'))
		{
			// init
			$list_of_params_to_remove = [];

			// split up the params
			$parts = explode(' ', $params);

			// foreach param...
			foreach ($parts as $param)
			{
				// split by greaterthan
				$parts2 = explode('>', $param);
				$prefix = ex($parts2, 0);

				if (in_array($prefix, ['ED', 'DEF']))
				{
					// add to list of params
					$list_of_params_to_remove[] = $param;
				}
			}

			// foreach param to remove
			foreach ($list_of_params_to_remove as $param)
			{
				$params = str_ireplace($param, '', $params);
			}
		}

		// filter for items that we auto add params for
		if ($item_type == 'NMAG')
		{
			$autoadd = ex(static::$item_autoparams, $item_code);
			if ($autoadd)
			{
				$params .= ' '.$autoadd;
			}
		}

		// ignore all !eth commands -- it's too complicated to track all this
		$params = str_ireplace('!ETH', '', $params);

		// strip out double spaces
		$params = str_ireplace('  ', ' ', $params);

		// return
		return trim($params);
	}

	protected static function build_working_arrays()
	{
		// build working array of items
		$items = csv(path('storage/reference/items.csv'), false, "|");
		static::$item_codes2names = [];
		static::$item_codes2class = [];
		static::$item_names2types = [];
		foreach ($items as $item)
		{
			static::$item_codes2names[ex($item, 1)] = ex($item, 0);
			static::$item_codes2class[ex($item, 1)] = ex($item, 2);
			static::$item_names2types[ex($item, 0)] = ex($item, 1);
		}

		$part1 = require(path('config/item_types_to_filter_types.php')); // convert game item types to filter item types
		$part2 = ex(static::$config, 'codes', []); // custom preferences to convert shorthand in runewords.csv to actual item types
		static::$item_types_to_filter_types = array_merge($part1, $part2);
		static::$item_types_to_socket_types = require(path('config/item_types_to_socket_types.php'));
		static::$larzuk_item_types = csv(path('storage/reference/larzuk.csv'));

		// Add autoparams to the class for reference.
		$plist = [];
		$pitems = ex(static::$config, 'params', []);
		foreach ($pitems as $item_shorthand => $params)
		{
			$codes = ex(static::$item_types_to_filter_types, $item_shorthand, [$item_shorthand]);
			foreach ($codes as $code)
			{
				$plist[$code] = $params;
			}
		}
		static::$item_autoparams = $plist;
	}
}