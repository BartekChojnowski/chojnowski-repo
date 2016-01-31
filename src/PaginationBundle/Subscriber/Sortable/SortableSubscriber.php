<?php

namespace PaginationBundle\Subscriber\Sortable;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Knp\Component\Pager\Event\BeforeEvent;

/**
 * Class SortableSubscriber
 *
 * @package PaginationBundle\Subscriber
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class SortableSubscriber implements EventSubscriberInterface
{
    /**
     * Metoda dodaje odpowiednie subscribery obsługujące sortowanie
     *
     * @param BeforeEvent $event
     */
    public function before(BeforeEvent $event)
    {
        $disp = $event->getEventDispatcher();
        $disp->addSubscriber(new QuerySubscriber());
    }

    /**
     * Lista obsługiwanych eventów
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'knp_pager.before' => array('before', 1)
        );
    }
}
