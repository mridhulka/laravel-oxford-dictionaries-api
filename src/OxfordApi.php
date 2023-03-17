<?php

namespace Mridhulka\LaravelOxfordDictionariesApi;

use Mridhulka\LaravelOxfordDictionariesApi\Utilities\Domains;
use Mridhulka\LaravelOxfordDictionariesApi\Utilities\Fields;
use Mridhulka\LaravelOxfordDictionariesApi\Utilities\Filters;
use Mridhulka\LaravelOxfordDictionariesApi\Utilities\GrammaticalFeatures;
use Mridhulka\LaravelOxfordDictionariesApi\Utilities\Languages;

class OxfordApi
{
    public static function entries()
    {
        return new Entries();
    }

    public static function searchTranslations()
    {
        return new SearchTranslations();
    }

    public static function search()
    {
        return new Search();
    }

    public static function searchThesaurus()
    {
        return new SearchThesaurus();
    }

    public static function translations()
    {
        return new Translations();
    }

    public static function thesaurus()
    {
        return new Thesaurus();
    }

    public static function sentences()
    {
        return new Sentences();
    }

    public static function domains()
    {
        return new Domains();
    }

    public static function fields()
    {
        return new Fields();
    }

    public static function filters()
    {
        return new Filters();
    }

    public static function grammaticalFeatures()
    {
        return new GrammaticalFeatures();
    }

    public static function languages()
    {
        return new Languages();
    }
}
