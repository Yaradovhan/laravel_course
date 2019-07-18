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
                {{$user->last_name}}
            </div>
        </div>
        <div class="extra content">
            <div class="meta meta-m-3">
                <i class="mail icon"></i>
                <span>{{$user->email}}</span>
            </div>
            @if($user->phone)
                <div class="meta meta-m-3">
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
            <div class="content">
                <span class="right floated">
                    <div class="ui toggle checkbox two_factor">
                        <input type="checkbox" data-source="{{route('cabinet.profile.phone.auth')}}"  {{$user->isPhoneAuthEnabled() ? 'checked' : ''}}  >
                    </div>
                </span>
                <i class="info icon"></i>Two factor auth
            </div>
            <br>
            <div class="content">
                <a href="{{ route('cabinet.profile.edit') }}" class="circular ui icon button">
                    <i class="icon settings"></i>
                </a>
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

@endsection
