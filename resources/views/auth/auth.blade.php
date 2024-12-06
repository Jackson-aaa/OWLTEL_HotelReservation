@extends('layouts.main')
@section('title', 'Authentication Page')

@section('cssStyles')
<link rel="stylesheet" href="{{asset('css/auth/auth.css')}}">
@endsection

@section('jsScripts')
<script src="{{asset('js/auth.js')}}"></script>
@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastBody = document.querySelector('#validationToast .toast-body');
            toastBody.innerHTML = `
                <ul style="margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `;
            const toastElement = new bootstrap.Toast(document.getElementById('validationToast'));
            toastElement.show();
        });
    </script>
@endif
@endsection

@section('content')

<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999 !important;">
  <div id="validationToast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
      </div>
    </div>
  </div>
</div>

<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form action="{{ route('login') }}" method="POST">
        @csrf
            <h1>OWLTEL</h1>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Type your email here..." value="{{ old('email') }}"  required/>
            </div>
            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Type your password here..." required/>
            </div>
            <button type="submit">Login</button>
            <span>Don't have an account? <span class="overlay-button" id="signUp">Register Here</span></span>
            <!-- <a href="#">Forgot your password?</a> -->
        </form>
    </div>
    <div class="form-container sign-up-container">
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <h1 id="form-register-title">OWLTEL</h1>
            <div class="form-name-input">
                <div class="form-input">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" placeholder="Type your first name here..." value="{{ old('first_name') }}"  required/>
                </div>
                <div class="form-input">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" placeholder="Type your last name here..." value="{{ old('last_name') }}"  required/>
                </div>
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Type your email here..." value="{{ old('email') }}"  required/>
            </div>
            <div class="form-input">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" placeholder="Type your phone number here..." value="{{ old('phone_number') }}"  required/>
            </div>
            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Type your password here..." required/>
            </div>
            <div class="form-input">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Type your password here..." required/>
            </div>
            <button id="form-register-button">Sign Up</button>
            <span>Already have an account? <span class="overlay-button" id="signIn">Login Here</span></span>
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <img src="{{ asset('img/register.png') }}" alt="My Image">
            </div>
            <div class="overlay-panel overlay-left">
                <img src="{{ asset('img/login.png') }}" alt="My Image">
            </div>
        </div>
    </div>
</div>
@endsection