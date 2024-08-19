<?php
declare(strict_types=1);

namespace Mwl91\Tdd\Domain\Enums;

enum Transmission: string
{
    case AUTOMATIC = 'automatic';
    case MANUAL = 'manual';
}