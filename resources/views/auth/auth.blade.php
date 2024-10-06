@extends('layouts.main')
@section('title', 'Authentication Page')

@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/auth.css')}}">
@endsection

@section('jsScripts')
<script src="{{asset('js/auth.js')}}"></script>
@endsection

@section('content')
<div class="container right-panel-active" id="container">
    <div class="form-container sign-in-container">
        <form action="{{ route('login') }}" method="POST">
        @csrf
            <h1>OWLTEL</h1>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Type your email here..." />
            </div>
            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Type your password here..." />
            </div>
            <button type="submit">Login</button>
            <span>Don't have an account? <span class="overlay-button" id="signUp">Register Here</span></span>
            <a href="#">Forgot your password?</a>
        </form>
    </div>
    <div class="form-container sign-up-container">
        <form action="{{ route('register') }}" method="POST">
        @csrf
            <h1>OWLTEL</h1>
            <div class="form-name-input">
                <div class="form-input">
                    <label for="first_name">Name</label>
                    <input type="text" name="first_name" placeholder="Type your first name here..." />
                </div>
                <div class="form-input">
                    <label for="last_name">Name</label>
                    <input type="text" name="last_name" placeholder="Type your last name here..." />
                </div>
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Type your email here..." />
            </div>
            <div class="form-input">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" placeholder="Type your phone number here..." />
            </div>
            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Type your password here..." />
            </div>
            <div class="form-input">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Type your password here..." />
            </div>
            <button>Sign Up</button>
            <span>Already have an account? <span class="overlay-button" id="signIn">Login Here</span></span>
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <!-- Image -->
            </div>
            <div class="overlay-panel overlay-left">
                <!-- Image -->
            </div>
        </div>
    </div>
</div>
@endsection