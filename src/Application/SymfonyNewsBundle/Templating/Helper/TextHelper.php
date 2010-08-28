<?php

namespace Application\SymfonyNewsBundle\Templating\Helper;

use Symfony\Components\Templating\Helper\Helper;
use Symfony\Components\OutputEscaper\Escaper;

class TextHelper extends Helper {
    public function getName() {
        return 'text';
    }

    public function getTwitterUsername($author) {
        return substr((string) $author, 0, strpos($author, '@'));
    }

    /**
     * Truncate
     *
     * @param string $text
     * @param int $max
     * @return string
     */
    public function truncateText($text, $length = 150, $suffix = '...') {
        if ($text == '') {
            return '';
        }

        $text = strip_tags((string) $this->unescape($text));
        
        if (mb_strlen($text) > $length) {
            $truncatedText = mb_substr($text, 0, $length - mb_strlen($suffix));
            if ($tryTruncateText = preg_replace('/\s+([\w]+)?$/u', '', $truncatedText)) {
                // preg_replace does not seems to work with special characters sets like russian
                $truncatedText = $tryTruncateText;
            }

            $text = $truncatedText.$suffix;
        }

        return $text;
    }
    
    public function unescape($text) {
        if ($text instanceof Escaper) {
            $text = $text->getRawValue();
        }

        return $text;
    }
}
