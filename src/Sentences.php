<?php

namespace Mridhulka\LaravelOxfordDictionariesApi;

use Mridhulka\LaravelOxfordDictionariesApi\Exceptions\MissingArgumentException;
use Mridhulka\LaravelOxfordDictionariesApi\Helper;

class Sentences{
    use Helper;
    public string $wordId, $sourceLang, $strictMatch;

    public function sourceLang(string $sourceLang)
    {
        $this->sourceLang = $sourceLang;

        return $this;
    }


    public function wordId(string $wordId)
    {
        $this->wordId = $wordId;

        return $this;
    }


    public function strictMatch(string $strictMatch)
    {
        $this->strictMatch = filter_var($strictMatch, FILTER_VALIDATE_BOOLEAN);

        return $this;
    }

    public function get(): array
    {
        $parameters = get_object_vars($this);

        $endpoint = $this->setEndpoint($parameters);
        $parameters = $this->extractParameters($parameters);

        return OxfordApiRequest::execute($endpoint, $parameters); 
    }

    public function setEndpoint(array $parameters): string
    {
        return '/sentences/' . $parameters['sourceLang'] . '/'  . $parameters['wordId'];
    }

    public function extractParameters(array $parameters): array
    {
        if (!isset($parameters['sourceLang'])) {
            throw MissingArgumentException::create('sourceLang');
        }

        if (!isset($parameters['wordId'])) {
            throw MissingArgumentException::create('wordId');
        }

     
        unset($parameters['sourceLang'], $parameters['wordId']);

        return $parameters;
    }
}