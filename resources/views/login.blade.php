@extends('template.main')

@section('title', 'Login')

@section('body')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">

                    @include('template.success')

                    <form method="POST" action="/login">

                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-md-right" for="email">E-mail</label>
                            <div class="col-md-7">
                                <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-md-right" for="password">Password</label>
                            <div class="col-md-7">
                                <input id="password" type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <input type="submit" value="Login" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection