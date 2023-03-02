<?php

namespace Mridhulka\LaravelOxfordDictionariesApi\Utilities;

use Mridhulka\LaravelOxfordDictionariesApi\OxfordApiRequest;

class Languages{
    public string $sourceLanguage, $targetLanguage;

    public function sourceLanguage(string $sourceLanguage)
    {
        $this->sourceLanguage = $sourceLanguage	;

        return $this;
    }

    public function targetLanguage(string $targetLanguage)
    {
        $this->targetLanguage = $targetLanguage;

        return $this;
    }


    public function get(): array
    {
        $parameters = get_object_vars($this);

        $endpoint = $this->setEndpoint();

        return OxfordApiRequest::execute($endpoint, $parameters); 
    }

    public function setEndpoint(): string
    {
        return '/languages';
    }

}