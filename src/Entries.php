<?php

namespace Mridhulka\LaravelOxfordDictionariesApi;

use Mridhulka\LaravelOxfordDictionariesApi\Exceptions\MissingArgumentException;

class Entries
{
    use Helper;
    public string $wordId;
    public string $sourceLang;
    public string $fields;
    public string $domains;
    public string $registers;
    public string $strictMatch;
    public string $lexicalCategory;
    public string $grammaticalFeatures;

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

    public function lexicalCategory(string $fields)
    {
        $this->lexicalCategory = $this->lexicalCategory($fields);

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
        return '/entries/' . $parameters['sourceLang'] . '/' . $parameters['wordId'];
    }

    public function extractParameters(array $parameters): array
    {
        if (! isset($parameters['sourceLang'])) {
            throw MissingArgumentException::create('sourceLang');
        }

        if (! isset($parameters['wordId'])) {
            throw MissingArgumentException::create('wordId');
        }

        unset($parameters['sourceLang'], $parameters['wordId']);

        return $parameters;
    }
}
