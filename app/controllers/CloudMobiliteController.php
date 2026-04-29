<?php

declare(strict_types=1);

require_once __DIR__ . '/Controller.php';

final class CloudMobiliteController extends Controller
{
    public function index(): void
    {
        $this->render('cloud-mobilite.html');
    }
}
