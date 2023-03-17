<?php

namespace Mridhulka\LaravelOxfordDictionariesApi; 

trait Helper{
    public function removeWhitespace(string $string)
    {
        return str_replace(' ','', $string);
    } 

    public function arrayImplode(array $array)
    {
        return implode(',', $array);
    } 

}