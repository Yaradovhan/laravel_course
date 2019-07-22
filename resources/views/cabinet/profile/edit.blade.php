@extends('semantic.layouts.app')

@section('content')
    @include('cabinet.profile._nav')
    <form class="ui form" method="POST" action="{{ route('cabinet.profile.update') }}">
        @csrf
        @method('PUT')
        <div class="fields">
            <div class="field">
                <label for="name">First name</label>
                <input id="name" type="text" name="name" placeholder="First Name" value="{{ old('name', $user->name) }}"
                       required>
            </div>
            <div class="field">
                <label for="last_name">Last name</label>
                <input id="last_name" type="text" name="last_name" placeholder="Last Name"
                       value="{{ old('last_name', $user->last_name) }}" required>
            </div>
            <div class="field {{$errors->has('phone') ? 'error' : ''}}">
                <label for="phone">Phone</label>
                <input id="phone" type="tel" name="phone" placeholder="Phone" value="{{ old('phone', $user->phone) }}"
                       required>
            </div>
        </div>
        <div class="field disabled">
            <label>Update your photo</label>
            <input type="file" name="avatar">
        </div>

        <button class="ui blue basic button" type="submit">Submit</button>
    </form>
@endsection
