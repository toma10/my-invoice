<?php

namespace Tests\Unit;

use App\Department;
use App\Events\InvoiceApproved;
use App\Events\InvoiceCreated;
use App\Events\InvoiceDenied;
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
    public function it_has_status_created_by_default()
    {
        $invoice = factory(Invoice::class)->create();

        $this->assertTrue($invoice->status->is(Status::fromName(Status::CREATED)));
        Event::assertDispatched(InvoiceCreated::class, fn (InvoiceCreated $event) => $event->invoice->is($invoice));
    }

    /** @test */
    public function it_can_be_approved()
    {
        $invoice = factory(Invoice::class)->create(['status_id' => Status::fromName(Status::CREATED)]);

        $invoice->approve();

        $this->assertTrue($invoice->status->is(Status::fromName(Status::APPROVED)));
        Event::assertDispatched(InvoiceApproved::class, fn (InvoiceApproved $event) => $event->invoice->is($invoice));
    }

    /** @test */
    public function it_can_be_denied()
    {
        $invoice = factory(Invoice::class)->create(['status_id' => Status::fromName(Status::CREATED)]);

        $invoice->deny();

        $this->assertTrue($invoice->status->is(Status::fromName(Status::DENIED)));
        Event::assertDispatched(InvoiceDenied::class, fn (InvoiceDenied $event) => $event->invoice->is($invoice));
    }

    /** @test */
    public function it_can_determine_if_it_is_approved()
    {
        $invoice = factory(Invoice::class)->create(['status_id' => Status::fromName(Status::CREATED)]);
        $this->assertFalse($invoice->isApproved());

        $invoice->approve();

        $this->assertTrue($invoice->fresh()->isApproved());
    }

    /** @test */
    public function it_can_determine_if_it_is_denied()
    {
        $invoice = factory(Invoice::class)->create(['status_id' => Status::fromName(Status::CREATED)]);
        $this->assertFalse($invoice->isDenied());

        $invoice->deny();

        $this->assertTrue($invoice->fresh()->isDenied());
    }

    /** @test */
    public function it_can_determine_if_is_is_closed()
    {
        $invoiceA = factory(Invoice::class)->create(['status_id' => Status::fromName(Status::CREATED)]);
        $invoiceB = factory(Invoice::class)->create(['status_id' => Status::fromName(Status::CREATED)]);

        $this->assertFalse($invoiceA->isClosed());
        $this->assertFalse($invoiceB->isClosed());

        $invoiceA->approve();
        $invoiceB->deny();

        $this->assertTrue($invoiceA->fresh()->isClosed());
        $this->assertTrue($invoiceB->fresh()->isClosed());
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
