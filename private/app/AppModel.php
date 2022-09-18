<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppModel extends Model
{
    /**
     * @param \Illuminate\Database\Eloquent\Model|string $model
     * @param string $slug
     * @param int|null $id
     * @return null|string|string[]
     */
    public static function createSlug($model, $text, $id = null)
    {
        /*
        $slug = str_slug($text);

        if (empty($slug)) {
            $slug = self::slugGenerate($text);
        }
        */

        //$slug = self::slugGenerate($text);
        $slug = self::cakeSlug($text);

        // check how WordPress generate slugs

        $i = 0;

        $conditions = [];

        $conditions[0] = ['slug', '=', $slug];

        if (!is_null($id)) {
            $conditions[1] = ['id', '<>', $id];
        }

        // https://stackoverflow.com/a/51302803/1794834
        while ($model::query()->where($conditions)->count()) {
            if (!preg_match('/-{1}[0-9]+$/', $slug)) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace('/[0-9]+$/', ++$i, $slug);
            }
            $conditions[0] = ['slug', '=', $slug];
        }

        return $slug;
    }

    /**
     * @see https://stackoverflow.com/a/2955878/1794834
     */
    public static function slugGenerate($text)
    {
        $text = filter_var($text, FILTER_SANITIZE_STRING);

        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        /*
        if (function_exists('iconv')) {
            // transliterate
            // https://github.com/symfony/polyfill-iconv
            $text = @iconv('utf-8', 'utf-8//TRANSLIT', $text);
        } else {
            //$encoding = mb_detect_encoding($text, "auto");
            //$text     = mb_convert_encoding($text, 'UTF-8', $encoding);
            @ini_set('mbstring.substitute_character', "none");
            $text     = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
        }
        */

        // remove unwanted characters
        //$text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = mb_strtolower($text);

        if (empty($text)) {
            return '';
        }

        return $text;
    }

    /**
     * Returns a string with all spaces converted to dashes (by default),
     * and non word characters removed.
     *
     * ### Options:
     *
     * - `replacement`: Replacement string. Default '-'.
     * - `preserve`: Specific non-word character to preserve. Default `null`.
     *   For e.g. this option can be set to '.' to generate clean file names.
     *
     * @param string $string the string you want to slug
     * @param array $options If string it will be use as replacement character
     *   or an array of options.
     *
     * @return string
     *
     * @see https://github.com/cakephp/cakephp/blob/3.6.11/src/Utility/Text.php#L1109
     */
    public static function cakeSlug($string, $options = [])
    {
        if (is_string($options)) {
            $options = ['replacement' => $options];
        }
        $options += [
            'replacement' => '-',
            'preserve' => null,
        ];

        $regex = '^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}';
        if ($options['preserve']) {
            $regex .= preg_quote($options['preserve'], '/');
        }
        $quotedReplacement = preg_quote($options['replacement'], '/');

        $map = [
            '/[' . $regex . ']/mu' => ' ',

            '/[\s]+/mu' => $options['replacement'],

            sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        ];

        $string = preg_replace(array_keys($map), $map, $string);

        return mb_strtolower($string);
    }

    public static function purify($content = null, $configs = [])
    {
        if (!$content) {
            return $content;
        }

        $config = \HTMLPurifier_Config::createDefault();

        // Core
        $config->set('Core.Encoding', 'utf-8');

        // Cache
        $config->set('Cache.DefinitionImpl', null);

        // HTML
        $config->set('HTML.Doctype', 'XHTML 1.0 Strict'); // valid XML output (?)
        //$config->set('HTML.AllowedElements', ['p', 'div', 'a', 'br', 'ul', 'ol', 'li', 'b', 'i', 'img']);
        // remove all attributes except a.href
        //$config->set('HTML.AllowedAttributes', ['a.href', 'a.title', 'img.alt', 'img.src']);
        $config->set('HTML.Allowed', '*[style|class|dir],p,h1,h2,h3,h4,h5,h6,pre,div,blockquote,strong,em,span,' .
            'sup,sub,ul,ol,li,a[href|title|rel|target],br,b,i,img[style|alt|title|src|width|height],code,
            table[border|cellspacing|cellpadding|width|align|summary|style],tr,tbody,' .
            'td[colspan|rowspan|align|valign|abbr],' .
            'th[colspan|rowspan|align|valign|abbr]');

        // CSS
        $config->set(
            'CSS.AllowedProperties',
            'font,font-size,font-weight,font-style,font-family,text-decoration,color,background-color,' .
            'text-align,float,margin,margin-left,margin-right,display,padding,padding-left,padding-right'
        );
        $config->set('CSS.AllowTricky', true);
        //

        // Format
        $config->set('AutoFormat.AutoParagraph', true);
        $config->set('AutoFormat.RemoveEmpty', true);

        foreach ($configs as $config_key => $config_value) {
            $config->set($config_key, $config_value);
        }

        /**
         * @see https://gist.github.com/lluchs/3303693
         */
        $def = $config->getHTMLDefinition(true);
        $def->addAttribute('a', 'target', 'Enum#_blank');
        $def->addAttribute('table', 'align', 'Enum#left,right,center');
        //$def->addElement('figure', 'Block', 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow', 'Common');
        //$def->addElement('figcaption', 'Inline', 'Flow', 'Common');

        $purifier = new \HTMLPurifier($config);

        return $purifier->purify($content);
    }

    public static function purifyStripHtml($content = null, $configs = [])
    {
        if (!$content) {
            return $content;
        }

        $config = \HTMLPurifier_Config::createDefault();

        // Core
        $config->set('Core.Encoding', 'utf-8');

        // Cache
        $config->set('Cache.DefinitionImpl', null);

        // HTML
        $config->set('HTML.Doctype', 'XHTML 1.0 Strict');
        $config->set('HTML.Allowed', '');

        // Format
        $config->set('AutoFormat.RemoveEmpty', true);

        foreach ($configs as $config_key => $config_value) {
            $config->set($config_key, $config_value);
        }

        $purifier = new \HTMLPurifier($config);

        return $purifier->purify($content);
    }

    /**
     * @see https://wordpress.stackexchange.com/a/66719/28527
     *
     * @param $content
     *
     * @return null|string|string[]
     */
    public static function stripSomeParagraphs($content)
    {
        /*
        $content = preg_replace(
            '/<p>(([\s]*)|[\s]*(<img[^>]*>|\[[^\]]*\])[\s]*)<\/p>/',
            '$3',
            $content
        );
        */

        $content = preg_replace(
            '/<p>(\[.*\])<\/p>/',
            '$1',
            $content
        );

        return $content;
    }

    public function getTextWords($text = null, $length = null, $strip = false, $leading = true)
    {
        if (!$text) {
            return '';
        }

        if (!$length) {
            return $text;
        }

        if ($strip) {
            $text = strip_tags($text);
        }

        $text_array = explode(' ', $text);

        if (count($text_array) > $length) {
            array_splice($text_array, $length);
            $text = implode(' ', $text_array);

            if ($leading) {
                $text .= '...';
            }
        }

        return $text;
    }

    /**
     * @param null $string
     * @param int $max
     *
     * @return null|string
     *
     * @see https://stackoverflow.com/a/8286140/1794834
     */
    public function getTextChars($text = null, $length = null, $strip = false, $leading = true)
    {
        if (!$text) {
            return '';
        }

        if (!$length) {
            return $text;
        }

        if ($strip) {
            $text = strip_tags($text);
        }

        if (mb_strlen($text) > $length) {
            $token = strtok($text, ' ');

            $text = '';

            while ($token !== false && mb_strlen($text) < $length) {
                if (mb_strlen($text) + mb_strlen($token) <= $length) {
                    $text .= $token . ' ';
                } else {
                    break;
                }
                $token = strtok(' ');
            }

            $text = trim($text);

            if ($leading) {
                $text .= '...';
            }
        }

        return $text;
    }
}
