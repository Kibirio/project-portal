@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">

        @if(session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

            <div class="row mt-0">
                <div class="offset-3 col-md-10">
                    <span><img style="height: 110px;" class="img-circle img-fluid mt-0" src="{{ asset('/imgs/mmust-logo.png')}}" alt=""></span>
                </div>
            </div>
            <div class="row mt-1">
                <div class="offset-2 col-md-10">
                    <span>
                        <h2 class="text-capitalize font-weight-bold">SCI HUB PORTAL - Admin Registration</h2>
                    </span>
                </div>
            </div>
            
            <form action="{{ route('root.register') }}" method="POST">
                @csrf
                <div class="mb-4 mt-2">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" name="name" id="name" placeholder="Your name" class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name') }}">

                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="regno" class="sr-only">Registration Number</label>
                    <input type="text" name="regno" id="regno" placeholder="Admin Id" class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('regno') border-red-500 @enderror" value="{{ old('regno') }}">

                    @error('regno')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- <div class="mb-4">
                    <label for="school" class="sr-only"></label>
                    <select name="school" id="school" class=" bg-gray-100 border-2 w-full p-2 rounded-lg @error('school') border-red-500 @enderror" value="{{ old('school') }}">
                        <option value="" selected disabled>Select School/Faculty</option>
                        <option value="SCI">SCI</option>
                    </select>

                    @error('school')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}

                {{-- <div class="mb-4">
                    <label for="regno" class="sr-only"></label>
                    <select name="department" id="department" class=" bg-gray-100 border-2 w-full p-2 rounded-lg @error('department') border-red-500 @enderror" value="{{ old('department') }}">
						<option value="" selected disabled>Select Department</option>
						<option value="Computer Science">Computer Science</option>
						<option value="Information Technology">Information Technology</option>
						<option value="SIK">SIK</option>
						<option value="ETS">ETS</option>
					</select>

                    @error('department')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" placeholder="Your Email Address" class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">

                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('password') border-red-500 @enderror" value="{{ old('password') }}">

                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_again" class="sr-only">Repeat Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your Password" 
                    class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('password_confirmation') border-red-500 @enderror" value="{{ old('password_confirmation') }}">

                    @error('password_confirmation')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-check-label mr-3" for="inlineRadio1">Select Gender</label>
                    <div class="form-check form-check-inline">
                       <input class="form-check-input @error('gender') border-red-500 @enderror" type="radio" name="gender" id="gender" value="Male" 
                         value="{{ old('password_confirmation') }}">
                       <label class="form-check-label " for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                       <input class="form-check-input @error('gender') border-red-500 @enderror" type="radio" name="gender" id="gender" value="Female">
                       <label class="form-check-label" for="inlineRadio1">Female</label>
                    </div>
                    @error('gender')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium w-full">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
 