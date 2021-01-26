<?php
use App\Page;
use PHPMailer\PHPMailer\SMTP;
use DB;
use Mail;




function remind(){

    $date = date("Y-m-d");
    $remind = DB::table('remind')->where('Reminders', $date)->orderBy('id', 'desc')->get();
    foreach ($remind as $item) {
        DB::table('remind')
            ->where('id', $item->id)
            ->update([
                'status' => "1",
            ]);
        $array = array();
        $array['Email'] = $item->Email;
        $array['Title'] = "Date reminder";
        $array['reminder'] = "You are reminded of the agreed date";
        $array['details'] = $item->details;
        $array['History'] = $item->History;
        $array['Noun'] ="Lieber/e: ". $item->Noun;
        $array['Detection_type'] = $item->Detection_type;
        Mail::send('remind', ['array' => $array], function ($m) use ($array) {
            $m->to($array['Email'])->subject('alriyadah@sub.alriyadah-tr.com')->getSwiftMessage()
                ->getHeaders()
                ->addTextHeader('x-mailgun-native-send', 'true');
            $m->from('alriyadah@sub.alriyadah-tr.com', 'alriyadah');

        });
    }  

    DB::table('remind')->where('status', '=', "1")->delete();
}


function day__($date){
//Convert the date string into a unix timestamp.
$unixTimestamp = strtotime($date);
//Get the day of the week using PHP's date function. preg_replace('/\bHello\b/', 'NEW', $text)
$dayOfWeek = date("l", $unixTimestamp);
dd(preg_replace("/\Thursday\b/","Donnerstag",$dayOfWeek));
dd(str_replace("Thursday ","Donnerstag",$dayOfWeek));
$dayOfWeek =str_replace("Monday ","Montag",$dayOfWeek);
$dayOfWeek =str_replace("Tuesday ","Dienstag",$dayOfWeek);
$dayOfWeek =str_replace("Wednesday ","Mittwoch",$dayOfWeek);
$dayOfWeek =str_replace("Thursday ","Donnerstag",$dayOfWeek);
$dayOfWeek =str_replace("Friday ","Freitag",$dayOfWeek);
$dayOfWeek =str_replace("Saturday ","Samstag",$dayOfWeek);
$dayOfWeek =str_replace("Sunday ","Sonntag",$dayOfWeek);
dd($dayOfWeek);
//Print out the day that our date fell on.
return  $dayOfWeek;
}





 function data_sub($datastring){
    $date=date_create($datastring);
date_sub($date,date_interval_create_from_date_string("1 days"));
return date_format($date,"Y-m-d");
}
if (!function_exists('setEnvironmentValue')) {
    function setEnvironmentValue(array $values)
    {

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }

            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) {
            return false;
        }

        return true;

    }
}

if (!function_exists('convertUtf8')) {
    function convertUtf8($value)
    {
        return mb_detect_encoding($value, mb_detect_order(), true) === 'UTF-8' ? $value : mb_convert_encoding($value, 'UTF-8');
    }
}

if (!function_exists('make_slug')) {
    function make_slug($string)
    {
        $slug = preg_replace('/\s+/u', '-', trim($string));
        $slug = str_replace("/", "", $slug);
        $slug = str_replace("?", "", $slug);
        return $slug;
    }
}

if (!function_exists('make_input_name')) {
    function make_input_name($string)
    {
        return preg_replace('/\s+/u', '_', trim($string));
    }
}

if (!function_exists('getVersion')) {
    function getVersion($version)
    {
        $arr = explode("_", $version, 2);
        $version = $arr[0];
        return $version;
    }
}

if (!function_exists('hasCategory')) {
    function hasCategory($version)
    {
        if (strpos($version, "no_category") !== false) {
            return false;
        } else {
            return true;
        }
    }
}

if (!function_exists('isDark')) {
    function isDark($version)
    {
        if (strpos($version, "dark") !== false) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('slug_create')) {
    function slug_create($val)
    {
        $slug = preg_replace('/\s+/u', '-', trim($val));
        $slug = str_replace("/", "", $slug);
        $slug = str_replace("?", "", $slug);
        return $slug;
    }
}

if (!function_exists('getHref')) {
    function getHref($link)
    {
        $href = "#";

        if ($link["type"] == 'home') {
            $href = route('front.index');
        } else if ($link["type"] == 'services') {
            $href = route('front.services');
        } else if ($link["type"] == 'packages') {
            $href = route('front.packages');
        } else if ($link["type"] == 'portfolios') {
            $href = route('front.portfolios');
        } else if ($link["type"] == 'team') {
            $href = route('front.team');
        } else if ($link["type"] == 'career') {
            $href = route('front.career');
        } else if ($link["type"] == 'calendar') {
            $href = route('front.calendar');
        } else if ($link["type"] == 'gallery') {
            $href = route('front.gallery');
        } else if ($link["type"] == 'faq') {
            $href = route('front.faq');
        } else if ($link["type"] == 'products') {
            $href = route('front.product');
        } else if ($link["type"] == 'cart') {
            $href = route('front.cart');
        } else if ($link["type"] == 'checkout') {
            $href = route('front.checkout');
        } else if ($link["type"] == 'blogs') {
            $href = route('front.blogs');
        } else if ($link["type"] == 'rss') {
            $href = route('front.rss');
        } else if ($link["type"] == 'contact') {
            $href = route('front.contact');
        } else if ($link["type"] == 'custom') {
            if (empty($link["href"])) {
                $href = "#";
            } else {
                $href = $link["href"];
            }
        } else {
            $pageid = (int) $link["type"];
            $page = Page::find($pageid);
            $href = route('front.dynamicPage', [$page->slug, $page->id]);
        }

        return $href;
    }
}

if (!function_exists('create_menu')) {
    function create_menu($arr)
    {
        echo '<ul style="z-index: 0;">';
        foreach ($arr["children"] as $el) {

            // determine if the class is 'submenus' or not
            $class = null;
            if (array_key_exists("children", $el)) {
                $class = 'class="submenus"';
            }

            // determine the href
            $href = getHref($el);

            echo '<li ' . $class . '>';
            echo '<a  href="' . $href . '" target="' . $el["target"] . '">' . $el["text"] . '</a>';
            if (array_key_exists("children", $el)) {
                create_menu($el);
            }
            echo '</li>';
        }
        echo '</ul>';
    }
}

if (!function_exists('hex2rgb')) {
    function hex2rgb($colour)
    {
        if ($colour[0] == '#') {
            $colour = substr($colour, 1);
        }
        if (strlen($colour) == 6) {
            list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
        } elseif (strlen($colour) == 3) {
            list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        return array('red' => $r, 'green' => $g, 'blue' => $b);
    }
}

if (!function_exists('replaceBaseUrl')) {
    function replaceBaseUrl($html)
    {
        $startDelimiter = 'src="';
        $endDelimiter = '/assets/front/img/summernote';
        // $contents = array();
        $startDelimiterLength = strlen($startDelimiter);
        $endDelimiterLength = strlen($endDelimiter);
        $startFrom = $contentStart = $contentEnd = 0;
        while (false !== ($contentStart = strpos($html, $startDelimiter, $startFrom))) {
            $contentStart += $startDelimiterLength;
            $contentEnd = strpos($html, $endDelimiter, $contentStart);
            if (false === $contentEnd) {
                break;
            }
            $html = substr_replace($html, url('/'), $contentStart, $contentEnd - $contentStart);
            $startFrom = $contentEnd + $endDelimiterLength;
        }

        return $html;
    }
}
