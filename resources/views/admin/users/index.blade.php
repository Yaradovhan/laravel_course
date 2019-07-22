@extends('semantic.layouts.app')

@section('content')
    @include('admin.users._nav')

    <div class="ui right floated small primary">
         <a href="{{ route('admin.users.create') }}" class="ui primary button"><i class="user icon"></i>Add User</a>
    </div>
    <p></p>

    <div class="ui card filter-user">
        <div class="content">
            <div class="ui sub header">Filter</div>
        </div>
        <div class="content">
            <form action="?" method="get" class="ui form">

                <div class="fields">
                    <div class="four wide field">
                        <input type="number" name="id" placeholder="ID">
                    </div>
                    <div class="six wide field">
                        <input type="text" name="name" placeholder="Name">
                    </div>
                    <div class="six wide field">
                        <input type="email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="fields">
                    <div class="five wide field">
                            <select id="status" name="status" class="ui fluid dropdown">
                                <option value="">Status</option>
                                @foreach ($statuses as $value => $label)
                                    <option
                                        value="{{ $value }}"{{ $value === request('status') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach;
                            </select>
                    </div>
                    <div class="five wide field">
                            <select id="role" name="role" class="ui fluid dropdown">
                                <option value="">Role</option>
                                @foreach ($roles as $value => $label)
                                    <option
                                        value="{{ $value }}"{{ $value === request('role') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach;
                            </select>
                    </div>
                    <div class="three wide field">
                        <button class="ui secondary basic button fluid" type="reset" name="clear">Clear</button>
                    </div>
                    <div class="three wide field">
                        <button class="ui primary basic button fluid" type="submit" name="search">Search</button>
                    </div>
                </div>

            </form>
        </div>
    </div>



{{--    <div class="card mb-3">--}}
{{--        <div class="card-header">Filter</div>--}}
{{--        <div class="card-body">--}}
{{--            <form action="?" method="GET">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-1">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="id" class="col-form-label">ID</label>--}}
{{--                            <input id="id" class="form-control" name="id" value="{{ request('id') }}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="name" class="col-form-label">Name</label>--}}
{{--                            <input id="name" class="form-control" name="name" value="{{ request('name') }}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-3">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="email" class="col-form-label">Email</label>--}}
{{--                            <input id="email" class="form-control" name="email" value="{{ request('email') }}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="status" class="col-form-label">Status</label>--}}
{{--                            <select id="status" class="form-control" name="status">--}}
{{--                                <option value=""></option>--}}
{{--                                @foreach ($statuses as $value => $label)--}}
{{--                                    <option--}}
{{--                                        value="{{ $value }}"{{ $value === request('status') ? ' selected' : '' }}>{{ $label }}</option>--}}
{{--                                @endforeach;--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="role" class="col-form-label">Role</label>--}}
{{--                            <select id="role" class="form-control" name="role">--}}
{{--                                <option value=""></option>--}}
{{--                                @foreach ($roles as $value => $label)--}}
{{--                                    <option--}}
{{--                                        value="{{ $value }}"{{ $value === request('role') ? ' selected' : '' }}>{{ $label }}</option>--}}
{{--                                @endforeach;--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="col-form-label">&nbsp;</label><br/>--}}
{{--                            <button type="submit" class="btn btn-primary">Search</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}


    <table class="ui striped table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
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
                <td>
                    @if($user->isAdmin())
                        <span class="badge badge-danger">Admin</span>
                    @elseif ($user->isModerator())
                        <span class="badge badge-secondary">Moderator</span>
                    @else
                        <span class="badge badge-secondary">User</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$users->links()}}
@endsection
