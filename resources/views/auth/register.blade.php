@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="wrapper">
            <div class="d-flex align-items-center justify-content-center my-5 my-lg-0 vh-100">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                        <div class="col mx-auto">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Sign Up</h3>
                                        </div>
                                        <div class="form-body">
                                            <form class="row g-3" action="{{ route('register') }}" method="post">
                                                @csrf
                                                <div class="col-12">
                                                    <label for="name" class="form-label">Nama Lengkap</label>
                                                    <input id="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" placeholder="Nama Lengkap"
                                                        value="{!! old('name') !!}" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input id="email" type="text"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" placeholder="Email Address"
                                                        value="{!! old('email') !!}">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        placeholder="Enter Password" value="{!! old('password') !!}">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <label for="password-confirm" class="form-label">Confirm
                                                        Password</label>
                                                    <input id="password-confirm" type="password"
                                                        name="password_confirmation" class="form-control"
                                                        placeholder="Confirm Password">
                                                </div>

                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary rounded-pill">Sign
                                                            Up</button>
                                                    </div>
                                                </div>

                                                <p>Already have an account? <a href="{{ url('login') }}">Sign in here</a>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
