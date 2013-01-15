<?php namespace BigElephant\String;

if ( ! defined('MB_STRING')) define('MB_STRING', (int) function_exists('mb_get_info'));

use BigElephant\String\Pluralizer\PluralizerInterface;

class String implements StringInterface {

	/**
	 * An array of ASCII characters and what they're to be replaced with.
	 *
	 * @var array
	 */
	private $ascii = array(
		'/æ|ǽ/' => 'ae',
		'/œ/' => 'oe',
		'/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|А/' => 'A',
		'/à|á|â|ã|ä|å|ǻ|ā|ă|ą|ǎ|ª|а/' => 'a',
		'/Б/' => 'B',
		'/б/' => 'b',
		'/Ç|Ć|Ĉ|Ċ|Č|Ц/' => 'C',
		'/ç|ć|ĉ|ċ|č|ц/' => 'c',
		'/Ð|Ď|Đ|Д/' => 'Dj',
		'/ð|ď|đ|д/' => 'dj',
		'/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Е|Ё|Э/' => 'E',
		'/è|é|ê|ë|ē|ĕ|ė|ę|ě|е|ё|э/' => 'e',
		'/Ф/' => 'F',
		'/ƒ|ф/' => 'f',
		'/Ĝ|Ğ|Ġ|Ģ|Г/' => 'G',
		'/п/' => 'p',
		'/Ŕ|Ŗ|Ř|Р/' => 'R',
		'/ŕ|ŗ|ř|р/' => 'r',
		'/ĝ|ğ|ġ|ģ|г/' => 'g',
		'/Ĥ|Ħ|Х/' => 'H',
		'/ĥ|ħ|х/' => 'h',
		'/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|И/' => 'I',
		'/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|и/' => 'i',
		'/Ĵ|Й/' => 'J',
		'/ĵ|й/' => 'j',
		'/Ķ|К/' => 'K',
		'/ķ|к/' => 'k',
		'/Ĺ|Ļ|Ľ|Ŀ|Ł|Л/' => 'L',
		'/ĺ|ļ|ľ|ŀ|ł|л/' => 'l',
		'/М/' => 'M',
		'/м/' => 'm',
		'/Ñ|Ń|Ņ|Ň|Н/' => 'N',
		'/ñ|ń|ņ|ň|ŉ|н/' => 'n',
		'/Ö|Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|О/' => 'O',
		'/ö|ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|о/' => 'o',
		'/П/' => 'P',
		'/Ś|Ŝ|Ş|Ș|Š|С/' => 'S',
		'/ś|ŝ|ş|ș|š|ſ|с/' => 's',
		'/Ţ|Ț|Ť|Ŧ|Т/' => 'T',
		'/ţ|ț|ť|ŧ|т/' => 't',
		'/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ü|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|У/' => 'U',
		'/ù|ú|û|ũ|ū|ŭ|ů|ü|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|у/' => 'u',
		'/В/' => 'V',
		'/в/' => 'v',
		'/Ý|Ÿ|Ŷ|Ы/' => 'Y',
		'/ý|ÿ|ŷ|ы/' => 'y',
		'/Ŵ/' => 'W',
		'/ŵ/' => 'w',
		'/Ź|Ż|Ž|З/' => 'Z',
		'/ź|ż|ž|з/' => 'z',
		'/Æ|Ǽ/' => 'AE',
		'/ß/'=> 'ss',
		'/Ĳ/' => 'IJ',
		'/ĳ/' => 'ij',
		'/Œ/' => 'OE',
		'/Ч/' => 'Ch',
		'/ч/' => 'ch',
		'/Ю/' => 'Ju',
		'/ю/' => 'ju',
		'/Я/' => 'Ja',
		'/я/' => 'ja',
		'/Ш/' => 'Sh',
		'/ш/' => 'sh',
		'/Щ/' => 'Shch',
		'/щ/' => 'shch',
		'/Ж/' => 'Zh',
		'/ж/' => 'zh',
	);


	 /**
	 * The pluralizer instance.
	 *
	 * @var BigElephant\String\Pluralizer\PluralizerInterface
	 */
	public $pluralizer;

	/**
	 * The current encoding
	 *
	 * @var string
	 */
	private $encoding = 'UTF-8';

	public function __construct(PluralizerInterface $pluralizer)
	{
		$this->pluralizer = $pluralizer;
	}

	/**
	 * Get the length of a string.
	 *
	 * @param  string $string
	 * @return int
	 */
	public function length($string)
	{
		return (MB_STRING) ? mb_strlen($string, $this->encoding) : strlen($string);
	}

	/**
	 * Convert a string to lowercase.
	 *
	 * @param  string $string
	 * @return string
	 */
	public function lower($string)
	{
		return (MB_STRING) ? mb_strtolower($string, $this->encoding) : strtolower($string);
	}

	/**
	 * Convert a string to uppercase.
	 *
	 * @param  string $string
	 * @return string
	 */
	public function upper($string)
	{
		return (MB_STRING) ? mb_strtoupper($string, $this->encoding) : strtoupper($string);
	}

	/**
	 * Convert first letter of each word to uppercase.
	 *
	 * @param  string $string
	 * @return string
	 */
	public function upperWords($string)
	{
		return (MB_STRING) ? mb_convert_case($string, MB_CASE_TITLE, $this->encoding) : ucwords($this->lower($string));
	}

	/**
	 * Limit the number of characters in a string.
	 *
	 * @param  string $string
	 * @param  int    $limit
	 * @param  string $elipses
	 * @return string
	 */
	public function limit($string, $limit, $elipses = '...')
	{
		if ($this->length($string) <= $limit)
		{
			return $string;
		}

		$string = (MB_STRING) ? mb_substr($string, 0, $limit, $this->encoding) : substr($string, 0, $limit);

		return $string.$elipses;
	}

	/**
	 * Limit the number of chracters in a string including the elipses.
	 *
	 * @param  string $string
	 * @param  int    $limit
	 * @param  string $elipses
	 * @return string
	 */
	public function limitExact($string, $limit, $elipses = '...')
	{
		if ($this->lenght($string) <= $limit)
		{
			return $string;
		}

		return $this->limit($string, $limit - $this->length($elipses), $elipses);
	}

	/**
	 * Limit the number of words in a string.
	 *
	 * @param  string $string
	 * @param  int    $words
	 * @param  string $elipses
	 * @return string
	 */
	public function limitWords($string, $words, $elipses = '...')
	{
		if (trim($string) == '')
		{
			return '';
		}

		preg_match('/^\s*+(?:\S++\s*+){1,'.$words.'}/u', $string, $matches);

		if ($this->length($string) == $this->length($matches[0]))
		{
			$elipses = '';
		}

		return rtrim($matches[0]).$elipses;
	}

	/**
	 * Adds a space to a string after a given amount of contiguous, non-whitespace characters.
	 *
	 * @param  string $string
	 * @return string
	 */
	public function wordWrap($string, $length)
	{
		if ($length < 1 OR $length > $this->length($string))
		{
			return $string;
		}

		return preg_replace('#[^\s]{' . $length . '}(?=[^\s])#u', '$0  ', $string);
	}

	/**
	 * Get the singular form of the given word.
	 *
	 * @param  string $string
	 * @return string
	 */
	public function singular($string)
	{
		return $this->pluralizer->singular($string);
	}

	/**
	 * Get the plural form of the given word.
	 *
	 * @param  string $string
	 * @param  int    $count
	 * @return string
	 */
	public function plural($string, $count = 2)
	{
		return $this->pluralizer->plural($string, $count);
	}

	/**
	 * Generate a URL friendly "slug" from a given string.
	 *
	 * @param  string $string
	 * @param  string $separator
	 * @return string
	 */
	public function slug($string, $separator = '-')
	{
		$string = $this->ascii($string);

		// Remove all characters that are not the separator, letters, numbers, or whitespace.
		$string = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', $this->lower($string));

		// Replace all separator characters and whitespace by a single separator
		$string = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $string);

		return trim($string, $separator);
	}

	/**
	 * Convert a string to 7-bit ASCII.
	 *
	 * This is helpful for converting UTF-8 strings for usage in URLs, etc.
	 *
	 * @param  string $string
	 * @return string
	 */
	public function ascii($string)
	{
		$foreign = $this->ascii;

		$string = preg_replace(array_keys($foreign), array_values($foreign), $string);

		return preg_replace('/[^\x09\x0A\x0D\x20-\x7E]/', '', $string);
	}

	/**
	 * Convert a string to camel-case
	 *
	 * @param  string  $string
	 * @param  boolean $upperFirst
	 * @return string
	 */
	public function camelCase($string, $upperFirst = true)
	{
		$string = str_replace(' ', '', $this->upperWords(str_replace(array('-', '_'), ' ', $string)));

		return $upperFirst ? $string : lcfirst($string);
	}

	/**
	 * Convert a string to snake case
	 * 
	 * @param  string $string
	 * @return string
	 */
	public function snakeCase($string, $delimiter = '_')
	{
		return trim(preg_replace_callback('/[A-Z]/', function($match) use ($delimiter)
		{
			return $delimiter.strtolower($match[0]);

		}, $string), $delimiter);
	}

	/**
	 * Return the "URI" style segments in a given string.
	 *
	 * @param  string $string
	 * @return array
	 */
	public function segments($string)
	{
		return array_diff(explode('/', trim($string, '/')), array(''));
	}

	/**
	 * Generate a random alpha or alpha-numeric string.
	 *
	 * @param  int    $length
	 * @param  string $type
	 * @return string
	 */
	public function random($length, $type = 'alnum')
	{
		return substr(str_shuffle(str_repeat($this->pool($type), 5)), 0, $length);
	}

	 /**
	 * Determine if a given string matches a given pattern.
	 *
	 * @param  string $string
	 * @param  string $pattern
	 * @return bool
	 */
	public function matches($string, $pattern)
	{
		// Asterisks are translated into zero-or-more regular expression wildcards
		// to make it convenient to check if the URI starts with a given pattern
		// such as "library/*". This is only done when not root.
		if ($pattern !== '/') 
		{
			$pattern = str_replace('*', '(.*)', $pattern).'\z';
		} 
		else 
		{
			$pattern = '^/$';
		}

		return preg_match('#'.$pattern.'#', $string);
	}

	/**
	* Converts URLs to anchors.
	*
	* @param  string $string
	* @return string
	*/
	public function hrefToAnchor($string)
	{
		// TODO: think I will abstract this out to be a linker to support urls, emails and bbcode or another component
	}

	/**
	 * Get the character pool for a given type of random string.
	 *
	 * @param  string $type
	 * @return string
	 */
	protected function pool($type)
	{
		switch ($type) 
		{
			case 'alpha':
				return 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

			case 'alnum':
				return '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

			default:
				throw new \Exception("Invalid random string type [$type].");
		}
	}

	/**
	 * Determine if a given string ends with a given needle.
	 *
	 * @param string $haystack
	 * @param string $needle
	 * @return bool
	 */
	public function endsWith($haystack, $needle)
	{
		return $needle == substr($haystack, strlen($haystack) - strlen($needle));
	}

	/**
	 * Determine if a string starts with a given needle.
	 *
	 * @param  string  $haystack
	 * @param  string  $needle
	 * @return bool
	 */
	public function startsWith($haystack, $needle)
	{
		return strpos($haystack, $needle) === 0;
	}

	/**
	 * Determine if a given string contains a given sub-string.
	 *
	 * @param  string        $haystack
	 * @param  string|array  $needle
	 * @return bool
	 */
	public function contains($haystack, $needle)
	{
		foreach ((array) $needle as $n)
		{
			if (strpos($haystack, $n) !== false) return true;
		}

		return false;
	}

	/**
	 * Cap a string with a single instance of a given value.
	 *
	 * @param  string  $value
	 * @param  string  $cap
	 * @return string
	 */
	public function finish($value, $cap)
	{
		return rtrim($value, $cap).$cap;
	}
}