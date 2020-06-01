<?php

namespace Tests\Unit;

use App\Department;
use App\Events\InvoiceApproved;
use App\Events\InvoiceCreated;
use App\Events\InvoiceDenied;
use App\Invoice;
use App\InvoiceStatus;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

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
        $status = InvoiceStatus::fromName('created');
        $invoice = factory(Invoice::class)->create(['status_id' => $status]);

        $this->assertTrue($invoice->status->is($status));
    }

    /** @test */
    public function it_has_status_created_by_default()
    {
        Event::fake([InvoiceCreated::class]);

        $invoice = factory(Invoice::class)->create();

        $this->assertTrue($invoice->status->is(InvoiceStatus::fromName('created')));
        Event::assertDispatched(InvoiceCreated::class, fn (InvoiceCreated $event) => $event->invoice->is($invoice));
    }

    /** @test */
    public function it_can_be_approved()
    {
        Event::fake([InvoiceApproved::class]);

        $invoice = factory(Invoice::class)->create(['status_id' => InvoiceStatus::fromName('created')]);

        $invoice->approve();

        $this->assertTrue($invoice->status->is(InvoiceStatus::fromName('approved')));
        Event::assertDispatched(InvoiceApproved::class, fn (InvoiceApproved $event) => $event->invoice->is($invoice));
    }

    /** @test */
    public function it_can_be_denied()
    {
        Event::fake([InvoiceDenied::class]);

        $invoice = factory(Invoice::class)->create(['status_id' => InvoiceStatus::fromName('created')]);

        $invoice->deny();

        $this->assertTrue($invoice->status->is(InvoiceStatus::fromName('denied')));
        Event::assertDispatched(InvoiceDenied::class, fn (InvoiceDenied $event) => $event->invoice->is($invoice));
    }
}
