<!DOCTYPE html>
<html lang="en">
@extends('layouts.BeeOrder_header')
 <!-- Include Header Styles (If needed) -->
@section('content')

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('title', 'Task Management BeeOrder')


</head>
<body>

    <div class="image-container">
        <img src="/BeeOrder/img/beeOrder.png" alt="BeeOrder">
    </div>
    <div class="main-content">
        <h1>Home</h1>
        <div class="btn-group">
            <a href="{{ route('tasks.index') }}" class="btn">View All Tasks</a>
            <a href="{{ route('categories.index') }}" class="btn">View All Categories</a>
            <a href="{{ route('tasks.list', ['status' => 'all']) }}" class="btn">Tasks List</a>

        </div>

    </div>
    @endsection

</body>
</html>
