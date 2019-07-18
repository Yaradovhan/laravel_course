@extends('semantic.layouts.app')

@section('content')
    @include('admin.users._nav')

    <form class="ui form" method="POST" action="{{ route('admin.users.update' , $user) }}">
        @csrf
        @method('PUT')
        <div class="fields">
            <div class="field {{$errors->has('name') ? ' error' : ''}}">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" placeholder="First Name" value="{{ old('name', $user->name) }}"
                       required>
            </div>
            <div class="field {{$errors->has('email') ? ' error' : ''}}">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" name="email" placeholder="Email"
                       value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="field {{$errors->has('role') ? ' error' : ''}}">
                <label for="role">Role</label>
                <select name="role" id="role" class="ui dropdown">
                    @foreach($roles as $value=>$label)
                        <option value="{{$value}}" {{$value === old('role', $user->role) ? 'selected' : ''}}>{{$label}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button class="ui primary button" type="submit">Update</button>
    </form>

@endsection
