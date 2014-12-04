<?php

namespace ParisSurvivalGuide\AppBundle\Import;

use Doctrine\ORM\EntityManager;
use ParisSurvivalGuide\AppBundle\Entity\Meteo;

class MeteoJsonImport
{
    CONST FILENAME = 'meteo.json';

    /**
     * @var
     */
    protected $data;

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
//        $content = file_get_contents(self::FILENAME);
//        $decoded = json_decode($content, true);
//
//        foreach ($decoded as $day => $hours) {
//            foreach ($hours as $hour => $data) {
//                $meteo = new Meteo();
//
//                $datetime = new \DateTime();
//                $datetime->setDate('20' . substr($day, 6, 2), substr($day, 3, 2), substr($day, 0, 2));
//                $datetime->setTime(substr($hour, 0, 2), substr($hour, 3, 2));
//
//                try {
//                    $meteo->setDateTime($datetime);
//                    $meteo->setMeteo($data['Conditions']);
//
//                    $this->entityManager->persist($meteo);
//                    $this->entityManager->flush();
//                } catch (\Exception $e) {
//                    var_dump($datetime);
//                }
//            }
//        }

        $this->mapToCrashes();
    }

    protected function mapToCrashes()
    {
        $content = file_get_contents(self::FILENAME);
        $decoded = json_decode($content, true);

        foreach ($decoded as $day => $hours) {
            foreach ($hours as $hour => $data) {
                $datetime = new \DateTime();
                $datetime->setDate('20' . substr($day, 6, 2), substr($day, 3, 2), substr($day, 0, 2));
                $datetime->setTime(substr($hour, 0, 2), substr($hour, 3, 2));

                $datetimeLimit = clone $datetime;
                $datetimeLimit->modify('+30 minutes');

                $meteo = $data['Conditions'];

                $query = $this->entityManager->createQuery("UPDATE ParisSurvivalGuide\AppBundle\Entity\Crash c SET c.meteo = '" . $meteo ."' WHERE c.dateTime >= '" . $datetime->format('Y-m-d H:i:s') . "' AND c.dateTime < '" . $datetimeLimit->format('Y-m-d H:i:s') . "'");

                $query->execute();

                echo "Updated " . $datetime->format('Y-m-d H:i:s') . ' \r\n';
            }
        }
    }
}