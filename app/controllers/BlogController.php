<?php

declare(strict_types=1);

require_once __DIR__ . '/Controller.php';

final class BlogController extends Controller
{
    /**
     * @var array<string, string>
     */
    private const SLUG_TO_VIEW = [
        'pourquoi-infogerance-essentielle-cabinet-comptable' => 'blog/pourquoi-infogerance-essentielle-cabinet-comptable.html',
        'infogerance-cabinet-comptable-securiser-donnees-clients' => 'blog/infogerance-cabinet-comptable-securiser-donnees-clients.html',
        'pourquoi-cabinets-comptables-externalisent-informatique' => 'blog/pourquoi-cabinets-comptables-externalisent-informatique.html',
        'infogerance-informatique-ile-de-france-experts-comptables' => 'blog/infogerance-informatique-ile-de-france-experts-comptables.html',
        'eviter-interruptions-informatiques-cabinet-comptable' => 'blog/eviter-interruptions-informatiques-cabinet-comptable.html',
    ];

    public function index(): void
    {
        $this->render('blog/index.html');
    }

    public function show(string $slug): void
    {
        if (!isset(self::SLUG_TO_VIEW[$slug])) {
            http_response_code(404);
            $this->render('404.html');
            return;
        }

        $this->render(self::SLUG_TO_VIEW[$slug]);
    }

    /**
     * @return list<string>
     */
    public static function slugs(): array
    {
        return array_keys(self::SLUG_TO_VIEW);
    }
}
