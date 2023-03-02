<?php

namespace Mridhulka\LaravelOxfordDictionariesApi\Utilities;

use Mridhulka\LaravelOxfordDictionariesApi\Helper;
use Mridhulka\LaravelOxfordDictionariesApi\OxfordApiRequest;
use Mridhulka\LaravelOxfordDictionariesApi\Exceptions\MissingArgumentException;
use Mridhulka\LaravelOxfordDictionariesApi\Exceptions\UnwantedArgumentException;

class GrammaticalFeatures {
    use Helper;
    public string $sourceLang, $sourceLangGrammatical, $targetLangGrammatical;

    public function sourceLang(string $sourceLang)
    {
        $this->sourceLang = $sourceLang;

        return $this;
    }

    public function sourceLangGrammatical(string $sourceLangGrammatical)
    {
        $this->sourceLangGrammatical = $sourceLangGrammatical;

        return $this;
    }

    public function targetLangGrammatical(string $targetLangGrammatical)
    {
        $this->targetLangGrammatical = $targetLangGrammatical;

        return $this;
    }


    public function get(): array
    {
        $parameters = get_object_vars($this);

        $endpoint = $this->setEndpoint($parameters);

        return OxfordApiRequest::execute($endpoint); 
    }

    public function setEndpoint(array $parameters): string
    {
        if (!isset($parameters['sourceLang'])) {
            return match (true) {
                !isset($parameters['targetLangGrammatical']) => throw MissingArgumentException::create('targetLangGrammatical'),
                !isset($parameters['sourceLangDomains']) => throw MissingArgumentException::create('sourceLangDomains'),
                default => '/domains/' . $parameters['sourceLangGrammatical'] . '/' . $parameters['sourceLangGrammatical']
            };
        }

        return match (true) {
            isset($parameters['targetLangGrammatical']) => throw UnwantedArgumentException::create('targetLangGrammatical'),
            isset($parameters['sourceLangGrammatical']) => throw UnwantedArgumentException::create('sourceLangGrammatical'),
            default => '/domains/' . $parameters['sourceLang']
        };
        
        /* if (!isset($parameters['sourceLang'])) {
            throw MissingArgumentException::create('sourceLang');
        }

        if (!isset($parameters['targetLang'])) {
            return '/grammaticalFeatures/' . $parameters['sourceLang'];
        }

        return '/grammaticalFeatures/' . $parameters['sourceLang'] . '/' . $parameters['targetLang']; */
    }
}