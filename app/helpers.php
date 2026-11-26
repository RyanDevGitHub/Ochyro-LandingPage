<?php

declare(strict_types=1);

/** Échappe une valeur pour l'affichage HTML. */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Lit une valeur de config.php. */
function site(string $key): string
{
    static $config = null;
    $config ??= require __DIR__ . '/config.php';

    return (string) ($config[$key] ?? '');
}

/** Icône Iconify (jeu Solar, déjà utilisé sur le site). */
function icon(string $name, int $size = 22, string $class = ''): string
{
    return sprintf(
        '<iconify-icon icon="solar:%s" width="%d" height="%d" class="%s" aria-hidden="true"></iconify-icon>',
        e($name),
        $size,
        $size,
        e($class)
    );
}
