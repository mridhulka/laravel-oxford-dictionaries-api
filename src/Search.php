<?php

namespace Mridhulka\LaravelOxfordDictionariesApi;

use Mridhulka\LaravelOxfordDictionariesApi\Contracts\SearchInterface;
use Mridhulka\LaravelOxfordDictionariesApi\Exceptions\MissingArgumentException;

class Search implements SearchInterface{
    public string $sourceLang, $q, $prefix;
    public int $offset, $limit;

    public function sourceLang(string $sourceLang)
    {
        $this->sourceLang = $sourceLang;

        return $this;
    }


    public function q(string $q)
    {
        $this->q = $q;

        return $this;
    }

    public function prefix(string $prefix): self
    {
        $this->prefix = filter_var($prefix, FILTER_VALIDATE_BOOLEAN);

        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;

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
        return '/search/' . $parameters['sourceLang'];
    }

    public function extractParameters(array $parameters): array
    {
        if (!isset($parameters['sourceLang'])) {
            throw MissingArgumentException::create('sourceLang');
        }

        unset($parameters['sourceLang']);
        return $parameters;
    }
}