@extends('layout.app')

@section('contents')
    <main class="container my-5">

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-12">
                <h2>My Account</h2>
            </div>
        </div>
        <hr>

        <div class="row">
            <!-- Left column: User details form -->
            <div class="col-lg-8">
                <!-- Avatar and user info -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        <div class="avatar-container">
                            <img
                                src="{{ Auth::user()->profile_photo_url ?? asset('storage/icons/avatar.jpg') }}"
                                alt="Avatar"
                                class="avatar-img rounded-circle"
                            >
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h5 class="mb-1">
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        </h5>
                        <p class="mb-1">{{ Auth::user()->email }}</p>
                        <p class="mb-1">{{ Auth::user()->phone ?? '—' }}</p>
                    </div>
                </div>

                <h4 class="mb-3">Update Your Details</h4>

                <form method="POST" action="{{ route('account.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input
                                type="text"
                                class="form-control @error('first_name') is-invalid @enderror"
                                id="firstName"
                                name="first_name"
                                value="{{ old('first_name', Auth::user()->first_name) }}"
                                required
                            >
                            @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input
                                type="text"
                                class="form-control @error('last_name') is-invalid @enderror"
                                id="lastName"
                                name="last_name"
                                value="{{ old('last_name', Auth::user()->last_name) }}"
                                required
                            >
                            @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input
                                type="tel"
                                class="form-control @error('phone') is-invalid @enderror"
                                id="phoneNumber"
                                name="phone"
                                value="{{ old('phone', Auth::user()->phone) }}"
                            >
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                            >
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="confirmPassword"
                                name="password_confirmation"
                            >
                        </div>
                    </div>

                    <div class="mt-4 d-flex">
                        <a href="{{ route('home') }}" class="btn btn-secondary me-3">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Log out
                    </button>
                </form>
            </div>

            <!-- Right column: Account summary -->
            <div class="col-lg-4">
                <div class="border p-4">
                    <h4 class="mb-3">Account Summary</h4>
                    <div class="mb-2 d-flex justify-content-between">
                        <span>Orders Placed</span>
                        <span>{{ Auth::user()->orders()->count() }}</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span>Wishlist Items</span>
                        <span>{{ Auth::user()->wishlist_items_count ?? 0 }}</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span>Membership Level</span>
                        <span>{{ Auth::user()->membership_level ?? 'Standard' }}</span>
                    </div>
                    <hr>
                    <p class="fw-bold mb-1">Recent Orders:</p>
                    <ul class="list-unstyled">
                        @foreach(Auth::user()->orders()->latest()->take(3)->get() as $order)
                            <li>
                                Order #{{ $order->id }} –
                                <span class="text-{{ $order->status_class }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection

