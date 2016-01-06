<?php

namespace PaginationBundle\Subscriber\Sortable;

use Doctrine\ORM\Query;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Knp\Component\Pager\Event\ItemsEvent;
use Knp\Component\Pager\Event\Subscriber\Sortable\Doctrine\ORM\Query\OrderByWalker;
use Knp\Component\Pager\Event\Subscriber\Paginate\Doctrine\ORM\Query\Helper as QueryHelper;

/**
 * Class QuerySubscriber
 * Klasa jest odpowiednikiem \Knp\Component\Pager\Event\Subscriber\Sortable\Doctrine\ORM\QuerySubscriber, która musiała
 * zostać zastąpiona ponieważ domyślnie wykorzystywała GET-a
 *
 *
 * @package PaginationBundle\Subscriber
 */
class QuerySubscriber implements EventSubscriberInterface
{
    /**
     * Metoda wykonuje operacje związane z sortowaniem wyników w stronicowaniu
     *
     * @param ItemsEvent $event
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     */
    public function items(ItemsEvent $event)
    {
        if ($event->target instanceof Query) {
            if (isset($event->options['postData'][$event->options['sortFieldParameterName']])) {
                $dir = isset($event->options['postData'][$event->options['sortDirectionParameterName']]) && strtolower($event->options['postData'][$event->options['sortDirectionParameterName']]) === 'asc' ? 'asc' : 'desc';
                $parts = explode('.', $event->options['postData'][$event->options['sortFieldParameterName']]);

                if (isset($event->options['sortFieldWhitelist'])) {
                    if (!in_array($event->options['postData'][$event->options['sortFieldParameterName']], $event->options['sortFieldWhitelist'])) {
                        throw new \UnexpectedValueException("Cannot sort by: [{$event->options['postData'][$event->options['sortFieldParameterName']]}] this field is not in whitelist");
                    }
                }

                $event->target
                    ->setHint(OrderByWalker::HINT_PAGINATOR_SORT_DIRECTION, $dir)
                    ->setHint(OrderByWalker::HINT_PAGINATOR_SORT_FIELD, end($parts))
                ;
                if (2 <= count($parts)) {
                    $event->target->setHint(OrderByWalker::HINT_PAGINATOR_SORT_ALIAS, reset($parts));
                }
                QueryHelper::addCustomTreeWalker($event->target, 'Knp\Component\Pager\Event\Subscriber\Sortable\Doctrine\ORM\Query\OrderByWalker');
            }
        }
    }

    /**
     * Lista obsługiwanych eventów
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'knp_pager.items' => array('items', 1)
        );
    }
}
