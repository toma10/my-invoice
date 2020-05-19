<?php

use App\Department;
use App\Invoice;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $johnDoe = factory(User::class)->states('admin')->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);
        $janeDoe = factory(User::class)->create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
        ]);

        $departmentA = factory(Department::class)->create(['name' => 'Department A']);
        $departmentB = factory(Department::class)->create(['name' => 'Department B']);
        $departmentC = factory(Department::class)->create(['name' => 'Department C']);

        $pdfA = File::create('invoice-a.pdf');
        $pdfPathA = Storage::putFile('invoices', $pdfA);

        factory(Invoice::class)->create([
            'user_id' => $johnDoe,
            'department_id' => $departmentA,
            'pdf_file_path' => $pdfPathA,
            'pdf_file_filename' => 'invoice-a.pdf',
        ]);

        $pdfB = File::create('invoice-b.pdf');
        $pdfPathB = Storage::putFile('invoices', $pdfB);

        factory(Invoice::class)->create([
            'user_id' => $janeDoe,
            'department_id' => $departmentC,
            'pdf_file_path' => $pdfPathB,
            'pdf_file_filename' => 'invoice-b.pdf',
        ]);
    }
}
