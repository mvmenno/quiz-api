<?php

namespace App\Controller\User;

use App\Controller\UserController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Annotation\Method;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegisterController
 *
 * @author menno
 */
class RegisterController extends UserController{
    
    private $passwordEncoder;
    private $userRepository;
    private $em;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder,UserRepository $userRepository,EntityManagerInterface $entityManagerInterface) {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->em = $entityManagerInterface;
    }
    /**
     * @Route("/user/register", name="user_register", methods={"POST"})
     */
    public function register(Request $request){
      
        
        $data = json_decode($request->getContent());
        
        $username   = $data->username;
        $email      = $data->email;
        $password   = $data->password;
        
        
        if(!$password || !$this->checkPassword($password)){
            return $this->json([
                'message' => 'Please specify a password with at least: 6 characters',
                'path' => 'src/Controller/User/LoginController.php',
            ]);
        }
        if(!$this->checkEmail($email)){
            return $this->json([
                'message' => 'Invalid email!',
                'path' => 'src/Controller/User/LoginController.php',
            ]);
        }
        if(!$email || $this->userRepository->findOneBy(['email'=>$email])){
            return $this->json([
                'message' => 'There is already a user registered with this email address',
                'path' => 'src/Controller/User/LoginController.php',
            ]);
        }
            
        $roles = ['ROLE_USER'];
        
        
        
        $user = new User();
        $user->setEmail($email);
        $user->setUsername($username);
        $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $password
            )
        );
        $user->setRoles($roles);
        
        $this->em->persist($user);
        
        $this->em->flush();
        
        return $this->json([
            'message' => 'User created. Please login!',
            'path' => 'src/Controller/User/LoginController.php',
        ]);
    } 
    
    /**
     * 
     * @param string $password
     */
    protected function checkPassword(string $password){
        if(strlen($password) < 7){
            return false;
        }else{
            return true;
        }
    }
    
    /**
     * 
     * @param string $email
     */
    protected function checkEmail(string $email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }else{
            return true;
        }
    }
}
