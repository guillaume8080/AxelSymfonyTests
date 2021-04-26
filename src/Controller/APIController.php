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

    private function getDynamic(string $var) : array{

    	$response = $this->client->request(

    		'GET',
    		'https://coronavirusapi-france.now.sh/'. $var);

    	return $response->toArray();


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
    	
    	$data= $this->getData();
        return $this->render('api/ReadAPI.html.twig', [
            'controller_name' => 'APIController', 'data'=>$data
        ]);
    }

    /**
     * @Route("/a/p/i3", name="a_p_i3")
     */
    public function read2(): Response
    {
    	
    	$data= $this->getDynamic("AllLiveData");
    	
        return $this->render('api/ReadAPI2.html.twig', [
            'controller_name' => 'APIController', 'data'=>$data
        ]);
    }

    /**
     * @Route("/a/p/i/detailUnObjet/{value}", name="a_p_i_detail")
     */
    public function detailDepartement(string $value): Response
    {
    	//$path = "LiveDataByDepartment?Department=" . $value;
    	
    	$data= $this->getDynamic("AllLiveData");

        return $this->render('api/ReadApi3.html.twig', [
            'controller_name' => 'APIController', 'data'=>$data , 'valeurCle'=>$value
        ]);
    }



    /**
     * @Route("/a/p/i/postTest", name="a_p_i_post")
     */
    public function  monPremierPost():Response {

    	$response = $this->client->request(

    		'POST',
    		'http://localhost:3000/posts',[
    		'json' => ['tutu' => 'est michtu' , 'titi' => 'est michti' ]

    	]);
    	 
    	return $this->render('api/printReqResp.html.twig' , [
    		'resp'=>$response ] );
    	

    }



}