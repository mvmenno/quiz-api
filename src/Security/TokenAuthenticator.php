<?php

namespace App\Security;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

use App\Repository\UserRepository;

class TokenAuthenticator extends AbstractGuardAuthenticator {

    private $em;
    private $userRepository;

    public function __construct(EntityManagerInterface $em,UserRepository $userRepository) {
        $this->em = $em;
        $this->userRepository = $userRepository;
    }
    /**
     * 
     * @param Request $request
     * @return boolean
     */
    public function supports(Request $request) {
        return $request->headers->has('X-AUTH-TOKEN');
    }
    /**
     * 
     * @param Request $request
     * @return array
     */
    public function getCredentials(Request $request) {
        return [ 
            'token' => $request->headers->get('X-AUTH-TOKEN')
        ];
    }
    /**
     * 
     * @param array $credentials
     * @param UserProviderInterface $userProvider
     * @return App\Repository\UserRepository|boolean
     */
    public function getUser($credentials, UserProviderInterface $userProvider) {
        $apiToken = $credentials['token'];
        
        if (null === $apiToken) {
            return;
        }
        // if null, authentication will fail
        // if a User object, checkCredentials() is called
       // return $userProvider->loadUserByUsername($apikey);        
        return $this->userRepository->findOneBy(['apiToken'=>$apiToken]);
    }
    
    /**
     * 
     * @param type $credentials
     * @param UserInterface $user
     * @return boolean
     */
    public function checkCredentials($credentials, UserInterface $user) {
        // check credentials - e.g. make sure the password is valid
        // no credential check is needed in this case
        // return true to cause authentication success
        return true;
    }
    /**
     * 
     * @param Request $request
     * @param TokenInterface $token
     * @param any $providerKey
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey) {
        // on success, let the request continue
        return null;
    }
    /**
     * 
     * @param Request $request
     * @param AuthenticationException $exception
     * @return JsonResponse
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
        $data = array(
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
                // or to translate this message
                // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        );
        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }
    
    /**
     * 
     * @param Request $request
     * @param AuthenticationException $authException
     * @return JsonResponse
     */
    public function start(Request $request, AuthenticationException $authException = null) {
        $data = array(
            // you might translate this message
            'message' => 'Authentication Required'
        );
        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
    /**
     * 
     * @return boolean
     */
    public function supportsRememberMe() {
        return false;
    }

}
