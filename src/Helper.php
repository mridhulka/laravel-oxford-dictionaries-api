<?php

namespace Mridhulka\LaravelOxfordDictionariesApi; 

trait Helper{
    public function removeWhitespace(string $string)
    {
        return str_replace(' ','', $string);
    } 

}