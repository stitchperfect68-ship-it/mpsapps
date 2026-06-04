<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\PayrollRun;
use Illuminate\Http\Request;

class HrController extends Controller
{
    public function index() { return view('hr.index'); }
    public function employees() { return view('hr.employees', ['employees' => Employee::with('department')->latest()->paginate(20)]); }
    public function createEmployee() { return view('hr.create-employee'); }
    public function storeEmployee(Request $request) { return redirect()->route('hr.employees'); }
    public function showEmployee(Employee $employee) { return view('hr.show-employee', compact('employee')); }
    public function updateEmployee(Request $request, Employee $employee) { return redirect()->route('hr.employees.show', $employee); }
    public function attendance() { return view('hr.attendance', ['records' => Attendance::with('employee')->latest()->paginate(20)]); }
    public function checkIn(Request $request) { return back(); }
    public function checkOut(Request $request) { return back(); }
    public function leave() { return view('hr.leave', ['requests' => LeaveRequest::with('employee')->latest()->paginate(20)]); }
    public function applyLeave(Request $request) { return redirect()->route('hr.leave'); }
    public function approveLeave(Request $request, LeaveRequest $leave) { return back(); }
    public function payroll() { return view('hr.payroll', ['runs' => PayrollRun::latest()->paginate(12)]); }
    public function runPayroll(Request $request) { return redirect()->route('hr.payroll'); }
    public function payslips(string $month) { return view('hr.payroll', ['runs' => collect()]); }
    public function departments() { return view('hr.index'); }
    public function searchStaff() { return response()->json([]); }
}
