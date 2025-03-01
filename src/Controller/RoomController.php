<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    /**
     * @Route("/room", name="room")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new room controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }
}
