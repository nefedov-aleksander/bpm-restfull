<?php
namespace BpmRestfull\Formater;

interface Formatable
{

    public function format(\BpmRestfull\Definition\Arrayable $data): string;

    public function httpHeaders(): array;
}