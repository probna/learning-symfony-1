<?php

namespace Aviation\AirlinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Flight.
 *
 * @ORM\Table(name="flight")
 * @ORM\Entity(repositoryClass="Aviation\AirlinesBundle\Repository\FlightRepository")
 * @UniqueEntity("flightNumber")
 */
class Flight
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="flightNumber", type="integer", unique=true, nullable=false)
     */
    private $flightNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="flightCode", type="string", length=255, nullable=false)
     */
    private $flightCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departureTime", type="datetime", nullable=false)
     */
    private $departureTime;

    /**
     * @var \Aviation\AirlinesBundle\Entity\Airport
     *
     * @ORM\ManyToOne(targetEntity="Aviation\AirlinesBundle\Entity\Airport")
     *
     * @ORM\JoinColumn(name="departureAirport", referencedColumnName="id", nullable=false)
     */
    private $departureAirport;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrivalTime", type="datetime", nullable=false)
     */
    private $arrivalTime;

    /**
     * @var \Aviation\AirlinesBundle\Entity\Airport
     *
     * @ORM\ManyToOne(targetEntity="Aviation\AirlinesBundle\Entity\Airport")
     *
     * @ORM\JoinColumn(name="arrivalAirport", referencedColumnName="id", nullable=false)
     */
    private $arrivalAirport;

    /**
     * @var \Aviation\AirlinesBundle\Entity\Airline
     * @ORM\ManyToOne(targetEntity="Aviation\AirlinesBundle\Entity\Airline")
     *
     * @ORM\JoinColumn(name="airline", referencedColumnName="id", nullable=false)
     */
    private $airline;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set flightNumber.
     *
     * @param int $flightNumber
     *
     * @return Flight
     */
    public function setFlightNumber($flightNumber)
    {
        $this->flightNumber = $flightNumber;

        return $this;
    }

    /**
     * Get flightNumber.
     *
     * @return int
     */
    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    /**
     * Set flightCode.
     *
     * @param string $flightCode
     *
     * @return Flight
     */
    public function setFlightCode($flightCode)
    {
        $this->flightCode = $flightCode;

        return $this;
    }

    /**
     * Get flightCode.
     *
     * @return string
     */
    public function getFlightCode()
    {
        return $this->flightCode;
    }

    /**
     * Set departureTime.
     *
     * @param \DateTime $departureTime
     *
     * @return Flight
     */
    public function setDepartureTime(\DateTime $departureTime)
    {
        $this->departureTime = $departureTime;

        return $this;
    }

    /**
     * Get departureTime.
     *
     * @return \DateTime
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * Set departureAirport.
     *
     * @param int $departureAirport
     *
     * @return Flight
     */
    public function setDepartureAirport($departureAirport)
    {
        $this->departureAirport = $departureAirport;

        return $this;
    }

    /**
     * Get departureAirport.
     *
     * @return \Aviation\AirlinesBundle\Entity\Airport
     */
    public function getDepartureAirport()
    {
        return $this->departureAirport;
    }

    /**
     * Set arrivalTime.
     *
     * @param \DateTime $arrivalTime
     *
     * @return Flight
     */
    public function setArrivalTime(\DateTime $arrivalTime)
    {
        $this->arrivalTime = $arrivalTime;

        return $this;
    }

    /**
     * Get arrivalTime.
     *
     * @return \DateTime
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * Set arrivalAirport.
     *
     * @param int $arrivalAirport
     *
     * @return Flight
     */
    public function setArrivalAirport($arrivalAirport)
    {
        $this->arrivalAirport = $arrivalAirport;

        return $this;
    }

    /**
     * Get arrivalAirport.
     *
     * @return \Aviation\AirlinesBundle\Entity\Airport
     */
    public function getArrivalAirport()
    {
        return $this->arrivalAirport;
    }

    /**
     * Set airline.
     *
     * @param int $airline
     *
     * @return Flight
     */
    public function setAirline($airline)
    {
        $this->airline = $airline;

        return $this;
    }

    /**
     * Get airline.
     *
     * @return \Aviation\AirlinesBundle\Entity\Airline
     */
    public function getAirline()
    {
        return $this->airline;
    }

    /**
     * @Assert\IsTrue(message="Departure and Arrival airports cannot be the same.")
     */
    public function isDepartureAirportDifferentThanArrivalAirport(): bool
    {
        return $this->departureAirport !== $this->arrivalAirport;
    }

    /**
     * @Assert\IsTrue(message="Arrival date and time cannot be less than or equal to the departure time.")
     */
    public function isArrivalDateTimeGreaterThanDepartureDateTime(): bool
    {
        return $this->arrivalTime > $this->departureTime;
    }
}
