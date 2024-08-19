<?php
declare(strict_types=1);

namespace Mwl91\Tdd\Domain\Enums;

use Mwl91\Tdd\Contracts\CarAttribute;

enum Engine: string implements CarAttribute
{
    case AUTOMATIC = 'AUTOMATIC';
    case MANUAL = 'MANUAL';
}