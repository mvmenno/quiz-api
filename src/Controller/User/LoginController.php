<?php

namespace App\Controller\User;

use App\Controller\UserController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Repository\UserRepository;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\EntityManagerInterface;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 *
 * @author menno
 */
class LoginController extends UserController{
    
    private $passwordEncoder;
    private $userRepository;
    private $em;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder,UserRepository $userRepository,EntityManagerInterface $entityManagerInterface){
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->em = $entityManagerInterface;
    }
    
    /**
     * @Route("/user/login", name="user_login")
     */
    public function login(Request $request){
        $data = json_decode($request->getContent());
        $email      = $data->email;
        $password   = $data->password;
        
        $user = $this->userRepository->findOneBy(['email'=>$email]);
        
        if($user){
            $match = $this->passwordEncoder->isPasswordValid($user,$password);
            
            if($match === true){
                $rand = (string) random_bytes(10);
                $uuid = Uuid::uuid5(Uuid::NAMESPACE_DNS,$user->getEmail().$rand);
                
                $user->setApiToken($uuid);
                
                $this->em->persist($user);
                $this->em->flush();
                
                return $this->json([
                    'message' => 'Logged In!',
                    'token' => $uuid
                ]);
            }else{
                return $this->json([
                    'message' => 'Invalid password!'
                ]);
            }
            
        }
        
        return $this->json([
            'message' => 'Welcome to your new login controller!'
        ]);
    }
}
