<?php

declare(strict_types=1);

final class Router
{
    /**
     * @var array<string, array<string, callable>>
     */
    private array $routes = [];

    public function get(string $path, callable $handler): void
    {
        $this->add('GET', $path, $handler);
    }

    public function add(string $method, string $path, callable $handler): void
    {
        $method = strtoupper($method);
        $this->routes[$method][$this->normalizePath($path)] = $handler;
    }

    public function dispatch(string $method, string $uri): bool
    {
        $method = strtoupper($method);
        $path = $this->normalizePath($uri);

        if (!isset($this->routes[$method][$path])) {
            return false;
        }

        ($this->routes[$method][$path])();

        return true;
    }

    private function normalizePath(string $path): string
    {
        $normalized = parse_url($path, PHP_URL_PATH) ?: '/';

        if ($normalized !== '/') {
            $normalized = '/' . trim($normalized, '/');
        }

        return $normalized;
    }
}
