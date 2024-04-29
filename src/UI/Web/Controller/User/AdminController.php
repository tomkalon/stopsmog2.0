<?php

namespace App\UI\Web\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('Admin/User/Admin/index.html.twig', [

        ]);
    }
}
