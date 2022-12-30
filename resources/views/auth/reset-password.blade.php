@extends('layouts.auth')
@section('layout_title', 'Atur Ulang Kata Sandi')
@section('layout_content')
        <div class="row justify-content-center form-bg-image">
            <p class="text-center"><a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                <i class="fas fa-arrow-left"></i> &nbsp;
                Kembali ke log in
                </a>
            </p>
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="bg-white shadow border-0 rounded p-4 p-lg-5 w-100 fmxw-500">
                    <h1 class="h3 mb-4">Atur Ulang Kata Sandi</h1>
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ old('token', request()->token) }}">
                        <!-- Form -->
                        <div class="mb-4">
                            <label for="email">Alamat Email</label>
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" value="{{ old('email', request()->email) }}" id="email" required readonly>
                            </div>  
                            @error('email')
                                <p class="text text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End of Form -->
                        <!-- Form -->
                        <div class="form-group mb-4">
                            <label for="password">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password" placeholder="Kata Sandi" class="form-control" id="password" required>
                            </div>  
                            @error('password')
                                <p class="text text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End of Form -->
                        <!-- Form -->
                        <div class="form-group mb-4">
                            <label for="confirm_password">Ulangi Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password_confirmation" placeholder="Ulangi Kata Sandi" class="form-control" id="confirm_password" required>
                            </div>  
                            @error('password_confirmation')
                                <p class="text text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End of Form -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-gray-800">Atur kata sandi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection