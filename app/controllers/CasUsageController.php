<?php

declare(strict_types=1);

require_once __DIR__ . '/Controller.php';

final class CasUsageController extends Controller
{
    public function index(): void
    {
        $this->render('cas-usage.html');
    }
}
