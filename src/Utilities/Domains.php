<?php

namespace Mridhulka\LaravelOxfordDictionariesApi\Utilities;

use Mridhulka\LaravelOxfordDictionariesApi\Exceptions\MissingArgumentException;
use Mridhulka\LaravelOxfordDictionariesApi\Exceptions\UnwantedArgumentException;
use Mridhulka\LaravelOxfordDictionariesApi\Helper;
use Mridhulka\LaravelOxfordDictionariesApi\OxfordApiRequest;

class Domains
{
    use Helper;
    public string $sourceLang;
    public string $sourceLangDomains;
    public string $targetLangDomains;

    public function sourceLang(string $sourceLang)
    {
        $this->sourceLang = $sourceLang;

        return $this;
    }

    public function sourceLangDomains(string $sourceLangDomains)
    {
        $this->sourceLangDomains = $sourceLangDomains;

        return $this;
    }

    public function targetLangDomains(string $targetLangDomains)
    {
        $this->targetLangDomains = $targetLangDomains;

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
        if (! isset($parameters['sourceLang'])) {
            return match (true) {
                ! isset($parameters['targetLangDomains']) => throw MissingArgumentException::create('targetLangDomains'),
                ! isset($parameters['sourceLangDomains']) => throw MissingArgumentException::create('sourceLangDomains'),
                default => '/domains/' . $parameters['sourceLangDomains'] . '/' . $parameters['targetLangDomains']
            };
        }

        return match (true) {
            isset($parameters['targetLangDomains']) => throw UnwantedArgumentException::create('targetLangDomains'),
            isset($parameters['sourceLangDomains']) => throw UnwantedArgumentException::create('sourceLangDomains'),
            default => '/domains/' . $parameters['sourceLang']
        };
    }
}
