<?php

namespace App\Repositories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AttendanceRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Attendance();
    }

    public function getEmployeeClockedIn()
    {
        return $this->model->where('employee_id', auth()->user()->employee->id)
            ->whereNull('clock_out')
            ->where('status', 'present')
            ->first();
    }

    public function clockIn(array $data)
    {
        if($data['status'] == 'present') {
            $attendance = $this->model->create([
                'employee_id' => auth()->user()->employee->id,
                'clock_in' => now(),
                'status' => 'present',
            ]);
        } else {
            $attendance = $this->model->create([
                'employee_id' => auth()->user()->employee->id,
                'status' => 'absent',
            ]);
        }

        return $attendance;
    }

    public function clockOut(string $id)
    {
        $attendance = $this->model->find($id);

        $attendance->update([
            'clock_out' => now(),
        ]);

        return $attendance;
    }

    public function getEmployeeAttendance()
    {
        return $this->model->where('employee_id', auth()->user()->employee->id)
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('status', 'present')
                    ->whereNotNull('clock_in')
                    ->whereNotNull('clock_out');
                })
                ->orWhere('status', 'absent');
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getEmployeeAttendanceById(string $id)
    {
        return $this->model->find($id);
    }

    public function updateMyAttendance(array $data, string $id)
    {
        $attendance = $this->model->find($id);
        
        if($data['status'] == 'present') {
            $attendance->update([
                'clock_in' => $data['clock_in'],
                'clock_out' => $data['clock_out'],
                'status' => 'present',
            ]);
        } else {
            $attendance->update([
                'status' => 'absent',
                'clock_in' => null,
                'clock_out' => null,
            ]);
        }

        return $attendance;
    }


}