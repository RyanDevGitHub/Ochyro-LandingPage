<?php

declare(strict_types=1);

abstract class Controller
{
    /**
     * Rend une vue. Les vues .php sont exécutées (partials, helpers),
     * les vues .html sont servies telles quelles.
     */
    protected function render(string $view): void
    {
        $viewPath = __DIR__ . '/../views/' . $view;

        if (!is_file($viewPath)) {
            throw new RuntimeException(sprintf('View not found: %s', $view));
        }

        header('Content-Type: text/html; charset=UTF-8');

        if (str_ends_with($view, '.php')) {
            require $viewPath;
            return;
        }

        readfile($viewPath);
    }
}
