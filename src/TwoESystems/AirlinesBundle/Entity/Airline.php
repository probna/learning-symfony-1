<?php

namespace TwoESystems\AirlinesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Airline
 *
 * @ORM\Table(name="airline")
 * @ORM\Entity(repositoryClass="TwoESystems\AirlinesBundle\Repository\AirlineRepository")
 */
class Airline {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $title;

    /**
     * @var \TwoESystems\AirlinesBundle\Entity\Country
     *
     * Many Airlines have One Country.
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="airlines")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     *
     */
    private $country;

    /**
     *
     * */
    public $tomo;

    /**
     *
     */
    public function isLegal()
    {
//        die('z');
        if ($this->tomo === "123"){
            return true;
        }

        return false;

    }

    /**
     * @return mixed
     */
    public function getTomo()
    {
        return $this->tomo;
    }

    /**
     * @param mixed $tomo
     */
    public function setTomo1(\DateTime $tomo)
    {
        $this->tomo = $tomo;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Airline
     */
    public function setName($name)
    {
        $this->title = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->title;
    }

    /**
     * Set country
     *
     * @param integer $country_id
     *
     * @return Airline
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \TwoESystems\AirlinesBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }
}

