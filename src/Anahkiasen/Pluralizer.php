<?php
namespace Anahkiasen;

class Pluralizer
{
    /**
     * An array of pluralizing patterns
     *
     * @var array
     */
    public $patterns = array(
        'plural' => array(
            '/(quiz)$/i' => "$1zes",
            '/^(ox)$/i' => "$1en",
            '/([m|l])ouse$/i' => "$1ice",
            '/(matr|vert|ind)ix|ex$/i' => "$1ices",
            '/(x|ch|ss|sh)$/i' => "$1es",
            '/([^aeiouy]|qu)y$/i' => "$1ies",
            '/(hive)$/i' => "$1s",
            '/(?:([^f])fe|([lr])f)$/i' => "$1$2ves",
            '/(shea|lea|loa|thie)f$/i' => "$1ves",
            '/sis$/i' => "ses",
            '/([ti])um$/i' => "$1a",
            '/(tomat|potat|ech|her|vet)o$/i' => "$1oes",
            '/(bu)s$/i' => "$1ses",
            '/(alias)$/i' => "$1es",
            '/(octop)us$/i' => "$1i",
            '/(ax|test)is$/i' => "$1es",
            '/(us)$/i' => "$1es",
            '/s$/i' => "s",
            '/$/' => "s"
        ),

        'singular' => array(
            '/(quiz)zes$/i' => "$1",
            '/(matr)ices$/i' => "$1ix",
            '/(vert|ind)ices$/i' => "$1ex",
            '/^(ox)en$/i' => "$1",
            '/(alias)es$/i' => "$1",
            '/(octop|vir)i$/i' => "$1us",
            '/(cris|ax|test)es$/i' => "$1is",
            '/(shoe)s$/i' => "$1",
            '/(o)es$/i' => "$1",
            '/(bus)es$/i' => "$1",
            '/([m|l])ice$/i' => "$1ouse",
            '/(x|ch|ss|sh)es$/i' => "$1",
            '/(m)ovies$/i' => "$1ovie",
            '/(s)eries$/i' => "$1eries",
            '/([^aeiouy]|qu)ies$/i' => "$1y",
            '/([lr])ves$/i' => "$1f",
            '/(tive)s$/i' => "$1",
            '/(hive)s$/i' => "$1",
            '/(li|wi|kni)ves$/i' => "$1fe",
            '/(shea|loa|lea|thie)ves$/i' => "$1f",
            '/(^analy)ses$/i' => "$1sis",
            '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => "$1$2sis",
            '/([ti])a$/i' => "$1um",
            '/(n)ews$/i' => "$1ews",
            '/(h|bl)ouses$/i' => "$1ouse",
            '/(corpse)s$/i' => "$1",
            '/(us)es$/i' => "$1",
            '/(us|ss)$/i' => "$1",
            '/s$/i' => "",
        ),

        'irregular' => array(
            'child' => 'children',
            'foot' => 'feet',
            'goose' => 'geese',
            'man' => 'men',
            'move' => 'moves',
            'person' => 'people',
            'sex' => 'sexes',
            'tooth' => 'teeth',
        ),

        'uncountable' => array(
            'audio',
            'equipment',
            'deer',
            'fish',
            'gold',
            'information',
            'money',
            'rice',
            'police',
            'series',
            'sheep',
            'species',
            'moose',
            'chassis',
            'traffic',
        ),
    );

    /**
     * The "strings" configuration array.
     *
     * @var array
     */
    protected $config;

    /**
     * The cached copies of the plural inflections.
     */
    protected $plural = array();

    /**
     * The cached copies of the singular inflections.
     *
     * @var array
     */
    protected $singular = array();

    /**
     * Get the singular form of the given word.
     *
     * @param  string $value
     * @return string
     */
    public function singular($value)
    {
        // First we'll check the cache of inflected values. We cache each word that
        // is inflected so we don't have to spin through the regular expressions
        // each time we need to inflect a given value for the developer.
        if (isset($this->singular[$value])) {
            return $this->singular[$value];
        }

        // English words may be automatically inflected using regular expressions.
        // If the word is English, we'll just pass off the word to the automatic
        // inflection method and return the result, which is cached.
        $irregular = $this->patterns['irregular'];

        $result = $this->auto($value, $this->patterns['singular'], $irregular);

        return $this->singular[$value] = $result ?: $value;
    }

    /**
     * Get the plural form of the given word.
     *
     * @param  string $value
     * @param  int    $count
     * @return string
     */
    public function plural($value, $count = 2)
    {
        if ($count == 1) return $value;

        // First we'll check the cache of inflected values. We cache each word that
        // is inflected so we don't have to spin through the regular expressions
        // each time we need to inflect a given value for the developer.
        if (isset($this->plural[$value])) {
            return $this->plural[$value];
        }

        // English words may be automatically inflected using regular expressions.
        // If the word is English, we'll just pass off the word to the automatic
        // inflection method and return the result, which is cached.
        $irregular = array_flip($this->patterns['irregular']);

        $result = $this->auto($value, $this->patterns['plural'], $irregular);

        return $this->plural[$value] = $result;
    }

    /**
     * Perform auto inflection on an English word.
     *
     * @param  string $value
     * @param  array  $source
     * @param  array  $irregular
     * @return string
     */
    protected function auto($value, $source, $irregular)
    {
        // If the word hasn't been cached, we'll check the list of words that
        // that are "uncountable". This should be a quick look up since we
        // can just hit the array directly for the value.
        if (in_array(strtolower($value), $this->patterns['uncountable'])) {
            return $value;
        }

        // Next, we will check the "irregular" patterns, which contain words
        // like "children" and "teeth" which can not be inflected using the
        // typically used regular expression matching approach.
        foreach ($irregular as $irregular => $pattern) {
            if (preg_match($pattern = '/'.$pattern.'$/i', $value)) {
                return preg_replace($pattern, $irregular, $value);
            }
        }

        // Finally we'll spin through the array of regular expressions and
        // and look for matches for the word. If we find a match we will
        // cache and return the inflected value for quick look up.
        foreach ($source as $pattern => $inflected) {
            if (preg_match($pattern, $value)) {
                return preg_replace($pattern, $inflected, $value);
            }
        }
    }
}
