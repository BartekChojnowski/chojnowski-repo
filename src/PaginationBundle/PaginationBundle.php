<?php

namespace PaginationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class PaginationBundle
 *
 * @package PaginationBundle
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class PaginationBundle extends Bundle
{
    public function getParent()
    {
        return 'KnpPaginatorBundle';
    }
}
