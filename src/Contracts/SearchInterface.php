<?php

namespace Mridhulka\LaravelOxfordDictionariesApi\Contracts;

interface SearchInterface{
    public function offset(int $offset): self;
    public function prefix(string $prefix): self;
    public function limit(int $limit): self;
    public function get(): array;
    public function setEndpoint(array $parameters): string;
    public function extractParameters(array $parameters): array;
}