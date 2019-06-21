@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a href="{{route('cabinet.home')}}"></a>Dashboard</li>
        <li class="nav-item"><a href="{{route('cabinet.profile.home')}}"></a>Profile</li>
    </ul>
@endsection
