<?php
namespace BpmRestfull\Request;

class CaseUpdateRequest extends \GuzzleHttp\Psr7\Request implements Requestable
{

    private $definition;

    private $formater;

    public function __construct(string $uri, \BpmRestfull\Definition\CaseDefinition $definition, \BpmRestfull\Formater\Formatable $formater)
    {
        $this->definition = $definition;
        $this->formater = $formater;
        
        parent::__construct('PUT', $this->uri($uri), $this->headers(), $this->body());
    }

    public function uri(string $uri): string
    {
        return $uri;
    }

    public function headers(): array
    {
        return $this->formater->httpHeaders();
    }

    public function body(): string
    {
        return $this->formater->format($this->definition);
    }
}