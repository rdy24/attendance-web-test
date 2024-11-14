@extends('layouts.app')

@section('title')
Add Employee | {{ config('app.name') }}
@endsection

@section('content')
<div class="section-header">
    <h1>Add Employee</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item active">Add Employee</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.employees.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Employee Name</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" required
                                value="{{ old('city') }}">
                            @error('city')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Date Of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required
                                value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                value="{{ old('email') }}">
                            @error('email')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status" value="active" {{
                                    old('status')=='active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status1" value="inactive"
                                    {{ old('status')=='inactive' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status1">
                                    Tidak Aktif
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Hak Akses</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="role" value="admin" {{
                                    old('role')=='admin' ? 'checked' : '' }}>
                                <label class="form-check-label" for="role">
                                    Admin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="role1" value="user"
                                    {{ old('role')=='user' ? 'checked' : '' }}>
                                <label class="form-check-label" for="role1">
                                    User
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('dashboard.employees.index') }}" class="btn btn-outline-primary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection