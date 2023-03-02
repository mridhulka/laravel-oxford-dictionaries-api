<?php

namespace Mridhulka\LaravelOxfordDictionariesApi;

use Mridhulka\LaravelOxfordDictionariesApi\Exceptions\MissingArgumentException;
use Mridhulka\LaravelOxfordDictionariesApi\Helper;

class Translations{
    use Helper;
    public string $wordId, $sourceLang, $targetLang, $fields, $domains, $registers, $strictMatch, $lexicalCategory, $grammaticalFeatures;
    public function sourceLang(string $sourceLang)
    {
        $this->sourceLang = $sourceLang;

        return $this;
    }

    public function targetLang(string $targetLang)
    {
        $this->targetLang = $targetLang;

        return $this;
    }

    public function wordId(string $wordId)
    {
        $this->wordId = $wordId;

        return $this;
    }

    public function lexicalCategory(string $fields)
    {
        $this->lexicalCategory = $this->lexicalCategory($fields);

        return $this;
    }

    public function fields(string $fields)
    {
        $this->fields = $this->removeWhitespace($fields);

        return $this;
    }

    public function domains(string $domains)
    {
        $this->domains = $this->removeWhitespace($domains);

        return $this;
    }

    public function registers(string $registers)
    {
        $this->registers = $this->removeWhitespace($registers);

        return $this;
    }

    public function strictMatch(string $strictMatch)
    {
        $this->strictMatch = filter_var($strictMatch, FILTER_VALIDATE_BOOLEAN);

        return $this;
    }

    public function grammaticalFeatures(string $grammaticalFeatures)
    {
        $this->grammaticalFeatures = $this->removeWhitespace($grammaticalFeatures);
        return $this;
    }

    

    public function get(): array
    {
        $parameters = get_object_vars($this);
        $parameters = $this->extractParameters($parameters);

        $endpoint = $this->setEndpoint($parameters);

        

        return OxfordApiRequest::execute($endpoint, $parameters); 
    }

    public function setEndpoint(array $parameters): string
    {
        return '/translations/' . $parameters['sourceLang'] . '/' . $parameters['targetLang'] . '/' . $parameters['wordId'];
    }

    public function extractParameters(array $parameters): array
    {

        match (true) {
            !isset($parameters['targetLang']) => throw MissingArgumentException::create('targetLang'),
            !isset($parameters['sourceLang']) => throw MissingArgumentException::create('sourceLang'),
            !isset($parameters['wordId']) => throw MissingArgumentException::create('wordId')
        };

        unset($parameters['sourceLang'], $parameters['targetLang'], $parameters['wordId']);

        return $parameters;
    }
}