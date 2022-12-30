@extends('layouts.auth')
@section('layout_title', 'Lupa Kata Sandi')
@section('layout_content')
    <div class="row justify-content-center form-bg-image">
        <p class="text-center"><a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
            <i class="fas fa-arrow-left"></i> &nbsp;
            Kembali ke log in
            </a>
        </p>
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="signin-inner my-3 my-lg-0 bg-white shadow border-0 rounded p-4 p-lg-5 w-100 fmxw-500">
                <h1 class="h3">Lupa Kata Sandi?</h1>
                <p class="mb-4">Jangan khawatir! Cukup ketik email Anda dan kami akan mengirimkan kode untuk mereset kata sandi Anda!</p>
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <!-- Form -->
                    <div class="mb-4">
                        <label for="email">Alamat Email</label>
                        <div class="input-group">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                        </div>  
                        @error('email')
                            <p class="text text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- End of Form -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-gray-800">Pulihkan kata sandi</button>
                    </div>
                    @if (session('alert'))
                        <div class="form-group mt-4">
                            <x-alert type="{{ session('alert.type') }}" :dismissible="'true'">
                                {{ session('alert.message') }}
                            </x-alert>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection