<?php
namespace BpmRestfull\Formater;

class Json implements Formatable
{

    public function format(\BpmRestfull\Definition\Arrayable $data): string
    {
        return json_encode($data->toArray());
    }

    public function httpHeaders(): array
    {
        return [
            'Content-Type' => 'application/json'
        ];
    }
}