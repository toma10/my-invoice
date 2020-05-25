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

class CreateInvoiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake();
    }

    /** @test */
    public function only_logged_in_users_can_view_create_invoice_page()
    {
        $user = factory(User::class)->create();

        $this->get('invoices/create')
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get('invoices/create')
            ->assertOk();
    }

    /** @test */
    public function only_logged_in_users_can_create_invoices()
    {
        $this->post('invoices')->assertRedirect('login');
    }

    /** @test */
    public function successfully_creating_invoice()
    {
        $user = factory(User::class)->create();
        $department = factory(Department::class)->create();
        $pdf = File::create('invoice-2020-05.pdf');

        $response = $this->actingAs($user)->post('invoices', [
            'company_registration_number' => '01234567',
            'department_id' => $department->id,
            'period' => '2020-05',
            'invoice_date' => '2020-04-30',
            'date_of_taxable_supply' => '2020-04-30',
            'due_date' => '2020-05-15',
            'price' => '30000',
            'currency' => 'CZK',
            'hours' => '160',
            'variable_symbol' => '2020005',
            'constant_symbol' => '123',
            'description' => 'Invoice for 05/2020.',
            'pdf_file' => $pdf,
            'note' => 'Refactoring + design',
        ]);

        $response->assertSessionHasFlashMessage('success');
        $this->assertDatabaseHas('invoices', [
            'company_registration_number' => '01234567',
            'user_id' => $user->id,
            'department_id' => $department->id,
            'period' => '2020-05-01 00:00:00',
            'invoice_date' => '2020-04-30 00:00:00',
            'date_of_taxable_supply' => '2020-04-30 00:00:00',
            'due_date' => '2020-05-15 00:00:00',
            'price' => '30000',
            'currency' => 'CZK',
            'hours' => '160',
            'variable_symbol' => '2020005',
            'constant_symbol' => '123',
            'description' => 'Invoice for 05/2020.',
            'pdf_file_filename' => 'invoice-2020-05.pdf',
            'note' => 'Refactoring + design',
        ]);
        tap(Invoice::first(), function (Invoice $invoice) use ($response) {
            $response->assertRedirect("invoices/{$invoice->id}");
            Storage::assertExists($invoice->pdf_file_path);
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
        yield ['pdf_file'];
        yield ['description'];
    }

    /**
     * @dataProvider requiredFieldsProvider
     * @test
     */
    public function required_fields(string $field)
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams([$field => null])
        );

        $response->assertSessionHasErrors($field);
    }

    /** @test */
    public function department_id_must_exist()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['department_id' => 999])
        );

        $response->assertSessionHasErrors('department_id');
    }

    /** @test */
    public function period_must_be_valid_date()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['period' => 'not-a-valid-date'])
        );

        $response->assertSessionHasErrors('period');
    }

    /** @test */
    public function invoice_date_must_be_valid_date()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['invoice_date' => 'not-a-valid-date'])
        );

        $response->assertSessionHasErrors('invoice_date');
    }

    /** @test */
    public function date_of_taxable_supply_must_be_valid_date()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['date_of_taxable_supply' => 'not-a-valid-date'])
        );

        $response->assertSessionHasErrors('date_of_taxable_supply');
    }

    /** @test */
    public function due_date_must_be_valid_date()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['due_date' => 'not-a-valid-date'])
        );

        $response->assertSessionHasErrors('due_date');
    }

    /** @test */
    public function price_must_be_numeric()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['price' => 'not-a-valid-number'])
        );

        $response->assertSessionHasErrors('price');
    }

    /** @test */
    public function price_must_be_positive()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['price' => -1])
        );
        $response->assertSessionHasErrors('price');

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['price' => 0])
        );
        $response->assertSessionDoesntHaveErrors('price');
    }

    /** @test */
    public function currency_must_be_valid_currency()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['currency' => 'INV'])
        );

        $response->assertSessionHasErrors('currency');
    }

    /** @test */
    public function hours_must_be_integer()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['hours' => 155.5])
        );

        $response->assertSessionHasErrors('hours');
    }

    /** @test */
    public function hours_must_be_positive()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['hours' => -1])
        );
        $response->assertSessionHasErrors('hours');

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['hours' => 0])
        );
        $response->assertSessionDoesntHaveErrors('hours');
    }

    /** @test */
    public function constant_symbol_is_optional()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['constant_symbol' => null])
        );

        $response->assertSessionDoesntHaveErrors('constant_symbol');
    }

    /** @test */
    public function pdf_file_must_be_file()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['pdf_file' => 'not-a-valid-file'])
        );

        $response->assertSessionHasErrors('pdf_file');
    }

    /** @test */
    public function pdf_file_must_be_pdf()
    {
        $user = factory(User::class)->create();
        $file = File::create('invoice-2020-05.jpg');

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['pdf_file' => $file])
        );

        $response->assertSessionHasErrors('pdf_file');
    }

    /** @test */
    public function note_is_optional()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(
            'invoices',
            $this->getValidParams(['note' => null])
        );

        $response->assertSessionDoesntHaveErrors('note');
    }

    protected function getValidParams(array $overrides = []): array
    {
        $department = factory(Department::class)->create();
        $pdf = File::create('invoice-2020-05.pdf');

        return array_merge([
            'company_registration_number' => '01234567',
            'department_id' => $department->id,
            'period' => '2020-05',
            'invoice_date' => '2020-04-30',
            'date_of_taxable_supply' => '2020-04-30',
            'due_date' => '2020-05-15',
            'price' => '30000',
            'currency' => 'CZK',
            'hours' => '160',
            'variable_symbol' => '2020005',
            'constant_symbol' => '123',
            'description' => 'Invoice for 05/2020.',
            'pdf_file' => $pdf,
            'note' => 'Refactoring + design',
        ], $overrides);
    }
}
