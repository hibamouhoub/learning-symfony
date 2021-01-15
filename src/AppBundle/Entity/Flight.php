<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flight
 *
 * @ORM\Table(name="flight")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FlightRepository")
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
     * @var string
     *
     * @ORM\Column(name="airline", type="string", length=255)
     */
    private $airline;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=255)
     */
    private $destination;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure_at", type="datetime")
     */
    private $departureAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrival_at", type="datetime")
     */
    private $arrivalAt;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


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
     * Set airline
     *
     * @param string $airline
     *
     * @return Flight
     */
    public function setAirline($airline)
    {
        $this->airline = $airline;

        return $this;
    }

    /**
     * Get airline
     *
     * @return string
     */
    public function getAirline()
    {
        return $this->airline;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Flight
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return '/images/'.$this->picture;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return Flight
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set destination
     *
     * @param string $destination
     *
     * @return Flight
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set departureAt
     *
     * @param \DateTime $departureAt
     *
     * @return Flight
     */
    public function setDepartureAt($departureAt)
    {
        $this->departureAt = $departureAt;

        return $this;
    }

    /**
     * Get departureAt
     *
     * @return \DateTime
     */
    public function getDepartureAt()
    {
        return $this->departureAt->format('Y-m-d H:i:s');
    }

    public function getTimu()
    {
        return $this->departureAt->getTimestamp();
    }

    /**
     * Set arrivalAt
     *
     * @param \DateTime $arrivalAt
     *
     * @return Flight
     */
    public function setArrivalAt($arrivalAt)
    {
        $this->arrivalAt = $arrivalAt;

        return $this;
    }

    /**
     * Get arrivalAt
     *
     * @return \DateTime
     */
    public function getArrivalAt()
    {
        return $this->arrivalAt->format('Y-m-d H:i:s');
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Flight
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}

