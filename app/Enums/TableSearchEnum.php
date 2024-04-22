<?php declare(strict_types=1);

namespace App\Enums;

use Carbon\Carbon;

enum TableSearchEnum: string
{
    case PER_PAGE = '20';
    case PAGE = '1';
    case SORT_ORDER = 'asc';
    case SORT_ORDER_DESC = 'desc';
    case COLUMN = 'id';

}
