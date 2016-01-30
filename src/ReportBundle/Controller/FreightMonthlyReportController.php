<?php

namespace ReportBundle\Controller;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Entity\User;
use ReportBundle\Model\FreightMonthlyReport;
use ReportBundle\Model\Report;
use ReportBundle\Utils\Chart\Freight\Monthly\DistanceChart;
use ReportBundle\Utils\Chart\Freight\Monthly\FreightCountChart;
use ReportBundle\Utils\Chart\Freight\Monthly\PriceChart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CarMainReportController
 * @package ReportBundle\Controller
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 * @Route("/report/freight")
 */
class FreightMonthlyReportController extends ReportController
{
    /**
     * Report main page.
     *
     * @Route("/montly-report", name="freight_montly_report")
     * @Template()
     */
    public function freightMonthyAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->get('doctrine.orm.entity_manager');

        /** @var User report */
        $this->getUser()->getCompany();

        # Obiekt wyświetlanego raportu
        $report = new FreightMonthlyReport(
            $this->getUser()->getCompany(),
            $em
        );

        return $this->render('ReportBundle:Freight:monthly-report.html.twig', array(
            'results' => $report->getResults(),
            'charts' => $this->buildCharts($report)
        ));
    }

    /**
     * Metoda zajmuje się przygotowaniem wykresów wyświetlanych w raporcie
     *
     * @param Report $report Raport, dla którego przygotowywane są wydruki
     *
     * @return array
     */
    private function buildCharts(Report $report)
    {
        $charts = array();

        foreach($report->getResults() as $year => $yearResults) {
            # Obiekty wyświetlanych wykresów
            $freightCountChart = new FreightCountChart($this->getLava(), 'freight-count-chart', 'Zlecenia', $year);
            $distanceChart = new DistanceChart($this->getLava(), 'distance-chart', 'Przejechane kilometry', $year);
            $priceChart = new PriceChart($this->getLava(), 'price-chart', 'Suma', $year);

            $charts[$year] = array(
                'freightCountChartScript' => $freightCountChart->render($report),
                'freightCountChartLavaScript' => $this->getLava()->render('BarChart', $freightCountChart->getCaption(), $freightCountChart->getName()),
                'distanceChartScript' => $distanceChart->render($report),
                'distanceChartLavaScript' => $this->getLava()->render('BarChart', $distanceChart->getCaption(), $distanceChart->getName()),
                'priceChartScript' => $priceChart->render($report),
                'priceChartLavaScript' => $this->getLava()->render('BarChart', $priceChart->getCaption(), $priceChart->getName()),
            );
        }

        return $charts;
    }
}
