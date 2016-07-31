<?php

namespace JLaso\HideMessage;

class BaseCode extends AbstractCode
{
    const POSITIVE_DIRECTION = +1;
    const NEGATIVE_DIRECTION = -1;

    protected $blocks = [1 => 'a', 2 => 'A', -1 => '', -2 => '?'];
    protected $dictionary = 'bcdefghijklmnopqrstuvwxyzBCDEFGHIJKLMNOPQRSTUVWXYZ';
    
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
        //$i = $start = self::POSITIVE_DIRECTION == $direction ? 0 : strlen($rawTextBlock) - 1;
        //$stop = $start ? -1 : strlen($rawTextBlock) - 1;
        $blocks = $this->rawTextToBlock($rawTextBlock, $direction);

        foreach ($blocks as $block => $data) {
            $blockLen = strlen($data);
            $i = $start = self::POSITIVE_DIRECTION == $direction ? 0 : $blockLen - 1;
            $stop = $start ? -1 : $blockLen - 1;

            do {
                $char = $data[$i];
                $result[$char][] = $this->encodeBlockAndPos(
                    $block,
                    self::POSITIVE_DIRECTION == $direction ? $i : ($i % $this->baseCode)
                );
                $i = $i + $direction;
            } while ($i != $stop);
        }

        /*do {
            $char = $rawTextBlock[$i];
            $block = $direction * (1 + intval($i / $this->baseCode));
            $result[$char][] = $this->encodeBlockAndPos(
                $block,
                self::POSITIVE_DIRECTION == $direction ? $i : $this->baseCode - ($i % $this->baseCode) - 1
            );
            $i = $i + $direction;
        } while ($i != $stop);
*/
        return $result;
    }

    public function rawTextToBlock($rawTextBlock, $direction, $result = [])
    {
        $rawTextBlock = $this->getTextBlock($rawTextBlock, $direction);
        $i = $start = self::POSITIVE_DIRECTION == $direction ? 0 : strlen($rawTextBlock) - 1;
        $stop = $start ? -1 : strlen($rawTextBlock) - 1;

        do {
            $block = $direction * (1 + intval($i / $this->baseCode));
            if (!isset($result[$block])) {
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
                if ('0' == $char) {
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