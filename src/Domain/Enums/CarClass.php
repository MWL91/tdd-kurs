<?php
declare(strict_types=1);

namespace Mwl91\Tdd\Domain\Enums;

use Mwl91\Tdd\Contracts\CarAttribute;

enum CarClass: string implements CarAttribute
{
    case A = 'A';
    case B_ELECTRIC = 'B_ELECTRIC';
    case B = 'B';
    case C = 'C';
    case D = 'D';
    case E = 'E';
    case F = 'F';
    case SUV = 'SUV';
    case C_ELECTRIC = 'C_ELECTRIC';
    case PREMIUM = 'PREMIUM';
}