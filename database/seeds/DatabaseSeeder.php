<?php

use App\Department;
use App\Invoice;
use App\User;
use Illuminate\Database\Seeder;

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

        factory(Invoice::class)->create([
            'user_id' => $johnDoe,
            'department_id' => $departmentA,
        ]);

        factory(Invoice::class)->create([
            'user_id' => $janeDoe,
            'department_id' => $departmentC,
        ]);
    }
}
