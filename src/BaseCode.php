<?php

namespace JLaso\HideMessage;

class BaseCode
{
    const POSITIVE_DIRECTION = +1;
    const NEGATIVE_DIRECTION = -1;

    //protected $blocks = [1 => '%', 2 => '$', 3 => '/', -1 => '', -2 => '@', -3 => '*'];
    //protected $blocks = [1 => '%', 2 => '$', -1 => '', -2 => '@'];
    protected $blocks = [1 => 'a', 2 => 'A', -1 => '', -2 => '?'];
    protected $dictionary = 'bcdefghijklmnopqrstuvwxyzBCDEFGHIJKLMNOPQRSTUVWXYZ';
    protected $transliterationTable = ['á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja'];
    protected $nullChars = [' ', ',', ';',/*':',*/
        '>', '<', '(', ')', '.', '"', "'", '?', '¿', '!', '¡', 'º', 'ª'];

    protected $baseCode;

    /**
     * BaseCode constructor.
     */
    public function __construct()
    {
        $this->baseCode = strlen($this->dictionary);
    }

    public function getPlainChar($char)
    {
        $cleanChar = trim(strtolower($char));

        return isset($this->transliterationTable[$cleanChar]) ? $this->transliterationTable[$cleanChar] : $cleanChar;
    }

    public function getPlainTextBlock($rawTextBlock, $direction)
    {
        $result = [];
        $i = $start = self::POSITIVE_DIRECTION == $direction ? 0 : strlen($rawTextBlock) - 1;
        $stop = $start ? -1 : strlen($rawTextBlock) - 1;

        do {
            $char = $rawTextBlock[$i];
            $block = $direction * (1 + intval($i / $this->baseCode));
            $result[$char][] = $this->encodeBlockAndPos(
                $block,
                self::POSITIVE_DIRECTION == $direction ? $i : $this->baseCode - ($i % $this->baseCode) - 1
            );
            $i = $i + $direction;
        } while ($i != $stop);

        return $result;
    }

    public function rawTextToBlock($rawTextBlock, $direction, $result = [])
    {
        $rawTextBlock = $this->getTextBlock($rawTextBlock, $direction);
        $i = $start = self::POSITIVE_DIRECTION == $direction ? 0 : strlen($rawTextBlock) - 1;
        $stop = $start ? -1 : strlen($rawTextBlock) - 1;

        do {
            $block = $direction * (1 + intval($i / $this->baseCode));
            if(!isset($result[$block])){
                $result[$block] = '';
            }
            $result[$block] .= $rawTextBlock[$i];
            $i = $i + $direction;
        } while ($i != $stop);

        return $result;
    }

    protected function getTextBlock($rawTextBlock, $direction)
    {
        $withoutTildes = str_replace(array_keys($this->transliterationTable), array_values($this->transliterationTable), $rawTextBlock);
        $cleaned = str_replace($this->nullChars, '', $withoutTildes);

        if (self::POSITIVE_DIRECTION == $direction) {

            return substr($cleaned, 0, count($this->blocks) * $this->baseCode / 2);
        }
        if (self::NEGATIVE_DIRECTION == $direction) {
            return substr($cleaned, -1 * count($this->blocks) * $this->baseCode / 2);
        }
        throw new \Exception("Unknown {$direction} direction");
    }

    protected function encodeBlockAndPos($block, $pos)
    {
        if (!isset($this->blocks[$block])) {
            throw new \Exception('Wrong block ' . $block);
        }

        return $this->blocks[$block] . $this->dictionary[$pos % $this->baseCode];
    }

    public function encode($sourceToEncode, $textBefore, $textAfter)
    {
        // cut the part we need
        $textAfter = $this->getTextBlock($textAfter, self::POSITIVE_DIRECTION);
        $textBefore = $this->getTextBlock($textBefore, self::NEGATIVE_DIRECTION);

        // obtain the map
        $map = array_merge_recursive(
            $this->getPlainTextBlock($textBefore, self::NEGATIVE_DIRECTION),
            $this->getPlainTextBlock($textAfter, self::POSITIVE_DIRECTION)
        );

        $result = '';
        for ($i = 0; $i < strlen($sourceToEncode); $i++) {
            $char = $sourceToEncode[$i];
            if (isset($map[$char])) {
                $alts = $map[$char];
                $result .= $alts[rand(0, count($alts) - 1)];
            } else {
                $result .= (is_numeric(substr($result, -1)) ? '0' : '') . (ord($char) - 32);
            }
        }

        return $result;
    }

    public function decode($code, $textBefore, $textAfter)
    {
        $blocks = $this->rawTextToBlock($textAfter, self::POSITIVE_DIRECTION);
        $blocks = $this->rawTextToBlock($textBefore, self::NEGATIVE_DIRECTION, $blocks);
        var_dump($blocks);

        $result = '';
        $number = '';
        $block = -1;
        for ($i = 0; $i < strlen($code); $i++) {
            $char = $code[$i];
            if (is_numeric($char) && intval($char)) {
                $number .= $char;
            } else {
                if ($number) {
                    $result .= chr(32 + intval($number));
                    $number = '';
                }
                if('0' == $char){
                    continue;
                }
                if (in_array($char, $this->blocks)) {
                    $block = intval(array_search($char, $this->blocks));
                } else {
                    $pos = strpos($this->dictionary, $char);
                    print("{$pos}:");
                    if ($pos === false) {
                        throw new \Exception("Something wrong happened decoding {$char}");
                    }
                    $result .= $blocks[$block][$pos];
                    $block = -1;
                }

            }
        }

        return $result;
    }
}