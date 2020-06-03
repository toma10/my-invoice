<?php

namespace Tests\Unit;

use App\Status;
use Generator;
use Tests\TestCase;

class StatusTest extends TestCase
{
    public function statusNamesProvider(): Generator
    {
        yield [Status::CREATED];
        yield [Status::APPROVED];
        yield [Status::PAID];
        yield [Status::DENIED];
    }

    /**
     * @dataProvider statusNamesProvider
     * @test
     */
    public function it_can_get_status_by_its_name(string $name)
    {
        $status = Status::fromName($name);

        $this->assertNotNull($status);
        $this->assertEquals($name, $status->name);
    }
}
