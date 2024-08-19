<?php
declare(strict_types=1);
namespace Mwl91\Tests\Tdd\Unit\Fleet;

use Mwl91\Tdd\Domain\Fleet;
use PHPUnit\Framework\TestCase;

final class FleetCreateTest extends TestCase
{
    public function testCanCreateNewFleet(): void
    {
        // Given:

        // When:
        $fleet = new Fleet();

        // Then:
        $this->assertInstanceOf(Fleet::class, $fleet);
    }
}