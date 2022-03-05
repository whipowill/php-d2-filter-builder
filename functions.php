<?php

// debug helper
function x($var)
{
    echo '<pre>';
    if (is_array($var) or is_object($var))
    {
        print_r($var);
    }
    else
    {
        var_dump($var);
    }
    echo '</pre>';
}
function xx($var)
{
    die(x($var));
}

// extractor helper
function ex($object, $coords, $default = null)
{
    if (!is_array($object) and !is_object($object))
    {
        return $default;
    }

    $keys = explode('.', $coords);
    foreach ($keys as $key)
    {
        if (is_array($object))
        {
            if (isset($object[$key]))
            {
                $object = $object[$key];
            }
            else
            {
                return $default;
            }
        }
        elseif (is_object($object))
        {
            if (isset($object->$key))
            {
                $object = $object->$key;
            }
            else
            {
                return $default;
            }
        }
        else
        {
            return $default;
        }
    }
    return $object ? $object : $default;
}

// cli print helper
function terminal($string)
{
	fwrite(STDOUT, $string."\n\r");
}

// path helper
function path($path)
{
	return __DIR__.'/'.$path;
}

// save file helper
function tofile($lines)
{
    // open file
    $file = fopen(path('output.txt'), 'w');

    // build string
    $string = "";
    foreach ($lines as $line) $string .= $line."\n";

    // save file
    fwrite($file, $string);
}

// csv helper
function csv($path, $is_fist_row_are_headers = true, $delimiter = ',', $enclosure = '"', $is_throw_error_on_defects = true)
{
    // fix mac csv issue
    ini_set('auto_detect_line_endings', true);

    // open file...
    if ($input = @fopen($path, 'r'))
    {
        $columns = array();
        $rows = array();

        // spin rows...
        $row = 1;
        while ($fields = fgetcsv($input, 0, $delimiter, $enclosure))
        {
            if ($is_fist_row_are_headers)
            {
                // if first row...
                if ($row == 1)
                {
                    // spin headers...
                    $count = 0;
                    foreach ($fields as $field)
                    {
                        // get column name
                        $name = slug(trim($field ? $field : uniqid()), '_');

                        // check exists...
                        if (in_array($name, $columns))
                        {
                            $count++;
                            $name .= '_'.$count;
                        }

                        // save column name
                        $columns[] = $name;
                    }
                }
                else
                {
                    // if columns DO NOT match fields...
                    if (sizeof($columns) !== sizeof($fields))
                    {
                        // if throwing errors...
                        if ($is_throw_error_on_defects)
                        {
                            // die
                            throw new \Exception('Column and field sizes must match.');
                        }
                    }

                    // if they DO match...
                    else
                    {
                        // combine
                        $temp = array_combine($columns, $fields);

                        // if no error...
                        if ($temp)
                        {
                            // add to rows
                            $rows[] = $temp;
                        }
                    }
                }
            }
            else
            {
                // combine
                $temp = $fields;

                // if no error...
                if ($temp)
                {
                    // add to rows
                    $rows[] = $temp;
                }
                else
                {
                    // do not add row
                    #die(var_dump($fields));
                }
            }
            $row++;
        }

        // close file
        fclose($input);

        // return
        return $rows;
    }
    else
    {
        return false;
    }
}

// slug helper
function slug($text, string $divider = '_')
{
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

// array orderby helper
function array_orderby($array, $cols)
{
    // catch errors...
    if (!sizeof($array)) return $array;

    // capture values
    $colarr = [];
    foreach ($cols as $col => $order)
    {
        $colarr[$col] = [];
        foreach ($array as $k => $row)
        {
            $colarr[$col]['_'.$k] = strtolower(ex($row, $col));
        }
    }

    // evaluate values
    $eval = 'array_multisort(';
    foreach ($cols as $col => $order)
    {
        $eval .= '$colarr[\''.$col.'\'], '.$order.',';
    }
    $eval = substr($eval, 0, -1).');';
    eval($eval);

    // prepare final
    $ret = [];
    foreach ($colarr as $col => $arr)
    {
        foreach ($arr as $k => $v)
        {
            // get original key
            $k = substr($k, 1);

            // add to clean array
            if (!isset($ret[$k])) $ret[$k] = $array[$k];
        }
    }

    // return w/ fresh keys
    return array_values($ret);
}