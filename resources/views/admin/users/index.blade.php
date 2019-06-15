@extends('layouts.app')

@section('content')
    @include('admin.users._nav')

    <table class="table table-border->table-stripped">
        <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Status</td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td><a href="{{route('admin.users.show', $user)}}">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>
                    @if($user->isWait())
                        <span class="badge badge-secondary">Waiting</span>
                    @endif
                    @if($user->isActive())
                            <span class="badge badge-primary">Active</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$users->links()}}
@endsection
