<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Philip Sturgeon
 */

// ------------------------------------------------------------------------

/**
 * Create URL Title - modified version
 *
 * Takes a "title" string as input and creates a
 * human-friendly URL string with either a dash
 * or an underscore as the word separator.
 * 
 * Added support for Cyrillic characters.
 *
 * @access	public
 * @param	string	the string
 * @param	string	the separator: dash, or underscore
 * @return	string
 */
if ( ! function_exists('url_title'))
{
	function url_title($str, $separator = 'dash', $lowercase = FALSE)
    {
        if ($separator == 'dash')
        {
            $search        = '_';
            $replace    = '-';
        }
        else
        {
            $search        = '-';
            $replace    = '_';
        }

        $trans = array(
                        '&\#\d+?;'                => '',
                        '&\S+?;'                => '',
                        '\s+'                    => $replace,
                        '[^a-zАБВГҐДЕЄЁЖЗИІЫЇЙКЛМНОПРСТУФХЦЧШЩЮЯЬЪабвгґдеєёжзиіыїйклмнопрстуфхцчшщюяьъ0-9\-\._]' => '',
                        $replace.'+'            => $replace,
                        $replace.'$'            => $replace,
                        '^'.$replace            => $replace,
                        '\.+$'                    => ''
                      );

        $str = strip_tags($str);

        foreach ($trans as $key => $val)
        {
            $str = preg_replace("#".$key."#i", $val, $str);
        }

        if ($lowercase === TRUE)
        {
            $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
        }
        
        return trim(stripslashes($str));
    }
}

// ------------------------------------------------------------------------

function shorten_url($url = '')
{
	$CI =& get_instance();
	
	$CI->load->library('cURL');

	if(!$url)
	{
		$url = site_url($CI->uri->uri_string());
	}
	
	// If no a protocol in URL, assume its a CI link
	elseif(!preg_match('!^\w+://! i', $url))
	{
		$url = site_url($url);
	}

	return $CI->curl->get('http://tinyurl.com/api-create.php?url='.$url);
}

?>