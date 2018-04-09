<?php
/**
 * This file is part of Kabooodle.
 * Copyright (c) 2017. Kabooodle,LLC <help@kabooodle.com>
 */

namespace Kabooodle\Libraries\Linkify;

/**
 * Class Linkify
 * @package Kabooodle\Libraries\Linkify
 */
class Linkify implements LinkifyInterface
{
    const HREF_CLASSES = ' text-u-l _600 ';

    /**
     * Default options.
     *
     * @var array
     */
    protected $defaultOptions = [
        'attr' => ['class' => self::HREF_CLASSES]
    ];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * Constructor.
     *
     * @param array $options Default options.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options ? : $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function process($text, array $options = [])
    {
        return $this->linkify($text, true, true, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function processUrls($text, array $options = [])
    {
        return $this->linkify($text, true, false, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function processEmails($text, array $options = [])
    {
        return $this->linkify($text, false, true, $options);
    }

    /**
     * Add links to text.
     *
     * @param string $text    Text to linkify.
     * @param bool   $urls    Linkify URLs?
     * @param bool   $emails  Linkify email addresses?
     * @param array  $options Options.
     *
     * @return string Linkified text.
     */
    protected function linkify($text, $urls = true, $emails = true, array $options = [])
    {
        if (false === $urls && false === $emails) {
            // nothing to do...
            return $text;
        }

        $options = array_merge_recursive($this->options + $this->defaultOptions, $options);

        $attr = '';

        if (true === array_key_exists('attr', $options)) {
            foreach ($options['attr'] as $key => $value) {
                if (true === is_array($value)) {
                    $value = array_pop($value);
                }
                $attr .= sprintf(' %s="%s"', $key, $value);
            }
        }

        $options['attr'] = $attr;

        $ignoreTags = ['head', 'link', 'a', 'script', 'style', 'code', 'pre', 'select', 'textarea', 'button'];

        $chunks = preg_split('/(<.+?>)/is', $text, 0, PREG_SPLIT_DELIM_CAPTURE);

        $openTag = null;

        for ($i = 0; $i < count($chunks); $i++) {
            if ($i % 2 === 0) { // even numbers are text
                // Only process this chunk if there are no unclosed $ignoreTags
                if (null === $openTag) {
                    if (true === $urls) {
                        $chunks[$i] = $this->linkifyUrls($chunks[$i], $options);
                    }
                    if (true === $emails) {
                        $chunks[$i] = $this->linkifyEmails($chunks[$i], $options);
                    }
                }
            } else { // odd numbers are tags
                // Only process this tag if there are no unclosed $ignoreTags
                if (null === $openTag) {
                    // Check whether this tag is contained in $ignoreTags and is not self-closing
                    if (preg_match("`<(" . implode('|', $ignoreTags) . ").*(?<!/)>$`is", $chunks[$i], $matches)) {
                        $openTag = $matches[1];
                    }
                } else {
                    // Otherwise, check whether this is the closing tag for $openTag.
                    if (preg_match('`</\s*' . $openTag . '>`i', $chunks[$i], $matches)) {
                        $openTag = null;
                    }
                }
            }
        }

        $text = implode($chunks);

        return $text;
    }

    /**
     * Add HTML links to URLs in plain text.
     *
     * @param string $text    Text to linkify.
     * @param array  $options Options, 'attr' key being the attributes to add to the links, with a preceding space.
     *
     * @return string Linkified text.
     */
    protected function linkifyUrls($text, $options = ['attr' => ''], $parseImages = false)
    {
        $pattern = '~(?xi)
              (?:
                ((ht|f)tps?://)                    # scheme://
                |                                  #   or
                www\d{0,3}\.                       # "www.", "www1.", "www2." ... "www999."
                |                                  #   or
                www\-                              # "www-"
                |                                  #   or
                [a-z0-9.\-]+\.[a-z]{2,4}(?=/)      # looks like domain name followed by a slash
              )
              (?:                                  # Zero or more:
                [^\s()<>]+                         # Run of non-space, non-()<>
                |                                  #   or
                \(([^\s()<>]+|(\([^\s()<>]+\)))*\) # balanced parens, up to 2 levels
              )*
              (?:                                  # End with:
                \(([^\s()<>]+|(\([^\s()<>]+\)))*\) # balanced parens, up to 2 levels
                |                                  #   or
                [^\s`!\-()\[\]{};:\'".,<>?«»“”‘’]  # not a space or one of these punct chars
              )
        ~';

        $callback = function ($match) use ($options, $parseImages) {
            $caption = $match[0];
            $pattern = "~^(ht|f)tps?://~";

            if (0 === preg_match($pattern, $match[0])) {
                $match[0] = 'http://' . $match[0];
            }

            if (isset($options['callback'])) {
                $cb = $options['callback']($match[0], $caption, false);
                if (!is_null($cb)) {
                    return $cb;
                }
            }

            if ($parseImages && $this->_isImage($match[0])) {
                return '<img style="max-width: 100%; max-height: 100%" src="' . $match[0] . '"' . $options['attr'] . '>';
            }
            return '<a rel="nofollow" target="_blank" href="' . $match[0] . '"' . $options['attr'] . '>' . $caption . '</a>';
        };

        return preg_replace_callback($pattern, $callback, $text);
    }

    /**
     * Add HTML links to email addresses in plain text.
     *
     * @param string $text    Text to linkify.
     * @param array  $options Options, 'attr' key being the attributes to add to the links, with a preceding space.
     *
     * @return string Linkified text.
     */
    protected function linkifyEmails($text, $options = ['attr' => ''])
    {
        $pattern = '~(?xi)
                \b
                (?<!=)           # Not part of a query string
                [A-Z0-9._\'%+-]+ # Username
                @                # At
                [A-Z0-9.-]+      # Domain
                \.               # Dot
                [A-Z]{2,4}       # Something
        ~';

        $callback = function ($match) use ($options) {
            if (isset($options['callback'])) {
                $cb = $options['callback']($match[0], $match[0], true);
                if (!is_null($cb)) {
                    return $cb;
                }
            }

            return '<a href="mailto:' . $match[0] . '"' . $options['attr'] . '>' . $match[0] . '</a>';
        };

        return preg_replace_callback($pattern, $callback, $text);
    }

    /**
     * @param $text
     *
     * @return bool
     */
    private function _isImage($text)
    {
        return preg_match('/(\.jpg|\.jpeg|\.png|\.bmp)$/', $text) ? true : false;
    }
}