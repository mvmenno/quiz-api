<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Quiz;
use App\Repository\QuizRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class QuizController extends AbstractController{
    
    protected $userRepository;
    protected $quizRepository;
    protected $em;
    
    public function __construct(UserRepository $userRepository,QuizRepository $quizRepository,EntityManagerInterface $entityManagerInterface){
        $this->userRepository = $userRepository;
        $this->quizRepository =$quizRepository;
        $this->em = $entityManagerInterface;
    }
    
    /**
     * @Route("/quiz/create", name="create_quiz",methods="POST")
     */
    public function create(Request $request)
    {
        
        $data = json_decode($request->getContent());
        
        $quiz = new Quiz();
        
        $puser =  $this->userRepository->findOneBy(['apiToken'=>$request->headers->get('X-AUTH-TOKEN')]);
        
        
        if($puser){            
            
            $quiz->setName($data->name);
            $quiz->setCreatedAt(new \DateTime());
            $quiz->setUpdatedAt($quiz->getCreatedAt());
            
            $quiz->setUser($puser);
            
            
            $this->em->persist($puser);
            $this->em->persist($quiz);
            $this->em->flush();
            return $this->json([
                'message' => 'Created a new quiz!',
            ]);
        }
    }
    
    /**
     * @Route("/quiz/all", name="get_all_quiz",methods="GET")
     */
    public function getAll(Request $request)
    {
        $puser =  $this->userRepository->findOneBy(['apiToken'=>$request->headers->get('X-AUTH-TOKEN')]);
        if($puser){            
          //  $quizzes = $this->quizRepository->findBy(['user'=>$puser]);
            
            $quizzes = $this->quizRepository->findByUser($puser);
         
            return $this->json([
                'message' => 'Get all quizzes',
                'items' => $quizzes
            ]);
        }
    }
    
    /**
     * @Route("/quiz/delete/{id}", name="delete_quiz",methods="GET")
     */
    public function delete(Request $request,$id)
    {
        
        $puser =  $this->userRepository->findOneBy(['apiToken'=>$request->headers->get('X-AUTH-TOKEN')]);
        
        
        if($puser){
            $quiz = $this->quizRepository->findOneBy(['id'=>$id,'user'=>$puser]);
            
            if($quiz){
            
                $this->em->remove($quiz);
                $this->em->flush();
                
                return $this->json([
                    'message' => 'Deleted quiz!',
                ]);
            }
        }
        return $this->json([
            'message' => 'Can not delete quiz!',
        ]);
        
       /* $quiz = $this->quizRepository->findOneBy(['id'=>$id,'userId'=>$puser]);
        
        if($quiz){
            return $this->json([
                'message' => 'Removed a  quiz!',
                'path' => 'src/Controller/CreateQuizController.php',
            ]);
        }
        return $this->json([
            'message' => 'Could not delete quiz!',
            'path' => 'src/Controller/CreateQuizController.php',
        ]);*/
    }
}
