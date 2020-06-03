<?php

namespace Tests\Unit;

use App\Events\UserActivated;
use App\Events\UserDeactivated;
use App\Invoice;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Event::fake([
            UserActivated::class,
            UserDeactivated::class,
        ]);
    }

    /** @test */
    public function user_can_be_found_by_email()
    {
        $user = factory(User::class)->create(['email' => 'johndoe@example.com']);

        $foundUser = User::findByEmail('johndoe@example.com');

        $this->assertTrue($foundUser->is($user));
    }

    /** @test */
    public function it_can_determine_if_user_is_admin()
    {
        $user = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->assertFalse($user->isAdmin());
        $this->assertFalse($user->is_admin);

        $this->assertTrue($admin->isAdmin());
        $this->assertTrue($admin->is_admin);
    }

    /** @test */
    public function user_can_be_invited()
    {
        $user = User::invite('johndoe@example.com', 'token');

        tap($user->fresh(), function ($user) {
            $this->assertTrue($user->exists());
            $this->assertEquals('johndoe@example.com', $user->email);
            $this->assertEquals('token', $user->token);
            $this->assertFalse($user->isAdmin());
        });
    }

    /** @test */
    public function user_can_be_deactivated()
    {
        $user = factory(User::class)->create();

        $user->deactivate();

        $this->assertNotNull($user->fresh()->deactivated_at);
        Event::assertDispatched(UserDeactivated::class, fn (UserDeactivated $event) => $event->user->is($user));
    }

    /** @test */
    public function user_can_be_activated()
    {
        $user = factory(User::class)->create(['deactivated_at' => now()]);

        $user->activate();

        $this->assertNull($user->fresh()->deactivated_at);
        Event::assertDispatched(UserActivated::class, fn (UserActivated $event) => $event->user->is($user));
    }

    /** @test */
    public function it_can_determine_if_user_is_active()
    {
        $user = factory(User::class)->create();

        $user->deactivate();
        $this->assertFalse($user->fresh()->isActive());

        $user->activate();
        $this->assertTrue($user->fresh()->isActive());
    }

    /** @test */
    public function getting_avatar_url()
    {
        $user = factory(User::class)->create(['email' => 'johndoe@example.com']);

        $this->assertEquals('https://www.gravatar.com/avatar/fd876f8cd6a58277fc664d47ea10ad19?d=mp&s=80', $user->avatarUrl());
        $this->assertEquals('https://www.gravatar.com/avatar/fd876f8cd6a58277fc664d47ea10ad19?d=mp&s=150', $user->avatarUrl(150));
    }

    /** @test */
    public function user_can_have_multiple_invoices()
    {
        $user = factory(User::class)->create();
        $invoiceA = factory(Invoice::class)->create(['user_id' => $user]);
        $invoiceB = factory(Invoice::class)->create(['user_id' => $user]);

        $user->invoices->assertContains($invoiceA, $invoiceB);
    }

    /** @test */
    public function user_can_add_invoice()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->make(['user_id' => null]);

        $user->addInvoice($invoice);

        $this->assertTrue($invoice->user->is($user));
    }

    /** @test */
    public function user_can_determine_if_owner_of_the_invoice()
    {
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $invoiceA = factory(Invoice::class)->create(['user_id' => $otherUser]);
        $invoiceB = factory(Invoice::class)->create(['user_id' => $user]);

        $this->assertFalse($user->isOwnerOf($invoiceA));
        $this->assertTrue($user->isOwnerOf($invoiceB));
    }
}
