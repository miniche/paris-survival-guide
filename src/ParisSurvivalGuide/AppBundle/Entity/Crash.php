<?php

namespace ParisSurvivalGuide\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="crashes")
 */
class Crash
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateTime;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $season;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $meteo;

    /**
     * @ORM\Column(type="integer", length=2)
     */
    protected $arrondissement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $street1;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $street2;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $vehicule1;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $vehicule1Status;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $vehicule1Gravity;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $vehicule2;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $vehicule2Status;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $vehicule2Gravity;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $vehicule3;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $vehicule3Status;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $vehicule3Gravity;

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getArrondissement()
    {
        return $this->arrondissement;
    }

    /**
     * @param mixed $arrondissement
     */
    public function setArrondissement($arrondissement)
    {
        $this->arrondissement = $arrondissement;
    }

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param mixed $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getStreet1()
    {
        return $this->street1;
    }

    /**
     * @param mixed $street1
     */
    public function setStreet1($street1)
    {
        $this->street1 = $street1;
    }

    /**
     * @return mixed
     */
    public function getStreet2()
    {
        return $this->street2;
    }

    /**
     * @param mixed $street2
     */
    public function setStreet2($street2)
    {
        $this->street2 = $street2;
    }

    /**
     * @return mixed
     */
    public function getVehicule1()
    {
        return $this->vehicule1;
    }

    /**
     * @param mixed $vehicule1
     */
    public function setVehicule1($vehicule1)
    {
        $this->vehicule1 = $vehicule1;
    }

    /**
     * @return mixed
     */
    public function getVehicule1Gravity()
    {
        return $this->vehicule1Gravity;
    }

    /**
     * @param mixed $vehicule1Gravity
     */
    public function setVehicule1Gravity($vehicule1Gravity)
    {
        $this->vehicule1Gravity = $vehicule1Gravity;
    }

    /**
     * @return mixed
     */
    public function getVehicule1Status()
    {
        return $this->vehicule1Status;
    }

    /**
     * @param mixed $vehicule1Status
     */
    public function setVehicule1Status($vehicule1Status)
    {
        $this->vehicule1Status = $vehicule1Status;
    }

    /**
     * @return mixed
     */
    public function getVehicule2()
    {
        return $this->vehicule2;
    }

    /**
     * @param mixed $vehicule2
     */
    public function setVehicule2($vehicule2)
    {
        $this->vehicule2 = $vehicule2;
    }

    /**
     * @return mixed
     */
    public function getVehicule2Gravity()
    {
        return $this->vehicule2Gravity;
    }

    /**
     * @param mixed $vehicule2Gravity
     */
    public function setVehicule2Gravity($vehicule2Gravity)
    {
        $this->vehicule2Gravity = $vehicule2Gravity;
    }

    /**
     * @return mixed
     */
    public function getVehicule2Status()
    {
        return $this->vehicule2Status;
    }

    /**
     * @param mixed $vehicule2Status
     */
    public function setVehicule2Status($vehicule2Status)
    {
        $this->vehicule2Status = $vehicule2Status;
    }

    /**
     * @return mixed
     */
    public function getVehicule3()
    {
        return $this->vehicule3;
    }

    /**
     * @param mixed $vehicule3
     */
    public function setVehicule3($vehicule3)
    {
        $this->vehicule3 = $vehicule3;
    }

    /**
     * @return mixed
     */
    public function getVehicule3Gravity()
    {
        return $this->vehicule3Gravity;
    }

    /**
     * @param mixed $vehicule3Gravity
     */
    public function setVehicule3Gravity($vehicule3Gravity)
    {
        $this->vehicule3Gravity = $vehicule3Gravity;
    }

    /**
     * @return mixed
     */
    public function getVehicule3Status()
    {
        return $this->vehicule3Status;
    }

    /**
     * @param mixed $vehicule3Status
     */
    public function setVehicule3Status($vehicule3Status)
    {
        $this->vehicule3Status = $vehicule3Status;
    }

    /**
     * @return mixed
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param mixed $season
     */
    public function setSeason($season)
    {
        $this->season = $season;
    }

    /**
     * @return mixed
     */
    public function getMeteo()
    {
        return $this->meteo;
    }

    /**
     * @param mixed $meteo
     */
    public function setMeteo($meteo)
    {
        $this->meteo = $meteo;
    }

}