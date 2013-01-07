<?php
namespace Anahkiasen;

if (!defined('MB_STRING')) {
    define('MB_STRING', (int) function_exists('mb_get_info'));
}

class Str
{
    /**
     * An array of ASCII characters and what they're to be replaced with
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
     * @var Pluralizer
     */
    public $pluralizer;

    /**
     * The current encoding
     *
     * @var string
     */
    private $encoding = 'UTF-8';

    public function __construct(Pluralizer $pluralizer)
    {
        $this->pluralizer = $pluralizer;
    }

    /**
     * Get the length of a string.
     *
     * <code>
     *    // Get the length of a string
     *    $length = Str::length('Taylor Otwell');
     *
     *    // Get the length of a multi-byte string
     *    $length = Str::length('Τάχιστη')
     * </code>
     *
     * @param  string $value
     * @return int
     */
    public function length($value)
    {
        return (MB_STRING) ? mb_strlen($value, $this->encoding) : strlen($value);
    }

    /**
     * Convert a string to lowercase.
     *
     * <code>
     *    // Convert a string to lowercase
     *    $lower = Str::lower('Taylor Otwell');
     *
     *    // Convert a multi-byte string to lowercase
     *    $lower = Str::lower('Τάχιστη');
     * </code>
     *
     * @param  string $value
     * @return string
     */
    public function lower($value)
    {
        return (MB_STRING) ? mb_strtolower($value, $this->encoding) : strtolower($value);
    }

    /**
     * Convert a string to uppercase.
     *
     * <code>
     *    // Convert a string to uppercase
     *    $upper = Str::upper('Taylor Otwell');
     *
     *    // Convert a multi-byte string to uppercase
     *    $upper = Str::upper('Τάχιστη');
     * </code>
     *
     * @param  string $value
     * @return string
     */
    public function upper($value)
    {
        return (MB_STRING) ? mb_strtoupper($value, $this->encoding) : strtoupper($value);
    }

    /**
     * Convert a string to title case (ucwords equivalent).
     *
     * <code>
     *    // Convert a string to title case
     *    $title = Str::title('taylor otwell');
     *
     *    // Convert a multi-byte string to title case
     *    $title = Str::title('νωθρού κυνός');
     * </code>
     *
     * @param  string $value
     * @return string
     */
    public function title($value)
    {
        if (MB_STRING) {
            return mb_convert_case($value, MB_CASE_TITLE, $this->encoding);
        }

        return ucwords(strtolower($value));
    }

    /**
     * Limit the number of characters in a string.
     *
     * <code>
     *    // Returns "Tay..."
     *    echo Str::limit('Taylor Otwell', 3);
     *
     *    // Limit the number of characters and append a custom ending
     *    echo Str::limit('Taylor Otwell', 3, '---');
     * </code>
     *
     * @param  string $value
     * @param  int    $limit
     * @param  string $end
     * @return string
     */
    public function limit($value, $limit = 100, $end = '...')
    {
        if ($this->length($value) <= $limit) return $value;

        if (MB_STRING) {
            return mb_substr($value, 0, $limit, $this->encoding).$end;
        }

        return substr($value, 0, $limit).$end;
    }

    /**
     * Limit the number of chracters in a string including custom ending
     *
     * <code>
     *    // Returns "Taylor..."
     *    echo Str::limit_exact('Taylor Otwell', 9);
     *
     *    // Limit the number of characters and append a custom ending
     *    echo Str::limit_exact('Taylor Otwell', 9, '---');
     * </code>
     *
     * @param  string $value
     * @param  int    $limit
     * @param  string $end
     * @return string
     */
    public function limit_exact($value, $limit = 100, $end = '...')
    {
        if ($this->length($value) <= $limit) return $value;

        $limit -= $this->length($end);

        return $this->limit($value, $limit, $end);
    }

    /**
     * Limit the number of words in a string.
     *
     * <code>
     *    // Returns "This is a..."
     *    echo Str::words('This is a sentence.', 3);
     *
     *    // Limit the number of words and append a custom ending
     *    echo Str::words('This is a sentence.', 3, '---');
     * </code>
     *
     * @param  string $value
     * @param  int    $words
     * @param  string $end
     * @return string
     */
    public function words($value, $words = 100, $end = '...')
    {
        if (trim($value) == '') return '';

        preg_match('/^\s*+(?:\S++\s*+){1,'.$words.'}/u', $value, $matches);

        if ($this->length($value) == $this->length($matches[0])) {
            $end = '';
        }

        return rtrim($matches[0]).$end;
    }

    /**
     * Get the singular form of the given word.
     *
     * @param  string $value
     * @return string
     */
    public function singular($value)
    {
        return $this->pluralizer->singular($value);
    }

    /**
     * Get the plural form of the given word.
     *
     * <code>
     *    // Returns the plural form of "child"
     *    $plural = Str::plural('child', 10);
     *
     *    // Returns the singular form of "octocat" since count is one
     *    $plural = Str::plural('octocat', 1);
     * </code>
     *
     * @param  string $value
     * @param  int    $count
     * @return string
     */
    public function plural($value, $count = 2)
    {
        return $this->pluralizer->plural($value, $count);
    }

    /**
     * Generate a URL friendly "slug" from a given string.
     *
     * <code>
     *    // Returns "this-is-my-blog-post"
     *    $slug = Str::slug('This is my blog post!');
     *
     *    // Returns "this_is_my_blog_post"
     *    $slug = Str::slug('This is my blog post!', '_');
     * </code>
     *
     * @param  string $title
     * @param  string $separator
     * @return string
     */
    public function slug($title, $separator = '-')
    {
        $title = $this->ascii($title);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', $this->lower($title));

        // Replace all separator characters and whitespace by a single separator
        $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

        return trim($title, $separator);
    }

    /**
     * Convert a string to 7-bit ASCII.
     *
     * This is helpful for converting UTF-8 strings for usage in URLs, etc.
     *
     * @param  string $value
     * @return string
     */
    public function ascii($value)
    {
        $foreign = $this->ascii;

        $value = preg_replace(array_keys($foreign), array_values($foreign), $value);

        return preg_replace('/[^\x09\x0A\x0D\x20-\x7E]/', '', $value);
    }

    /**
     * Convert a string to an underscored, camel-cased class name.
     *
     * This method is primarily used to format task and controller names.
     *
     * <code>
     *    // Returns "Task_Name"
     *    $class = Str::classify('task_name');
     *
     *    // Returns "Taylor_Otwell"
     *    $class = Str::classify('taylor otwell')
     * </code>
     *
     * @param  string $value
     * @return string
     */
    public function classify($value)
    {
        $search = array('_', '-', '.', '/');

        return str_replace(' ', '_', $this->title(str_replace($search, ' ', $value)));
    }

    /**
     * Return the "URI" style segments in a given string.
     *
     * @param  string $value
     * @return array
     */
    public function segments($value)
    {
        return array_diff(explode('/', trim($value, '/')), array(''));
    }

    /**
     * Generate a random alpha or alpha-numeric string.
     *
     * <code>
     *    // Generate a 40 character random alpha-numeric string
     *    echo Str::random(40);
     *
     *    // Generate a 16 character random alphabetic string
     *    echo Str::random(16, 'alpha');
     * <code>
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
     * @param  string $pattern
     * @param  string $value
     * @return bool
     */
    public function is($pattern, $value)
    {
        // Asterisks are translated into zero-or-more regular expression wildcards
        // to make it convenient to check if the URI starts with a given pattern
        // such as "library/*". This is only done when not root.
        if ($pattern !== '/') {
            $pattern = str_replace('*', '(.*)', $pattern).'\z';
        } else {
            $pattern = '^/$';
        }

        return preg_match('#'.$pattern.'#', $value);
    }

    /**
     * Get the character pool for a given type of random string.
     *
     * @param  string $type
     * @return string
     */
    protected function pool($type)
    {
        switch ($type) {
            case 'alpha':
                return 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            case 'alnum':
                return '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            default:
                throw new \Exception("Invalid random string type [$type].");
        }
    }

}
