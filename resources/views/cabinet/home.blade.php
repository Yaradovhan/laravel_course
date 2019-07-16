{{--@extends('layouts.app')--}}
@extends('semantic.layouts.app')


@section('content')
    <div class="ui tabular menu">
        <a class="item active" href="{{ route('cabinet.home') }}">Dashboard</a>
        <a class="item " href="{{ route('cabinet.adverts.index') }}">Adverts</a>
        <a class="item " href="{{ route('cabinet.profile.home') }}">Profile</a>
    </div>

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
@endsection
