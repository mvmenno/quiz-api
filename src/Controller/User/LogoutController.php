<?php

namespace App\Controller\User;

use App\Controller\UserController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LogoutController
 *
 * @author menno
 */
class LogoutController extends UserController{
    //put your code here
    
    /**
     * @Route("/user/logout", name="user_logout")
     */
    public function logout(){
        return $this->json([
            'message' => 'Welcome to your new logout controller!',
            'path' => 'src/Controller/User/LoginController.php',
        ]);
    }
    
}
