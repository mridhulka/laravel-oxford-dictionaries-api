<?php

namespace Mridhulka\LaravelOxfordDictionariesApi;

use League\CommonMark\Parser\Block\BlockContinue;
use Mridhulka\LaravelOxfordDictionariesApi\Exceptions\MissingArgumentException;
use Mridhulka\LaravelOxfordDictionariesApi\Helper;

class Translations{
    use Helper;
    public string $wordId, $sourceLangTranslate, $targetLangTranslate, $fields, $domains, $registers, $strictMatch, $lexicalCategory, $grammaticalFeatures;
    public function sourceLangTranslate(string $sourceLangTranslate)
    {
        $this->sourceLangTranslate = $sourceLangTranslate;

        return $this;
    }

    public function targetLangTranslate(string $targetLangTranslate)
    {
        $this->targetLangTranslate = $targetLangTranslate;

        return $this;
    }

    public function wordId(string $wordId)
    {
        $this->wordId = $wordId;

        return $this;
    }

    public function lexicalCategory(string $fields)
    {
        $this->lexicalCategory = $this->removeWhitespace($fields);

        return $this;
    }

    public function fields(array $fields)
    {
        $this->fields = $this->arrayImplode($fields);

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
        $endpoint = $this->setEndpoint($parameters);

        $parameters = $this->extractParameters($parameters);


        

        return OxfordApiRequest::execute($endpoint, $parameters); 
    }

    public function setEndpoint(array $parameters): string
    {
        return '/translations/' . $parameters['sourceLangTranslate'] . '/' . $parameters['targetLangTranslate'] . '/' . $parameters['wordId'];
    }

    public function extractParameters(array $parameters): array
    {

        match (true) {
            !isset($parameters['targetLangTranslate']) => throw MissingArgumentException::create('targetLangTranslate'),
            !isset($parameters['sourceLangTranslate']) => throw MissingArgumentException::create('sourceLangTranslate'),
            !isset($parameters['wordId']) => throw MissingArgumentException::create('wordId'),
            default => null
        };

        unset($parameters['sourceLangTranslate'], $parameters['targetLangTranslate'], $parameters['wordId']);

        return $parameters;
    }
}