<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    
    /**
    * @Route("/connexion", name="security_login")
    */
    public function login()
    {
        return $this->render('security/index.html.twig');
    }
    
    /**
* @Route(name="loginCheck",path="/api/login_check")
*/
public function loginCheck(Request $request): JsonResponse
{
$user = $this->getUser();

return $this->json(array(
'username' => $user->getUsername(),
'roles' => $user->getRoles(),
));
}

    /**
    * @Route("/logout", name="security_logout")
    */
    public function logout() { }
       
}