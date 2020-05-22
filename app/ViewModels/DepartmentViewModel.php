<?php

namespace App\ViewModels;

use App\Department;
use Spatie\ViewModels\ViewModel;

class DepartmentViewModel extends ViewModel
{
    protected ?Department $department;

    public function __construct(?Department $department = null)
    {
        $this->department = $department;
    }

    public function department(): Department
    {
        return $this->department ?? new Department();
    }
}
