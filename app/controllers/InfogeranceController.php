<?php

declare(strict_types=1);

require_once __DIR__ . '/Controller.php';

final class InfogeranceController extends Controller
{
    public function index(): void
    {
        $this->render('infogerance.html');
    }
}
