<?php

namespace BpmRestfull\Request;

interface Requestable
{
    public function uri(string $uri): string;
    
    public function headers(): array;
    
    public function body(): string;
}