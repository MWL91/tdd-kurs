<?php

use function Pest\Stressless\stress;

it('has a fast response time', function () {
    $result = stress('wp.pl')->for(1)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(100); // < 100.00ms
});
