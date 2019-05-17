<?php
namespace BpmRestfull\Request;

class CaseDeleteRequest extends \GuzzleHttp\Psr7\Request implements Requestable
{
    
    private $id;
    
    public function __construct(string $uri, $id)
    {
        $this->id = $id;
        
        parent::__construct('DELETE', $this->uri($uri), $this->headers(), $this->body());
    }
    
    public function uri(string $uri): string
    {
        return sprintf('%s/%s', $uri, $this->id);
    }
    
    public function headers(): array
    {
        return [];
    }
    
    public function body(): string
    {
        return '';
    }
}