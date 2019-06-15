@extends('layouts.app')

@section('content')
    @include('admin.users._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{route('admin.users.edit', $user)}}" class="btn btn-primary mr-1">Edit</a>
        <form action="{{route('admin.users.verify', $user->id)}}" method="post" class="mr-1">
            @csrf
            <button class="btn btn-success">Verify</button>
        </form>
        <form action="{{route('admin.users.update', $user)}}" method="post" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

    <table class="table table-border->table-stripped">
        <tbody>
            <tr>
                <th>ID</th><td>{{$user->id}}</td>
            </tr>
            <tr>
                <th>Name</th><td>{{$user->name}}</td>
            </tr>
            <tr>
                <th>Email</th><td>{{$user->email}}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if($user->isWait())
                        <span class="badge badge-secondary">Waiting</span>
                    @endif
                    @if($user->isActive())
                        <span class="badge badge-primary">Active</span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
@endsection
