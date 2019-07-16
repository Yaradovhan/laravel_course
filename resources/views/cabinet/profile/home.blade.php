{{--@extends('layouts.app')--}}
@extends('semantic.layouts.app')


@section('content')
    @include('cabinet.profile._nav')

    <div class="mb-3">
        <a href="{{ route('cabinet.profile.edit') }}" class="ui green button">Edit</a>
    </div>

    <div class="ui card">
        <div class="image">
            <img src="/images/avatar2/large/kristy.png">
        </div>
        <div class="content">
            <a class="header">{{$user->name}}</a>
            <a class="header">{{$user->last_name}}</a>
            <div class="meta">
                <span class="date">Joined in 2013</span>
            </div>
            <div class="description">
                Kristy is an art director living in New York.
            </div>
        </div>
        <div class="extra content">
            <a>
                <i class="user icon"></i>
                22 Friends
            </a>
        </div>
    </div>

    <table class="ui celled table">
        <tbody>
        <tr>
            <th>First name</th>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <th>Last name</th>
            <td>{{$user->last_name}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{$user->email}}</td>
        </tr>
{{--        <tr>--}}
{{--            <th>Phone</th>--}}
{{--            <td>--}}
{{--                @if($user->phone)--}}
{{--                    {{$user->phone}}--}}
{{--                    @if(!$user->isPhoneVerified())--}}
{{--                        <i>(is not verified)</i><br/>--}}
{{--                        <form action="{{route('cabinet.profile.phone')}}" method="post">--}}
{{--                            @csrf--}}
{{--                            <button type="submit" class="btn btn-success btn-success">Verify</button>--}}
{{--                        </form>--}}
{{--                    @endif--}}
{{--                @endif--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        @if($user->phone)--}}
{{--            <tr>--}}
{{--                <th>Two factor auth</th>--}}
{{--                <td>--}}
{{--                    <form action="{{route('cabinet.profile.phone.auth')}}" method="post">--}}
{{--                        @csrf--}}
{{--                        @if($user->isPhoneAuthEnabled())--}}
{{--                            <button class="btn btn-sm btn-success">On</button>--}}
{{--                        @else--}}
{{--                            <button class="btn btn-sm btn-danger">Off</button>--}}
{{--                        @endif--}}
{{--                    </form>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endif--}}
        </tbody>
    </table>
@endsection
