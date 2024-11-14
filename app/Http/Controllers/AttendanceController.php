<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attendance\ClockInRequest;
use App\Models\Attendance;
use App\Services\AttendanceService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    use AuthorizesRequests;
    protected $service;

    public function __construct(AttendanceService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->authorize('clock-in');
        $attendance = $this->service->getEmployeeClockedIn();

        return view('pages.attendances.clock-in', compact('attendance'));
    }

    public function clockIn(ClockInRequest $request)
    {
        $this->authorize('clock-in');
        $operation = $this->service->clockIn($request->validated());

        return redirect()->route('dashboard.attendances.clock-in')->with('success', 'ClockIn Successfully');
    }

    public function clockOut(Attendance $attendance)
    {
        $this->authorize('clock-out');
        $operation = $this->service->clockOut($attendance->id);

        return redirect()->route('dashboard.attendances.clock-in')->with('success', 'ClockOut Successfully');
    }

    public function myAttendance()
    {
        $this->authorize('view-attendance');
        $attendances = $this->service->getEmployeeAttendance();

        return view('pages.attendances.my-attendance', compact('attendances'));
    }


    public function editMyAttendance(Attendance $attendance)
    {
        $this->authorize('edit-attendance');
        return view('pages.attendances.edit-my-attendance', compact('attendance'));
    }

    public function updateMyAttendance(Request $request, Attendance $attendance)
    {
        $this->authorize('edit-attendance');
        $operation = $this->service->updateMyAttendance($request->all(), $attendance->id);

        return redirect()->route('dashboard.attendances.my-attendance')->with('success', 'Attendance Updated Successfully');
    }
}
