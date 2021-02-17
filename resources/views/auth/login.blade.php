@extends('customer.main')
@section('content')
    <div class="col-sm-9">
        <div class='row'>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Login</b>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" value="{{ old('email') }}" required name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        aria-describedby="email">
                                    @error('email')
                                        <span class="invalid-feedback" role='alert'>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">

                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" required class="form-control" id=" password">
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
