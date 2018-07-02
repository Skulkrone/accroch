<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    /**
     * Afficher une nouvelle page d'accueil (code récupéré à partir de l'exercice tuto 1)
     * @Route("/", name="default")
     */
    public function index()
    {
        $routes = array();
        foreach ($this->container->get('router')->getRouteCollection()->all() as $name => $route) {
           
           if(substr($name, 0,1) != '_' && substr($name, 0,3) != 'api' && substr($name, -5) == 'index'){
               
               // Pour récupérer juste l'url définie dans la route et afficher comme titre
               $titre = $this->generateUrl($name);
               // On crée un tableau avec les route et le titre. 
               $routes[$name] = [
                   'nom' => $name,
                   'titre' => substr($titre,1, strlen($titre)),
                   ];
           }
       }

       $routeArrayObj = new \ArrayObject($routes);
       $routeArrayObj->asort();
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'routes' => $routeArrayObj,
        ]);
    }

}
