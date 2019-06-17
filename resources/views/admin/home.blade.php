@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs md-3">
        <li class="nav-item"><a href="{{route('admin.home')}}" class="nav-link active">Dashboard</a></li>
        <li class="nav-item"><a href="{{route('admin.users.index')}}" class="nav-link">Users</a></li>
        <li class="nav-item"><a href="{{route('admin.regions.index')}}" class="nav-link">Region</a></li>
    </ul>
@endsection
