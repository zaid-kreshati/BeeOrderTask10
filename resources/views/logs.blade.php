@extends('layouts.BeeOrder_header')

@section('content')
    <table>
        <thead >
            <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Model_id</th>
                <th>Action</th>
                <th>Old_Model</th>
                <th>New_Model</th>
                <th>Deleted_Model</th>
                <th>action_by</th>
                <th>Created_Time</th>
                <th>Updated_Time</th>
                <th>Deleted_Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td style="text-align: left ;">{{ $log->model }}</td>
                    <td>{{ $log->model_id }}</td>
                    <td>{{ $log->action }}</td>
                    <td style="text-align: left ;">{!! displayModelData(json_decode($log->old_model, true)) !!}</td>
                    <td style="text-align: left ;">{!! displayModelData(json_decode($log->new_model, true)) !!}</td>
                    <td style="text-align: left ;">{!! displayModelData(json_decode($log->deleted_model, true)) !!}</td>
                    <td>{{ $log->action_by }}</td>
                    <td>{{ $log->createdTime }}</td>
                    <td>{{ $log->updatedTime }}</td>
                    <td>{{ $log->deletedTime }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

{{-- Add the helper function directly in the Blade view --}}
@php
function displayModelData($data) {
    if (!$data) return '';

    $output = '<ul>';
    foreach ($data as $key => $value) {
        if ($key === 'color') {
            $output .= '<li>' . ucfirst($key).': <span class="color-box" style="background-color: ' . htmlspecialchars($value) . ';"></span> ' . '</li>';
        } else {
            $output .= '<li>' . ucfirst($key).': ' . htmlspecialchars($value) . '</li>';
        }
    }
    $output .= '</ul>';
    return $output;
}
@endphp

@endsection
