<?php

namespace Tests\Unit\Rules;

use App\Rules\CurrencyRule;
use Generator;
use Tests\TestCase;

class CurrencyRuleTest extends TestCase
{
    protected $rule;

    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new CurrencyRule();
    }

    public function supportedCurrenciesProvider(): Generator
    {
        yield ['CZK'];
        yield ['USD'];
        yield ['EUR'];
    }

    /**
     * @dataProvider supportedCurrenciesProvider
     * @test
     */
    public function supported_currency_passes($currency)
    {
        $this->assertTrue($this->rule->passes('currency', $currency));
    }

    /** @test */
    public function invalid_currency_fails()
    {
        $this->assertFalse($this->rule->passes('currency', 'INV'));
    }
}
