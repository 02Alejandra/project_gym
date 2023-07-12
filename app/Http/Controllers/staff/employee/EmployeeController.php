<?php

namespace App\Http\Controllers\staff\employee;

use App\Http\Controllers\Controller;
use App\Models\staff\employee\Employee;
use App\Models\staff\occupation\Occupation;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        $employees = Employee::all();
        return view('staff.employee.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $occupations = Occupation::all();
        return view('staff.employee.create', ['occupations' => $occupations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'identify' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'occupation' => 'required|exists:occupations,id',
        ]);

        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->identify = $request->identify;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->occupation_id = $request->occupation;
        $employee->save();

        return redirect()->route('employee.index')->with('success', 'Empleado creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('staff.employee.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        $occupations = Occupation::all();
        return view('staff.employee.edit', ['employee' => $employee, 'occupations' => $occupations]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'identify' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'occupation' => 'required|exists:occupations,id',
        ]);

        $employee = Employee::find($id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->identify = $request->identify;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->occupation_id = $request->occupation;
        $employee->save();

        return redirect()->route('employee.index')->with('success', 'Empleado actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $relatedemployees = User::where('employee_id', $employee->id)->count();
        if ($relatedemployees > 0) {
            return redirect()->back()->with('error', 'No se puede eliminar el employeeo porque tiene employeeos relacionados en bodega');
        }
        $employee->delete();
        return redirect()->back()->with('success', 'employeeo eliminado con éxito');
    }
}
