<?php

namespace src\router;

use Closure;
use Exception;
use ReflectionClass;

class Router
{

    private array $uri;
    private string $baseUri = '';

    public function __construct(string $baseUri = '')
    {
        $this->baseUri = $baseUri;
    }

    public function baseUri(string $baseUri): void
    {
        $this->baseUri = $baseUri;
    }

    public function get(string $uri, string $class, string $method): void
    {
        $this->uri('GET', $uri, $class, $method);
    }

    public function post(string $uri, string $class, string $method): void
    {
        $this->uri('POST', $uri, $class, $method);
    }

    public function put(string $uri, string $class, string $method): void
    {
        $this->uri('PUT', $uri, $class, $method);
    }

    public function delete(string $uri, string $class, string $method): void
    {
        $this->uri('DELETE', $uri, $class, $method);
    }

    public function start()
    {
        $found = $this->match();
        if (!$found) {
            throw new Exception("Not Found", 404);
        }
        $this->execute($found);
    }

    private function match(): ?array
    {
        $uri = $this->getUriToFind();
        if (isset($this->uri[$_SERVER['REQUEST_METHOD']][$uri])) {
            return $this->uri[$_SERVER['REQUEST_METHOD']][$uri];
        }
        return null;
    }

    private function execute(array $info)
    {
        list($class, $method) = $info;
        $reflection = new ReflectionClass($class);
        $object = $reflection->newInstance();
        $object->$method();
    }

    private function uri(string $httpVerb, string $uri, string $class, string $method): void
    {
        $this->uri[$httpVerb][$this->baseUri . $uri] = [$class, $method];
    }

    private function getUriToFind()
    {
        if ($posicaoQueryString = strpos($_SERVER['REQUEST_URI'], '?')) {
            return substr($_SERVER['REQUEST_URI'], 0, $posicaoQueryString);
        }
        return $_SERVER['REQUEST_URI'];
    }
}
