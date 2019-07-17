{{--@extends('layouts.app')--}}
@extends('semantic.layouts.app')


@section('content')
    @include('cabinet.profile._nav')

    <div class="ui card">
        <div class="image">
            <img src="{{asset('/images/users_profile/user1/img1.png')}}">
        </div>
        <div class="content">
            <div class="header">
                {{$user->name}}
                {{$user->last_name}}</div>
            {{--<div class="description">--}}
            {{--Kristy is an art director living in New York.--}}
            {{--</div>--}}
        </div>
        <div class="extra content">
            <div class="meta">
                <i class="mail icon"></i>
                <span>{{$user->email}}</span>
            </div>
            @if($user->phone)
                <div class="meta">
                    <i class="phone icon"></i>
                    <span>{{$user->phone}}</span>
                    @if(!$user->isPhoneVerified())
                        <i>(is not verified)</i>
                        <form action="{{route('cabinet.profile.phone')}}" method="post">
                            @csrf
                            <button type="submit" class="mini ui orange button">Verify</button>
                        </form>
                    @endif
                </div>
            @endif
            <div class="ui toggle checkbox two_factor">
                <span>Two factor auth</span>
                <input type="checkbox" data-source="{{route('cabinet.profile.phone.auth')}}"  {{$user->isPhoneAuthEnabled() ? 'checked' : ''}}  >
            </div>
            <div class="extra content">
                 <span class="right floated">
                <a href="{{ route('cabinet.profile.edit') }}" class="circular ui icon button">
                    <i class="icon settings"></i>
                </a>
                </span>
            </div>
        </div>

    </div>
    <table class="ui definition table">
        <tbody>
        <tr>
            <td class="two wide column">Size</td>
            <td>1" x 2"</td>
        </tr>
        <tr>
            <td>Weight</td>
            <td>6 ounces</td>
        </tr>
        <tr>
            <td>Color</td>
            <td>Yellowish</td>
        </tr>
        <tr>
            <td>Odor</td>
            <td>Not Much Usually</td>
        </tr>
        </tbody>
    </table>

    {{--    <table class="ui celled table">--}}
    {{--        <tbody>--}}
    {{--        <tr>--}}
    {{--            <th>Phone</th>--}}
    {{--            <td>--}}
    {{--                @if($user->phone)--}}
    {{--                    {{$user->phone}}--}}
    {{--@if(!$user->isPhoneVerified())--}}
    {{--<i>(is not verified)</i><br/>--}}
    {{--<form action="{{route('cabinet.profile.phone')}}" method="post">--}}
    {{--@csrf--}}
    {{--<button type="submit" class="btn btn-success btn-success">Verify</button>--}}
    {{--</form>--}}
    {{--@endif--}}
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
    {{--        </tbody>--}}
@endsection
