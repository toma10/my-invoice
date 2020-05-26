<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\DepartmentRequest;
use App\ViewModels\DepartmentViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartmentsController
{
    public function index(): View
    {
        $departments = Department::orderBy('id')->get();

        return view('admin.departments.index', compact('departments'));
    }

    public function create(): View
    {
        $viewModel = new DepartmentViewModel();

        return view('admin.departments.create', $viewModel);
    }

    public function store(DepartmentRequest $request): RedirectResponse
    {
        Department::create($request->validated());

        flash()->success(trans('messages.department.created'));

        return back();
    }

    public function edit(Department $department): View
    {
        $viewModel = new DepartmentViewModel($department);

        return view('admin.departments.edit', $viewModel);
    }

    public function update(DepartmentRequest $request, Department $department): RedirectResponse
    {
        $department->update($request->validated());

        flash()->success(trans('messages.department.updated'));

        return back();
    }
}
