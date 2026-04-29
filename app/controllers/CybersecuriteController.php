<?php

declare(strict_types=1);

require_once __DIR__ . '/Controller.php';

final class CybersecuriteController extends Controller
{
    public function index(): void
    {
        $this->render('cybersecurite.html');
    }
}
