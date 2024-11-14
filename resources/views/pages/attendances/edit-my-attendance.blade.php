@extends('layouts.app')

@section('title')
Edit Attendance | {{ config('app.name') }}
@endsection

@section('content')
<div class="section-header">
    <h1>Edit Attendance</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item active">Edit Attendance</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.attendances.my-attendance.update', $attendance->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Status Field with Radio Buttons -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div>
                                <label>
                                    <input type="radio" name="status" value="present"
                                        {{ old('status', $attendance->status) == 'present' ? 'checked' : '' }}
                                        onchange="toggleClockFields(true)">
                                    Present
                                </label>
                                <label>
                                    <input type="radio" name="status" value="absent"
                                        {{ old('status', $attendance->status) == 'absent' ? 'checked' : '' }}
                                        onchange="toggleClockFields(false)">
                                    Absent
                                </label>
                            </div>
                            @error('status')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Clock In Field -->
                        <div class="form-group {{ $attendance->status == 'absent' ? 'd-none' : '' }}" id="clock-in-field">
                            <label for="clock_in">Clock In</label>
                            <input type="text" class="form-control" id="clock_in" name="clock_in"
                                value="{{ old('clock_in', $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('Y-m-d\TH:i') : '') }}">
                            @error('clock_in')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Clock Out Field -->
                        <div class="form-group {{ $attendance->status == 'absent' ? 'd-none' : '' }}" id="clock-out-field">
                            <label for="clock_out">Clock Out</label>
                            <input type="text" class="form-control" id="clock_out" name="clock_out"
                                value="{{ old('clock_out', $attendance->clock_out ?  \Carbon\Carbon::parse($attendance->clock_out)->format('Y-m-d\TH:i') : '') }}">
                            @error('clock_out')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('dashboard.attendances.index') }}" class="btn btn-outline-primary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js-page')
<script>
    function toggleClockFields(isPresent) {
        const clockInField = document.getElementById('clock-in-field');
        const clockOutField = document.getElementById('clock-out-field');

        if (isPresent) {
            clockInField.style.display = 'block';
            clockOutField.style.display = 'block';
        } else {
            clockInField.style.display = 'none';
            clockOutField.style.display = 'none';
        }
    }

    var pickerClockIn = flatpickr("#clock_in", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
    });

    var pickerClockOut = flatpickr("#clock_out", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
    });
</script>
@endpush
