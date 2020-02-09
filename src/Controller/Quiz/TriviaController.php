<?php

namespace App\Controller\Quiz;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Quiz;
use App\Entity\User;
use App\Repository\QuizRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;


class TriviaController extends \App\Controller\QuizController {
    //put your code here
    
    /**
     * @Route("/quiz/{id}/trivia/create", name="create_quiz_trivia",methods="POST")
     */
    public function createQuizTrivia(Request $request,$id)
    {
        return $this->json([
                'message' => 'Create Trivia Controller',
        ]);
    }
    /**
     * @Route("/quiz/{id}/trivia/update/{triviaId}", name="update_quiz_trivia",methods="POST")
     */
    public function updateQuizTrivia(Request $request,$id)
    {
        return $this->json([
                'message' => 'Update Trivia Controller',
        ]);
    }
    /**
     * @Route("/quiz/{id}/trivia/delete/{triviaId}", name="delete_quiz_trivia",methods="GET")
     */
    public function deleteQuizTrivia(Request $request,$id,$triviaId)
    {
        return $this->json([
                'message' => 'Delete Trivia Controller',
        ]);
    }
}
