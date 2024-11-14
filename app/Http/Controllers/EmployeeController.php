<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmployeeController extends Controller
{
    use AuthorizesRequests;
    protected $service;

    public function __construct(EmployeeService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view-employee');
        $employees = $this->service->getAll();

        return view('pages.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create-employee');
        return view('pages.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $this->authorize('create-employee');
        $operation = $this->service->store($request->validated());

        return redirect()->route('dashboard.employees.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $this->authorize('edit-employee');
        return view('pages.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $this->authorize('edit-employee');
        $operation = $this->service->update($request->validated(), $employee->id);

        return redirect()->route('dashboard.employees.index')->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        abort(404);
    }

    public function updateStatus(Employee $employee)
    {
        $this->authorize('edit-status-employee');
        $operation = $this->service->updateStatus($employee->id);

        return redirect()->route('dashboard.employees.index')->with('success', 'Employee status updated successfully');
    }
}
