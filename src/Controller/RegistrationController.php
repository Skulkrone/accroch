<?php

namespace App\Controller;
 
use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
 
class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
 
        $form->handleRequest($request);
        $typerRole= $form->get('typeRoles')->getData();
        if ($form->isSubmitted() && $form->isValid()) {
 
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
 
            // Par defaut l'utilisateur aura toujours le rôle ROLE_USER
            if ($typerRole == 1){
                $user->setRoles(['ROLE_ADMIN']);
                return $this->redirectToRoute('admin');
            } elseif ($typerRole == 2){
                $user->setRoles(['ROLE_USER']);
            } elseif ($typerRole == 3){
                $user->setRoles(['ROLE_ADD']);
            }
 
            // On enregistre l'utilisateur dans la base
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
 
            return $this->redirectToRoute('default');
        }
 
        return $this->render(
            'Registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}

