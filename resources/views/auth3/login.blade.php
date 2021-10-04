@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg mt-4">
            @if(session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

            <div class="row mt-0">
                <div class="offset-3 col-md-10">
                    <span><img style="height: 120px;" class="img-circle img-fluid mt-0" src="{{ asset('/imgs/mmust-logo.png')}}" alt=""></span>
                </div>
            </div>

             <div class="row mt-1">
                <div class="offset-3 col-md-10">
                    <span>
                        <h2 class="text-capitalize font-weight-bold">SCI HUB PORTAL - Login</h2>
                    </span>
                </div>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4 mt-2">
                    <label for="regno" class="sr-only">regno</label>
                    <input type="regno" name="regno" id="regno" placeholder="Your Admission Number" class="bg-gray-100 border-2 w-full p-3 rounded-lg @error('regno') border-red-500 @enderror" value="{{ old('regno') }}">

                    @error('regno')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-100 border-2 w-full p-3 rounded-lg @error('password') border-red-500 @enderror" value="{{ old('password') }}">

                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember" >Remember me</label>
                    </div>
                </div>
                
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
 