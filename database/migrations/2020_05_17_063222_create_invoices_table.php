<?php

use App\Currency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('company_registration_number');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->date('period');
            $table->date('invoice_date');
            $table->date('date_of_taxable_supply');
            $table->date('due_date');
            $table->decimal('price', 10, 2);
            $table->enum('currency', Currency::keys());
            $table->integer('hours');
            $table->string('variable_symbol');
            $table->string('constant_symbol')->nullable();
            $table->string('pdf_file_filename');
            $table->string('pdf_file_path');
            $table->text('description');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
