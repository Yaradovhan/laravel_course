@extends('semantic.layouts.app')

@section('content')
    @include('admin.users._nav')

    <div class="ui card">
        <div class="content">
            <img class="right floated mini ui image" src="{{asset('/images/users_profile/user1/img1.png')}}">
            <div class="header">
                {{$user->name}}
                {{$user->last_name}}
            </div>
            <div class="meta">
                <i class="id badge outline icon"></i>
                <span>{{$user->id}}</span>
            </div>
            <div class="meta">
                <i class="mail icon"></i>
                <span>{{$user->email}}</span>
            </div>
            <div class="meta meta-m-3">
                <i class="info icon"></i>
                Status
                @if($user->isWait())
                    <span class="ui orange horizontal label">Waiting</span>
                @endif
                @if($user->isActive())
                    <span class="ui teal horizontal label">Active</span>
                @endif
            </div>
            <div class="meta meta-m-3">
                <i class="info icon"></i>
                Role
                @if($user->isAdmin())
                    <span class="ui red horizontal basic label">Admin</span>
                @elseif($user->isModerator())
                    <span class="ui yellow horizontal basic label">Moderator</span>
                @else
                    <span class="ui teal horizontal basic label">User</span>
                @endif
            </div>
        </div>
        <div class="extra content">
            <div class="ui three buttons">

                @if ($user->isWait())
                    <button type="button" data-source="{{ route('admin.users.verify', $user) }}"
                            class="ui green basic button updateItem">Verify
                    </button>
                @endif
                    <button type="button" data-source="{{route('admin.users.edit', $user)}}"
                            class="ui blue basic button redirect">Edit
                    </button>
                    <button type="button" data-source="{{route('admin.users.update', $user)}}"
                            class="ui red basic button deleteItem">Delete
                    </button>
            </div>
        </div>
    </div>

@endsection
