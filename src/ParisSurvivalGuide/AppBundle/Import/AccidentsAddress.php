<?php

namespace ParisSurvivalGuide\AppBundle\Import;

use Doctrine\ORM\EntityManager;
use Guzzle\Http\Client;
use ParisSurvivalGuide\AppBundle\Entity\Crash;

class AccidentsAddress
{
    /**
     * @var
     */
    protected $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function import()
    {
        $this->process();
    }

    /**
     * Get data of csv
     *
     * @return array
     */
    private function process()
    {
        $data = $this->entityManager->getRepository('ParisSurvivalGuide\AppBundle\Entity\Crash')->findAll();

        $client = new Client();

        /** @var Crash $crash */
        $current = 0;

        foreach ($data as $crash) {
            $request = $client->get('http://maps.google.com/maps/api/geocode/json?address=' . $crash->getAddress() ."+Paris");
            $response = $request->send();

            $body = json_decode($response->getBody(true), true);

            if (isset($body['results'][0])) {
                $crash->setCoordinates($body['results'][0]['geometry']['location']['lat'] . ',' . $body['results'][0]['geometry']['location']['lng']);

                $this->entityManager->merge($crash);

                if ($current % 20 == 0) {
                    $this->entityManager->flush();
                }
            }

            $current++;
            echo $current . ' ';
        }

        $this->entityManager->flush();
    }
}