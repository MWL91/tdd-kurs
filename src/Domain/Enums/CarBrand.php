<?php

namespace Mwl91\Tdd\Domain\Enums;

use Mwl91\Tdd\Contracts\CarAttribute;

enum CarBrand: string implements CarAttribute
{
    case FIAT = 'Fiat';
    case RENAULT = 'Renault';
    case SMART = 'Smart';
    case SKODA = 'Skoda';
    case MERCEDES = 'Mercedes';
}
