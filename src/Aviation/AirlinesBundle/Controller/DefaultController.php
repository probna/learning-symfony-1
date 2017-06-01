<?php

namespace Aviation\AirlinesBundle\Controller;

use Aviation\AirlinesBundle\Entity\FlightSearch;
use Aviation\AirlinesBundle\Form\FindFlightsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\VarDumper\VarDumper;

class DefaultController extends Controller {
    /**
     * Show a form for searching flights between two airports
     *
     * @Route("/")
     */
    public function indexAction(): Response
    {
        $form = $this->createForm(FindFlightsType::class, null, ['action' => $this->generateUrl('search-flights')]);
        
        return $this->render('AviationAirlinesBundle:Default:findFlightsForm.html.twig',
            ['flights_form' => $form->createView()]);

    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @Method("POST")
     * @Route("/search-flights", name="search-flights")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleSearchRequest(Request $request)
    {
        $flightSearch = new FlightSearch();

        $form = $this->createForm(FindFlightsType::class, $flightSearch);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $departureAirport = $flightSearch->getDepartureAirport();
            $destinationAirport = $flightSearch->getArrivalAirport();
            $flightDate = $flightSearch->getDate();

            $flights = $this->get('aviation.airlines.service.flight_search')->getFlightsBetweenAirportsOn($departureAirport,
                $destinationAirport, $flightDate);

            dump($flights);
            return $this->render('flight/flightList.html.twig', array(
                'flights' => $flights,
            ));
        }
        return $this->render('AviationAirlinesBundle:Default:findFlightsForm.html.twig',
            ['flights_form' => $form->createView()]);

    }


    /**
     * Shows a list of all airports
     *
     * @Route("/get-airports")
     */
    public function getListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $airports = $em->getRepository('AviationAirlinesBundle:Airport')->findAll();

        return $this->render('AviationAirlinesBundle:Default:index.html.twig', array(
            'airports' => $airports,
        ));
    }
}
