<?php

namespace Mridhulka\LaravelOxfordDictionariesApi;

use Mridhulka\LaravelOxfordDictionariesApi\Exceptions\MissingArgumentException;
use Mridhulka\LaravelOxfordDictionariesApi\Helper;

class Lemmas {
    use Helper;
    public string $wordId, $sourceLang, $lexicalCategory, $grammaticalFeatures;

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


    public function grammaticalFeatures(string $grammaticalFeatures)
    {
        $this->grammaticalFeatures = $this->removeWhitespace($grammaticalFeatures);
        return $this;
    }

    

    public function get(): array
    {
        $query = get_object_vars($this);

        if (!isset($query['sourceLang'])) {
            throw MissingArgumentException::create('sourceLang');
        }

        if (!isset($query['wordId'])) {
            throw MissingArgumentException::create('sourceLang');
        }

      
        $sourceLang = $query['sourceLang'];
        $wordId = $query['wordId'];

        unset($query['sourceLang'], $query['wordId']);

        
        $endpoint = '/entries/' . $sourceLang . '/' . $wordId;

        return OxfordApiRequest::execute($endpoint, $query); 
    }
}