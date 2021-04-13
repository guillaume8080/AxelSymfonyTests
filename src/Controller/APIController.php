<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class APIController extends AbstractController
{

	//declration d'un objet
	private $client;


	//instanciation d un objet de type httpclient
	 public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    //fonction de get sur une api
    public function getData() :array{

    	$response = $this->client->request(

    		'GET',
    		'https://coronavirusapi-france.vercel.app/FranceLiveGlobalData'

    	);

    	return $response->toArray();

    }

    /**
     * @Route("/a/p/i", name="a_p_i")
     */
    public function index(): Response
    {
    	
        return $this->render('api/index.html.twig', [
            'controller_name' => 'APIController',
        ]);
    }
    /**
     * @Route("/a/p/i2", name="a_p_i2")
     */
    public function read(): Response
    {
    	
    	dd($this->getData());
        return $this->render('api/ReadAPI.html.twig', [
            'controller_name' => 'APIController',
        ]);
    }
}
