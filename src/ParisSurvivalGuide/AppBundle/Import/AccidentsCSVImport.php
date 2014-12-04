<?php

namespace ParisSurvivalGuide\AppBundle\Import;

use Doctrine\ORM\EntityManager;
use ParisSurvivalGuide\AppBundle\Entity\Crash;

class AccidentsCSVImport
{
    CONST FILENAME = 'accidentologie.csv';

    /**
     * Csv length
     */
    const LENGTH = 1000;

    /**
     * Csv delimiter
     */
    const DELIMITER = ';';

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
        $this->getDataCsv();
    }

    /**
     * Get data of csv
     *
     * @return array
     */
    private function getDataCsv()
    {
        $handle = fopen(self::FILENAME, "r");

        $currentLine = 0;
        while (($dataCsv = fgetcsv($handle, self::LENGTH, self::DELIMITER)) !== false) {
            // This excludes CSV headers
            if ($currentLine != 0) {

                $crash = new Crash();

                $crash->setDateTime(new \DateTime($dataCsv[0] . ' ' . $dataCsv[1]));

                // Season
                $crash->setSeason($this->getSeason($crash->getDateTime()));

                $crash->setArrondissement(substr($dataCsv[3], 1, 2));
                $crash->setAddress($dataCsv[4]);
                $crash->setStreet1($dataCsv[7]);
                $crash->setStreet2($dataCsv[8]);
                $crash->setVehicule1($dataCsv[9]);
                $crash->setVehicule1Status($dataCsv[10] == 'Z' ? 'Fuite' : 'Sage');

                if ($dataCsv[11] != '')
                {
                    $crash->setVehicule2($dataCsv[11]);
                    $crash->setVehicule2Status($dataCsv[12] == 'Z' ? 'Fuite' : 'Sage');
                }

                if ($dataCsv[13] != '')
                {
                    $crash->setVehicule3($dataCsv[13]);
                    $crash->setVehicule3Status($dataCsv[14] == 'Z' ? 'Fuite' : 'Sage');
                }

                // Detecting Pedestrians...
                $isPedestrian = false;
                if ($crash->getVehicule2() == '') {
                    if ($dataCsv[15] == 'Piéto' || $dataCsv[18] == 'Piéto' || $dataCsv[21] == 'Piéto') {
                        $isPedestrian = true;
                        $crash->setVehicule2('Pieton');
                        $dataCsv[20] = 'B';
                    }
                }

                if ($crash->getVehicule3() == '' && !$isPedestrian) {
                    if ($dataCsv[15] == 'Piéto' || $dataCsv[18] == 'Piéto' || $dataCsv[21] == 'Piéto') {
                        $isPedestrian = true;
                        $crash->setVehicule3('Pieton');
                        $dataCsv[23] = 'C';
                    }
                }

                $gravities = $this->generateGravities($dataCsv);

                $crash->setVehicule1Gravity($gravities['A'] != '-1' ? $gravities['A'] : null);
                $crash->setVehicule2Gravity($gravities['B'] != '-1' ? $gravities['B'] : null);
                $crash->setVehicule3Gravity($gravities['C'] != '-1' ? $gravities['C'] : null);

                $this->entityManager->persist($crash);

                if ($currentLine % 20 == 0) {
                    $this->entityManager->flush();
                }

            }
            $currentLine++;
        }

        $this->entityManager->flush();

        fclose($handle);

        return $this->data;
    }

    private function generateGravities($row)
    {
        $array = array('A' => -1, 'B' => -1, 'C' => -1);
        $levels = array('Indem' => 0, 'BL' => 1, 'BH' => 2, 'Tué' => 3);

        for ($i=17; $i < 27; ($i=$i+3)) {

            $levelCol = $i - 1;

            if ($row[$levelCol] != '' && isset($array[$row[$i]])) {
                if ($array[$row[$i]] < $levels[$row[$levelCol]]) {
                    $array[$row[$i]] = $row[$levelCol];
                }
            }

        }

        return $array;

    }

    private function getSeason(\DateTime $datetime)
    {
        $j = $datetime->format('d');
        $m = $datetime->format('m');

        switch($m) {
            case 1:
                $saison = "Hiver";
                break;
            case 2:
                $saison = "Hiver";
                break;
            case 3:
                if ($j >= 21)
                    $saison = "Printemps";
                else  $saison = "Hiver";
                break;
            case 4:
                $saison = "Printemps";
                break;
            case 5:
                $saison = "Printemps";
                break;
            case 6:
                if ($j >= 21)
                    $saison = "Eté";
                else  $saison = "Printemps";
                break;
            case 7:
                $saison = "Eté";
                break;
            case 8:
                $saison = "Eté";
                break;
            case 9:
                if ($j >= 23)
                    $saison = "Automne";
                else  $saison = "Eté";
                break;
            case 10:
                $saison = "Automne";
                break;
            case 11:
                $saison = "Automne";
                break;
            case 12:
                if ($j >= 22)
                    $saison = "Hiver";
                else  $saison = "Automne";
                break;
        }

        return $saison;
    }
}