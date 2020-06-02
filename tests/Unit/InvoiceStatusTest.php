<?php

namespace Tests\Unit;

use App\InvoiceStatus;
use Generator;
use Tests\TestCase;

class InvoiceStatusTest extends TestCase
{
    public function statusNamesProvider(): Generator
    {
        yield [InvoiceStatus::CREATED];
        yield [InvoiceStatus::APPROVED];
        yield [InvoiceStatus::DENIED];
    }

    /**
     * @dataProvider statusNamesProvider
     * @test
     */
    public function it_can_get_status_by_its_name(string $name)
    {
        $status = InvoiceStatus::fromName($name);

        $this->assertNotNull($status);
        $this->assertEquals($name, $status->name);
    }
}
