<?php

namespace PaginationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PaginationBundle extends Bundle
{
    public function getParent()
    {
        return 'KnpPaginatorBundle';
    }
}
