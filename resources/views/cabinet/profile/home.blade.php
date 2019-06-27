@extends('layouts.app')

@section('content')
    @include('cabinet.profile._nav')

    <div class="mb-3">
        <a href="{{route('cabinet.profile.edit')}}" class="btn btn-primary"></a>
    </div>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>First name</th><td>{{$user->name}}</td>
            </tr>
            <tr>
                <th>Last name</th><td>{{$user->last_name}}</td>
            </tr>
            <tr>
                <th>Email</th><td>{{$user->email}}</td>
            </tr>
        </tbody>
    </table>
@endsection
