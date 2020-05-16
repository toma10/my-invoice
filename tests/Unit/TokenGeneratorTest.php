<?php

namespace Tests\Unit;

use App\TokenGenerator;
use Tests\TestCase;

class TokenGeneratorTest extends TestCase
{
    /** @test */
    public function must_be_64_characters_long()
    {
        $generator = new TokenGenerator();

        $token = $generator->generate();

        $this->assertEquals(64, strlen($token));
    }

    /** @test */
    public function can_only_contain_upper_letters_and_numbers()
    {
        $generator = new TokenGenerator();

        $token = $generator->generate();

        $this->assertMatchesRegularExpression('/^[A-Z0-9]+$/', $token);
    }

    /** @test */
    public function tokens_must_be_unique()
    {
        $generator = new TokenGenerator();

        $tokens = array_map(function ($i) use ($generator) {
            return $generator->generate();
        }, range(1, 100));

        $this->assertCount(100, array_unique($tokens));
    }
}
