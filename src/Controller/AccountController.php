<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountController
 *
 * @author menno
 */
class AccountController extends AbstractController{
    
    private $passwordEncoder;
    private $userRepository;
    private $em;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder,UserRepository $userRepository,EntityManagerInterface $entityManagerInterface){
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->em = $entityManagerInterface;
    }
    
    /**
     * @Route("/account", name="account",methods={"GET"})
     */
    public function index(Request $request){
        return $this->json([
            'message'=>'My Account Controller'
        ]);
    }
}
