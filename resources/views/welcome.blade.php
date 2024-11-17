
@extends('layouts.BeeOrder_header')
@section('title', 'welcome')

@section('content')


<body>
    <!-- Main Content -->
    <div class="container">
    <div class="logo">
            <img src="{{ asset('BeeOrder/img/beeOrder.png') }}" alt="Logo">
        </div>
        <h1>Welcome</h1>
        <h1>BeeOrder Task Management </h1>
        <div class="btn-group">
            <a href="{{ url('/register') }}" class="btn">Register</a>
            <a href="{{ url('/login') }}" class="btn">Login</a>
        </div>
    </div>

    <!-- Additional content if needed -->
    @endsection

</body>
