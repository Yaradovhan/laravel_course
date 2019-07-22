@extends('semantic.layouts.app')

@section('breadcrumbs', '')

@section('content')
    <p><a href="{{route('cabinet.adverts.create')}}" class="ui green button">Add advert</a></p>

    <div class="ui segments">
        <div class="ui segment">
            All Categories
        </div>
        <div class="ui segment">
            <div class="ui grid">
                @foreach(array_chunk($categories, 3) as $chunk)
                    <div class="three wide column">
                        <ul class="ui list">
                            @foreach($chunk as $current)
                                <li>
                                    <a href="{{route('cabinet.adverts.index', [null, $current])}}">{{$current->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="ui segments">
        <div class="ui segment">
            All Regions
        </div>
        <div class="ui segment">
            <div class="ui grid">
                @foreach(array_chunk($regions, 3) as $chunk)
                    <div class="three wide column">
                        <ul class="ui list">
                            @foreach($chunk as $current)
                                <li>
                                    <a href="{{route('cabinet.adverts.index', [null, $current])}}">{{$current->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
