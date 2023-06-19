@extends('layouts.auth')

@section('content')
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0 vh-100">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="p-4 rounded">
                                    <div class="text-center">
                                    <h1>Apotek Sehati Jaya<h1>
                                    <hr>
                                        {{-- <img src="{{ url('img/logo.png') }}" width="50" class="mb-3" /> --}}
                                        <h3 class="">Sign in</h3>
                                    </div>
                                    <div class="form-body">
                                        @if ($message = Session::get('error'))
                                            <div class="alert alert-danger">
                                                <small>{{ $message }}</small>
                                            </div>
                                        @endif
                                        <form class="row g-3" action="{{ route('login') }}" method="post">
                                            @csrf
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <input id="email" type="text"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    placeholder="Email Address" value="{!! old('email') !!}" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="inputPassword" class="form-label">Enter Password</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" placeholder="Enter Password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary rounded-pill">Sign
                                                        in</button>
                                                </div>
                                            </div>
                                            <p>Don't have an account? <a href="{{ url('register') }}">Sign up here</a>
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
