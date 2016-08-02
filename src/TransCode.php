<?php

namespace JLaso\HideMessage;

class TransCode extends AbstractCode
{
    public function encode($text)
    {
        $result = '';
        $text = trim(strtolower(str_replace(array_keys($this->transliterationTable), array_values($this->transliterationTable), $text)));
        //$text = str_replace($this->nullChars, '', $text);
        $text = str_replace(
            array('.','/','-',':'),
            array('punto','barra' ,'guion','dospuntos'),
            $text
        );

        for($i=0; $i<strlen($text); $i++){
            $char = $text[$i];
            if(is_numeric($char)) {
                $char = 9 - intval($char);
            }else if($char >= 'a' && $char <= 'z'){
                $char = chr(ord('A') + (ord('z') - ord($char)));
            }else{
                //$char = '';
            }
            
            $result = $char . $result;
        }
        
        return $result;
    }  
    
}