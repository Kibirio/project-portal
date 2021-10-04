@extends('layouts.app')

@section('content')
<section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/img3.jpg" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-2 pb-2 pb-md-0 mb-md-5 px-md-2 text-center">Create Account</h3>

            <form class="px-md-2" method="post" action="{{ route('student.registerStudent') }}">
				@csrf
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline datepicker">
                    <input
                      type="text"
                      class="form-control"
                      id="exampleDatepicker1"
                    />
                    <label for="exampleDatepicker1" class="form-label">First Name</label>
                  </div>

                </div>
				<div class="col-md-6 mb-4">
					<div class="form-outline datepicker">
					<input
						type="text"
						class="form-control"
						id="exampleDatepicker1"
					/>
					<label for="exampleDatepicker1" class="form-label">Last Name</label>
					</div>
				</div>
            </div>

			<div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline datepicker">
                    <input
                      type="text"
                      class="form-control"
                      id="exampleDatepicker1"
                    />
                    <label for="exampleDatepicker1" class="form-label">School/Faculty</label>
                  </div>

                </div>
				<div class="col-md-6 mb-4">
					<select class="custom-select">
						<option selected>Select Department</option>
						<option value="1">Computer Science</option>
						<option value="2">Information Technology</option>
						<option value="3">SIK</option>
						<option value="3">ETS</option>
					</select>
                </div>
            </div>
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="form3Example1w" class="form-control" />
                    <label class="form-label" for="form3Example1w">Reg Number</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="email" id="form3Example1w" class="form-control" />
                    <label class="form-label" for="form3Example1w">Email</label>
                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="password" id="form3Example1w" class="form-control" />
                    <label class="form-label" for="form3Example1w">Password</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="password" id="form3Example1w" class="form-control" />
                    <label class="form-label" for="form3Example1w">Confirm Password</label>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-success btn-lg btn-block mb-1">Submit</button>
			  </div>
            </form>

          </div>
        </div>
      </div>
    </div>
</section>
@endsection
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>