<?php

declare(strict_types=1);

require_once __DIR__ . '/Controller.php';

final class LegalController extends Controller
{
    public function mentions(): void
    {
        $this->render('mentions-legales.html');
    }

    public function privacy(): void
    {
        $this->render('politique-confidentialite.html');
    }
}
