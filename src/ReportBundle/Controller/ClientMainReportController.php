<?php

namespace ReportBundle\Controller;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Entity\User;
use Khill\Lavacharts\Charts\Chart;
use ReportBundle\Model\CarMainReport;
use ReportBundle\Model\EmployeeMainReport;
use ReportBundle\Model\FreightMonthlyReport;
use Khill\Lavacharts\Lavacharts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CarMainReportController
 * @package ReportBundle\Controller
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 * @Route("/report")
 */
class ClientMainReportController extends Controller
{
    /**
     * Report main page.
     *
     * @Route("/client-main-report", name="client_main_report")
     * @Template()
     */
    public function clientMainAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->get('doctrine.orm.entity_manager');

        /** @var User report */
        $this->getUser()->getCompany();

        $report = new CarMainReport(
            $this->getUser()->getCompany(),
            $em
        );

        $lava = new Lavacharts;

        $freightCount = $lava->DataTable();

        $freightCount
            ->addStringColumn('Samochód')
            ->addNumberColumn('Ilość zleceń')
        ;

        foreach ($report->getResults() as $result) {
            $freightCount->addRow(array($result['car'], (int)$result['freightCount']));
        }

        /** @var Chart $freightCountChart */
        $freightCountChart = $lava->BarChart('Zlecenia');
        $freightCountChart
            ->height(500)
            ->datatable($freightCount)
            ;

        $distance = $lava->DataTable();

        $distance
            ->addStringColumn('Samochód')
            ->addNumberColumn('Przejechanych kilometrów')
        ;

        foreach ($report->getResults() as $result) {
            $distance->addRow(array($result['car'], $result['distanceSum']));
        }

        /** @var Chart $distanceChart */
        $distanceChart = $lava->BarChart('Przejechane kilometry');
        $distanceChart
            ->height(500)
            ->datatable($distance)
            ;


        $averageDistance = $lava->DataTable();

        $averageDistance
            ->addStringColumn('Samochód')
            ->addNumberColumn('Średnia na zlecenie')
        ;

        foreach ($report->getResults() as $result) {
            $averageDistance->addRow(array($result['car'], $result['distanceSumAverage']));
        }

        /** @var Chart $averageDistanceChart */
        $averageDistanceChart = $lava->BarChart('Średnia na zlecenie');
        $averageDistanceChart
            ->height(500)
            ->datatable($averageDistance)
            ;


        $freightCountPieChart = $lava->PieChart('freightCountPie');
        $freightCountPieChart
            ->height(800)
            ->datatable($freightCount)
            ->setOptions(array(
                'title' => 'Stosunek ilości wykonanych zleceń',
                'is3D' => true,
            ));


        return $this->render('ReportBundle:Employee:main-report.html.twig', array(
            'results' => $report->getResults(),
            'freightCountChartScript' => $freightCountChart->render('freight-count-chart'),
            'freightCountChartLavaScript' => $lava->render('BarChart', 'Zlecenia', 'freight-count-chart'),
            'distanceChartScript' => $distanceChart->render('distance-chart'),
            'distanceChartLavaScript' => $lava->render('BarChart', 'Przejechane kilometry', 'distance-chart'),
            'averageDistanceChartScript' => $averageDistanceChart->render('average-distance-chart'),
            'averageDistanceChartLavaScript' => $lava->render('BarChart', 'Średnia na zlecenie', 'average-distance-chart'),
            'freightCountPieChartScript' => $freightCountPieChart->render('freight-count-pie-chart'),
            'freightCountPieChartLavaScript' => $lava->render('PieChart', 'freightCountPie', 'freight-count-pie-chart'),
        ));
    }
}
