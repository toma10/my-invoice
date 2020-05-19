<?php

namespace Tests\Feature;

use App\Department;
use App\Invoice;
use App\User;
use Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EditInvoiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake();
    }

    /** @test */
    public function user_can_view_edit_invoice_page_only_for_his_invoices()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);
        $otherUser = factory(User::class)->create();
        $otherUserInvoice = factory(Invoice::class)->create(['user_id' => $otherUser]);

        $this->get("invoices/{$invoice->id}/edit")
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get("invoices/{$invoice->id}/edit")
            ->assertOk();

        $this->actingAs($user)
            ->get("invoices/{$otherUserInvoice->id}/edit")
            ->assertNotFound();
    }

    /** @test */
    public function user_can_edit_only_his_invoices()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);
        $otherUser = factory(User::class)->create();
        $otherUserInvoice = factory(Invoice::class)->create(['user_id' => $otherUser]);

        $this->put("invoices/{$invoice->id}")->assertRedirect('login');

        $respons = $this->actingAs($user)
            ->put("invoices/{$otherUserInvoice->id}")
            ->assertNotFound();
    }

    /** @test */
    public function successfully_editing_invoice()
    {
        $user = factory(User::class)->create();
        $pdf = File::create('invoice-2020-05.pdf');
        $pdfPath = Storage::putFile('invoices', $pdf);
        $invoice = factory(Invoice::class)->create([
            'user_id' => $user,
            'pdf_file_path' => $pdfPath,
            'pdf_file_filename' => 'invoice-2020-05.pdf',
        ]);
        $department = factory(Department::class)->create();
        $newPdf = File::create('invoice-2020-06.pdf');

        $response = $this->actingAs($user)->put("invoices/{$invoice->id}", [
            'company_registration_number' => '76543210',
            'department_id' => $department->id,
            'period' => '2020-06',
            'invoice_date' => '2020-05-30',
            'date_of_taxable_supply' => '2020-05-30',
            'due_date' => '2020-06-15',
            'price' => '1499.99',
            'currency' => 'USD',
            'hours' => '150',
            'variable_symbol' => '2020006',
            'constant_symbol' => '321',
            'description' => 'Invoice for 06/2020.',
            'pdf_file' => $newPdf,
            'note' => 'New eshop',
        ]);

        $this->assertDatabaseHas('invoices', [
            'company_registration_number' => '76543210',
            'user_id' => $user->id,
            'department_id' => $department->id,
            'period' => '2020-06-01 00:00:00',
            'invoice_date' => '2020-05-30 00:00:00',
            'date_of_taxable_supply' => '2020-05-30 00:00:00',
            'due_date' => '2020-06-15 00:00:00',
            'price' => '1499.99',
            'currency' => 'USD',
            'hours' => '150',
            'variable_symbol' => '2020006',
            'constant_symbol' => '321',
            'description' => 'Invoice for 06/2020.',
            'pdf_file_filename' => 'invoice-2020-06.pdf',
            'note' => 'New eshop',
        ]);
        $response->assertRedirect("invoices/{$invoice->id}");
        tap($invoice->fresh(), function ($invoice) use ($pdfPath) {
            Storage::assertExists($invoice->pdf_file_path);
            Storage::assertMissing($pdfPath);
        });
    }

    /** @test */
    public function it_keeps_current_pdf_if_new_is_not_provided()
    {
        $user = factory(User::class)->create();
        $pdf = File::create('invoice-2020-05.pdf');
        $pdfPath = Storage::putFile('invoices', $pdf);
        $invoice = factory(Invoice::class)->create([
            'user_id' => $user,
            'pdf_file_path' => $pdfPath,
        ]);
        $department = factory(Department::class)->create();

        $response = $this->actingAs($user)->put("invoices/{$invoice->id}", [
            'company_registration_number' => '76543210',
            'department_id' => $department->id,
            'period' => '2020-06',
            'invoice_date' => '2020-05-30',
            'date_of_taxable_supply' => '2020-05-30',
            'due_date' => '2020-06-15',
            'price' => '1499.99',
            'currency' => 'USD',
            'hours' => '150',
            'variable_symbol' => '2020006',
            'constant_symbol' => '321',
            'description' => 'Invoice for 06/2020.',
            'note' => 'New eshop',
        ]);

        tap($invoice->fresh(), function ($invoice) use ($pdfPath) {
            Storage::assertExists($invoice->pdf_file_path);
            $this->assertEquals($pdfPath, $invoice->pdf_file_path);
        });
    }

    public function requiredFieldsProvider(): Generator
    {
        yield ['company_registration_number'];
        yield ['department_id'];
        yield ['period'];
        yield ['invoice_date'];
        yield ['date_of_taxable_supply'];
        yield ['due_date'];
        yield ['price'];
        yield ['currency'];
        yield ['hours'];
        yield ['variable_symbol'];
        yield ['description'];
    }

    /**
     * @dataProvider requiredFieldsProvider
     * @test
     */
    public function required_fields($field)
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams([$field => null])
        );

        $response->assertSessionHasErrors($field);
    }

    /** @test */
    public function department_id_must_exist()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['department_id' => 999])
        );

        $response->assertSessionHasErrors('department_id');
    }

    /** @test */
    public function period_must_be_valid_date()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['period' => 'not-a-valid-date'])
        );

        $response->assertSessionHasErrors('period');
    }

    /** @test */
    public function invoice_date_must_be_valid_date()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['invoice_date' => 'not-a-valid-date'])
        );

        $response->assertSessionHasErrors('invoice_date');
    }

    /** @test */
    public function date_of_taxable_supply_must_be_valid_date()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['date_of_taxable_supply' => 'not-a-valid-date'])
        );

        $response->assertSessionHasErrors('date_of_taxable_supply');
    }

    /** @test */
    public function due_date_must_be_valid_date()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['due_date' => 'not-a-valid-date'])
        );

        $response->assertSessionHasErrors('due_date');
    }

    /** @test */
    public function price_must_be_numeric()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['price' => 'not-a-valid-number'])
        );

        $response->assertSessionHasErrors('price');
    }

    /** @test */
    public function price_must_be_postive()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['price' => -1])
        );
        $response->assertSessionHasErrors('price');

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['price' => 0])
        );
        $response->assertSessionDoesntHaveErrors('price');
    }

    /** @test */
    public function currency_must_be_valid_currency()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['currency' => 'INV'])
        );

        $response->assertSessionHasErrors('currency');
    }

    /** @test */
    public function hours_must_be_integer()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['hours' => 155.5])
        );

        $response->assertSessionHasErrors('hours');
    }

    /** @test */
    public function hours_must_be_postive()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['hours' => -1])
        );
        $response->assertSessionHasErrors('hours');

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['hours' => 0])
        );
        $response->assertSessionDoesntHaveErrors('hours');
    }

    /** @test */
    public function constant_symbol_is_optional()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['constant_symbol' => null])
        );

        $response->assertSessionDoesntHaveErrors('constant_symbol');
    }

    /** @test */
    public function pdf_file_must_be_file()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['pdf_file' => 'not-a-valid-file'])
        );

        $response->assertSessionHasErrors('pdf_file');
    }

    /** @test */
    public function pdf_file_must_be_pdf()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);
        $file = File::create('invoice-2020-05.jpg');

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['pdf_file' => $file])
        );

        $response->assertSessionHasErrors('pdf_file');
    }

    /** @test */
    public function note_is_optional()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $response = $this->actingAs($user)->put(
            "invoices/{$invoice->id}",
            $this->getValidParams(['note' => null])
        );

        $response->assertSessionDoesntHaveErrors('note');
    }

    protected function getValidParams(array $overrides = []): array
    {
        $department = factory(Department::class)->create();
        $pdf = File::create('invoice-2020-06.pdf');

        return array_merge([
            'company_registration_number' => '76543210',
            'department_id' => $department->id,
            'period' => '2020-06',
            'invoice_date' => '2020-05-30',
            'date_of_taxable_supply' => '2020-05-30',
            'due_date' => '2020-06-15',
            'price' => '1499.99',
            'currency' => 'USD',
            'hours' => '150',
            'variable_symbol' => '2020006',
            'constant_symbol' => '321',
            'description' => 'Invoice for 06/2020.',
            'pdf_file' => $pdf,
            'note' => 'New eshop',
        ], $overrides);
    }
}
