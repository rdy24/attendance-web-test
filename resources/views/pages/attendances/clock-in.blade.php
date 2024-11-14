@extends('layouts.app')

@section('title')
Attendance | {{ config('app.name') }}
@endsection

@push('css-libraries')
    <link rel="stylesheet" href={{ asset("assets/module/datatables.net-bs4/css/dataTables.bootstrap4.min.css") }}>
    <link rel="stylesheet" href={{ asset("assets/module/datatables.net-select-bs4/css/select.bootstrap4.min.css") }}>
@endpush

@section('content')
    <div class="section-header">
        <h1>Attendance</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Attendance</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                            <div id="current-time" class="mb-3">
                            </div>
                            @if ($attendance)
                                <form action="{{ route('dashboard.attendances.clock-out.store', $attendance->id) }}" method="post">
                                @csrf
                                <button class="btn btn-primary" onclick="return confirm('Apakah yakin ingin Clock Out?')">Clock out</button>
                            </form>
                                
                            @else    
                            <form action="{{ route('dashboard.attendances.clock-in.store') }}" method="post">
                                @csrf
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="present" value="present">
                                    <label class="form-check-label" for="present">Present</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="absent" value="absent">
                                    <label class="form-check-label" for="absent">Absent</label>
                                </div>
                                <button class="btn btn-primary" onclick="return confirm('Apakah yakin ingin Clock In?')">Clock In</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js-libraries')
    <script src={{ asset("assets/module/datatables/media/js/jquery.dataTables.min.js") }}></script>
    <script src={{ asset("assets/module/datatables.net-bs4/js/dataTables.bootstrap4.min.js") }}></script>
    <script src={{ asset("assets/module/datatables.net-select-bs4/js/select.bootstrap4.min.js") }}></script>
    <script src={{ asset("assets/module/sweetalert/dist/sweetalert.min.js") }}></script>
@endpush

@push('js-page')
    <script src={{ asset("assets/js/page/modules-datatables.js") }}></script>
    <script>
        function updateTime() {
            const timeContainer = document.getElementById('current-time');
            const currentTime = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = currentTime.toLocaleDateString('id-ID', options);
            const formattedTime = currentTime.toLocaleTimeString('id-ID');
            timeContainer.innerHTML = `${formattedDate}, ${formattedTime}`;
        }

        setInterval(updateTime, 1000);

        updateTime();
    </script>
@endpush
