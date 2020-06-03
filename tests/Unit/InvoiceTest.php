<?php

namespace Tests\Unit;

use App\Department;
use App\Events\InvoiceApproved;
use App\Events\InvoiceCreated;
use App\Events\InvoiceDenied;
use App\Events\InvoicePaid;
use App\InvalidStatusTransitionException;
use App\Invoice;
use App\InvoiceActivityTypes;
use App\Status;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Event::fake([
            InvoiceCreated::class,
            InvoiceApproved::class,
            InvoicePaid::class,
            InvoiceDenied::class,
        ]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $this->assertTrue($invoice->user->is($user));
    }

    /** @test */
    public function it_belongs_to_a_department()
    {
        $department = factory(Department::class)->create();
        $invoice = factory(Invoice::class)->create(['department_id' => $department]);

        $this->assertTrue($invoice->department->is($department));
    }

    /** @test */
    public function it_has_a_status()
    {
        $status = Status::fromName(Status::CREATED);
        $invoice = factory(Invoice::class)->create(['status_id' => $status]);

        $this->assertTrue($invoice->status->is($status));
    }

    /** @test */
    public function it_has_status_created_when_it_is_created()
    {
        $invoice = factory(Invoice::class)->create();

        $this->assertTrue($invoice->status->is(Status::fromName(Status::CREATED)));
        Event::assertDispatched(InvoiceCreated::class, fn (InvoiceCreated $event) => $event->invoice->is($invoice));
    }

    /** @test */
    public function it_can_be_approved()
    {
        $invoice = factory(Invoice::class)->create();

        $invoice->approve();

        $this->assertTrue($invoice->fresh()->status->is(Status::fromName(Status::APPROVED)));
        Event::assertDispatched(InvoiceApproved::class, fn (InvoiceApproved $event) => $event->invoice->is($invoice));
    }

    /** @test */
    public function it_cannot_be_approved_if_it_is_paid_or_denied()
    {
        $invoiceA = factory(Invoice::class)->create();
        $invoiceA->update(['status_id' => Status::fromName(Status::PAID)->id]);
        $invoiceB = factory(Invoice::class)->create();
        $invoiceB->update(['status_id' => Status::fromName(Status::DENIED)->id]);

        try {
            $invoiceA->approve();
            $this->fail("InvalidStatusTransitionException should have been thrown, but wasn't.");
        } catch (InvalidStatusTransitionException $e) {
            $this->assertTrue($invoiceA->status->is(Status::fromName(Status::PAID)));
        }

        try {
            $invoiceB->approve();
            $this->fail("InvalidStatusTransitionException should have been thrown, but wasn't.");
        } catch (InvalidStatusTransitionException $e) {
            $this->assertTrue($invoiceB->status->is(Status::fromName(Status::DENIED)));
        }
    }

    /** @test */
    public function it_can_be_paid()
    {
        $invoice = factory(Invoice::class)->create();
        $invoice->update(['status_id' => Status::fromName(Status::APPROVED)->id]);

        $invoice->pay();

        $this->assertTrue($invoice->fresh()->status->is(Status::fromName(Status::PAID)));
        Event::assertDispatched(InvoicePaid::class, fn (InvoicePaid $event) => $event->invoice->is($invoice));
    }

    /** @test */
    public function it_cannot_be_paid_if_it_is_created_or_denied()
    {
        $invoiceA = factory(Invoice::class)->create();
        $invoiceB = factory(Invoice::class)->create();
        $invoiceB->update(['status_id' => Status::fromName(Status::DENIED)->id]);

        try {
            $invoiceA->pay();
            $this->fail("InvalidStatusTransitionException should have been thrown, but wasn't.");
        } catch (InvalidStatusTransitionException $e) {
            $this->assertTrue($invoiceA->status->is(Status::fromName(Status::CREATED)));
        }

        try {
            $invoiceB->pay();
            $this->fail("InvalidStatusTransitionException should have been thrown, but wasn't.");
        } catch (InvalidStatusTransitionException $e) {
            $this->assertTrue($invoiceB->status->is(Status::fromName(Status::DENIED)));
        }
    }

    /** @test */
    public function it_can_be_denied()
    {
        $invoiceA = factory(Invoice::class)->create();
        $invoiceB = factory(Invoice::class)->create();
        $invoiceB->update(['status_id' => Status::fromName(Status::APPROVED)->id]);

        $invoiceA->deny();

        $this->assertTrue($invoiceA->fresh()->status->is(Status::fromName(Status::DENIED)));
        Event::assertDispatched(InvoiceDenied::class, fn (InvoiceDenied $event) => $event->invoice->is($invoiceA));

        $invoiceB->deny();

        $this->assertTrue($invoiceB->fresh()->status->is(Status::fromName(Status::DENIED)));
        Event::assertDispatched(InvoiceDenied::class, fn (InvoiceDenied $event) => $event->invoice->is($invoiceB));
    }

    /** @test */
    public function it_cannot_be_denied_if_it_is_paid()
    {
        $invoice = factory(Invoice::class)->create();
        $invoice->update(['status_id' => Status::fromName(Status::PAID)->id]);

        try {
            $invoice->deny();
            $this->fail("InvalidStatusTransitionException should have been thrown, but wasn't.");
        } catch (InvalidStatusTransitionException $e) {
            $this->assertTrue($invoice->status->is(Status::fromName(Status::PAID)));
        }
    }

    /** @test */
    public function it_can_determine_if_it_has_given_status()
    {
        $invoiceA = factory(Invoice::class)->create();
        $invoiceB = factory(Invoice::class)->create();
        $invoiceB->update(['status_id' => Status::fromName(Status::APPROVED)->id]);

        $this->assertTrue($invoiceA->hasStatus(Status::CREATED));
        $this->assertFalse($invoiceA->hasStatus(Status::APPROVED));
        $this->assertFalse($invoiceB->hasStatus(Status::CREATED));
        $this->assertTrue($invoiceB->hasStatus(Status::APPROVED));
    }

    /** @test */
    public function it_logs_activity()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create();

        $invoice->logActivity(InvoiceActivityTypes::CREATED, $user);

        $this->assertCount(1, $invoice->activity);
        $this->assertTrue($invoice->activity->first()->subject->is($invoice));
        $this->assertTrue($invoice->activity->first()->causer->is($user));
    }
}
