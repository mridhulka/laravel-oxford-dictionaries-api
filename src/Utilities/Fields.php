<?php

namespace Mridhulka\LaravelOxfordDictionariesApi\Utilities;

use Mridhulka\LaravelOxfordDictionariesApi\OxfordApiRequest;

class Fields
{
    public string $endpoint;

    public function endpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;

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
        if (! isset($parameters['endpoint'])) {
            return '/fields';
        }

        return '/fields/' . $parameters['endpoint'];
    }
}
