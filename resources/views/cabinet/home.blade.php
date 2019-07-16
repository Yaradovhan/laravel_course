{{--@extends('layouts.app')--}}
@extends('semantic.layouts.app')


@section('content')
    <div class="ui top attached tabular menu">
        <a class="item active" data-tab="dashboard">Dashboard</a>
        <a class="item" data-tab="adverts">Adverts</a>
        <a class="item" data-tab="profile">Profile</a>
    </div>
    <div class="ui bottom attached tab segment active" data-tab="dashboard">
        <div class="ui three column stackable grid">
            <div class="column">
                <div class="ui raised segment">
                    <div class="ui placeholder">
                        <div class="image header">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <div class="paragraph">
                            <div class="medium line"></div>
                            <div class="short line"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="ui raised segment">
                    <div class="ui placeholder">
                        <div class="image header">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <div class="paragraph">
                            <div class="medium line"></div>
                            <div class="short line"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="ui raised segment">
                    <div class="ui placeholder">
                        <div class="image header">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <div class="paragraph">
                            <div class="medium line"></div>
                            <div class="short line"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui bottom attached tab segment" data-tab="adverts">
        Second
    </div>
    <div class="ui bottom attached tab segment" data-tab="profile">
        Third
    </div>
{{--    <ul class="nav nav-tabs mb-3">--}}
{{--        <li class="nav-item"><a class="nav-link active" href="{{ route('cabinet.home') }}">Dashboard</a></li>--}}
{{--        <li class="nav-item"><a class="nav-link" href="{{ route('cabinet.adverts.index') }}">Adverts</a></li>--}}
{{--        <li class="nav-item"><a class="nav-link" href="{{ route('cabinet.profile.home') }}">Profile</a></li>--}}
{{--    </ul>--}}


@endsection
