<?php

namespace Mwl91\Tdd\Domain\Enums;

use Mwl91\Tdd\Contracts\CarAttribute;

enum Fuel: string implements CarAttribute
{
    case PETROL = 'Petrol';
    case DIESEL = 'Diesel';
    case LPG = 'LPG';
    case CNG = 'CNG';
    case ELECTRIC = 'Electric';
    case HYBRID = 'Hybrid';
    case HYDROGEN = 'Hydrogen';
    case BIOFUEL = 'Biofuel';
}