@extends('customer.main')
@section('content')
    <div class="col-sm-9">
        <div class='row'>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Register an account</b>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" value="{{ old('name') }}" required name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        aria-describedby="name">
                                    @error('name')
                                        <span class="invalid-feedback" role='alert'>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" value="{{ old('email') }}" required name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        aria-describedby="email">
                                    @error('email')
                                        <span class="invalid-feedback" role='alert'>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">

                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" required
                                        class="form-control @error('password') is-invalid @enderror" id="password">
                                    @error('password')
                                        <span class="invalid-feedback" role='alert'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password2" class="form-label">Confirm Password</label>
                                    <input type="password" required name="password_confirmation" class="form-control"
                                        id="password2">

                                </div>

                                <div class="col-md-6">

                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" required
                                        class="form-control @error('phone') is-invalid @enderror" id="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" role='alert'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea required name="address"
                                        class="form-control @error('address') is-invalid @enderror" id="address">
                                                                                                                        {{ old('address') }}
                                                                                                                    </textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role='alert'>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
