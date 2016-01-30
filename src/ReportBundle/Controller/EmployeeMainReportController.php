<?php

namespace ReportBundle\Controller;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Entity\User;
use ReportBundle\Model\EmployeeMainReport;
use ReportBundle\Utils\Chart\Employee\Main\AverageDistanceChart;
use ReportBundle\Utils\Chart\Employee\Main\DistanceChart;
use ReportBundle\Utils\Chart\Employee\Main\FreightCountChart;
use ReportBundle\Utils\Chart\Employee\Main\FreightCountPieChart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Kontroler ogólnego raportu pracy kierowców
 *
 * @package ReportBundle\Controller
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 * @Route("/report/employee")
 */
class EmployeeMainReportController extends ReportController
{
    /**
     * Report main page.
     *
     * @Route("/main-report", name="employee_main_report")
     * @Template()
     */
    public function employeeMainAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->get('doctrine.orm.entity_manager');

        /** @var User report */
        $this->getUser()->getCompany();

        # Obiekt wyświetlanego raportu
        $report = new EmployeeMainReport(
            $this->getUser()->getCompany(),
            $em
        );

        # Obiekty wyświetlanych wykresów
        $freightCountChart = new FreightCountChart($this->getLava(), 'freight-count-chart', 'Zlecenia');
        $distanceChart = new DistanceChart($this->getLava(), 'distance-chart', 'Przejechane kilometry');
        $averageDistanceChart = new AverageDistanceChart($this->getLava(), 'average-distance-chart', 'Średnia na zlecenie');
        $freightCountPieChart = new FreightCountPieChart($this->getLava(), 'freight-count-pie-chart', 'Zlecenia na kole');

        return $this->render('ReportBundle:Employee:main-report.html.twig', array(
            'results' => $report->getResults(),
            'freightCountChartScript' => $freightCountChart->render($report),
            'freightCountChartLavaScript' => $this->getLava()->render('BarChart', $freightCountChart->getCaption(), $freightCountChart->getName()),
            'distanceChartScript' => $distanceChart->render($report),
            'distanceChartLavaScript' => $this->getLava()->render('BarChart', $distanceChart->getCaption(), $distanceChart->getName()),
            'averageDistanceChartScript' => $averageDistanceChart->render($report),
            'averageDistanceChartLavaScript' => $this->getLava()->render('BarChart', $averageDistanceChart->getCaption(), $averageDistanceChart->getName()),
            'freightCountPieChartScript' => $freightCountPieChart->render($report),
            'freightCountPieChartLavaScript' => $this->getLava()->render('PieChart', $freightCountPieChart->getCaption(), $freightCountPieChart->getName()),
        ));
    }
}
