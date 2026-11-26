<?php

declare(strict_types=1);

require_once __DIR__ . '/Controller.php';

/**
 * Pages statiques du site (accueil, services, cas d'usage, légal…).
 */
final class PageController extends Controller
{
    public function home(): void
    {
        $this->render('home.php');
    }

    public function services(): void
    {
        $this->render('services.php');
    }

    public function useCases(): void
    {
        $this->render('cas-usage.php');
    }

    public function appointmentConfirmed(): void
    {
        $this->render('rendez-vous-confirme.php');
    }

    public function legalNotice(): void
    {
        $this->render('mentions-legales.php');
    }

    public function privacy(): void
    {
        $this->render('politique-confidentialite.php');
    }
}
