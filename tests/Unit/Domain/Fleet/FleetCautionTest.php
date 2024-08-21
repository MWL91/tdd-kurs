<?php
declare(strict_types=1);

namespace Mwl91\Tests\Tdd\Unit\Domain\Fleet;

use Mwl91\Tdd\Domain\Fleet;
use Mwl91\Tdd\Domain\ValueObjects\FleetId;
use Mwl91\Tests\Tdd\Builders\CarBuilder;
use PHPUnit\Framework\TestCase;

class FleetCautionTest extends TestCase
{

    public function testCanSetCautionPercent(): void
    {
        // Given:
        $percent = 10;
        $id = FleetId::make();
        $fleet = new Fleet($id);

        // When:
        $fleet->setCautionPercent($percent);

        // Then:
        $this->assertEquals($percent, $fleet->getCautionPercent());
    }

    public function testCannotSetCautionInvalidPercent(): void
    {
        // Given:
        $this->expectException(\OutOfBoundsException::class);
        $percent = -1;
        $id = FleetId::make();
        $fleet = new Fleet($id);

        // When:
        $fleet->setCautionPercent($percent);

        // Then:
        $this->assertEquals($percent, $fleet->getCautionPercent());
    }

    public function testCannotSetCautionPercentHigherThen100(): void
    {
        // Given:
        $this->expectException(\OutOfBoundsException::class);
        $percent = 101;
        $id = FleetId::make();
        $fleet = new Fleet($id);

        // When:
        $fleet->setCautionPercent($percent);

        // Then:
        $this->assertEquals($percent, $fleet->getCautionPercent());
    }
}
