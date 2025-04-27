@extends('layout.app')

@section('contents')
    <h1>Account Details</h1>
    <p><strong>First Name:</strong> {{ Auth::user()->first_name }}</p>
    <p><strong>Last Name:</strong>  {{ Auth::user()->last_name }}</p>
    <p><strong>Email:</strong>      {{ Auth::user()->email }}</p>
    <p><strong>Phone:</strong>      {{ Auth::user()->phone ?? '—' }}</p>
    <!-- add more fields or “Edit” button here -->
@endsection
