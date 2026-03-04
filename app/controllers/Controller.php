<?php

declare(strict_types=1);

abstract class Controller
{
    protected function render(string $view): void
    {
        $viewPath = __DIR__ . '/../views/' . $view;

        if (!is_file($viewPath)) {
            throw new RuntimeException(sprintf('View not found: %s', $view));
        }

        header('Content-Type: text/html; charset=UTF-8');
        readfile($viewPath);
    }
}
