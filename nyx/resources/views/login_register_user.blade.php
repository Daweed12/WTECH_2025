@extends('layout.app')

@section('contents')
    <!-- Sign In / Register Section -->
    <section class="account-section container">
        <h1>Account</h1>
        <hr/>
        <div class="row">
            <!-- Sign In Form -->
            <div class="col-md-6 form-divider">
                <h2>Sign In</h2>

                <!-- Display session status -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <label for="email_s">Email Address*</label>
                    <input type="email" id="email_s" name="email" placeholder="E-mail" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="pwd_s">Password*</label>
                    <input type="password" id="pwd_s" name="password" placeholder="Password" required>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="btn-custom">Sign In</button>
                </form>
            </div>

            <!-- Registration Form -->
            <div class="col-md-6 form-divider">
                <h2>Create Account</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <label for="name">Name*</label>
                    <input type="text" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="email_c">Email Address*</label>
                    <input type="email" id="email_c" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="pwd_c">Password*</label>
                    <input type="password" id="pwd_c" name="password" placeholder="Password" required>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="pwd_confirm">Confirm Password*</label>
                    <input type="password" id="pwd_confirm" name="password_confirmation" placeholder="Confirm Password" required>

                    <button type="submit" class="btn-custom">Create Account</button>
                </form>
            </div>
        </div>
    </section>
@endsection
