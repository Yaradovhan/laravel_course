{{--@extends('layouts.app')--}}
@extends('semantic.layouts.app')

@section('breadcrumbs', '')

@section('content')
    <p><a href="{{route('cabinet.adverts.create')}}" class="btn btn-success">Add advert</a></p>

    <div class="card card-default mb-3">
        <div class="card-header">
            All Categories
        </div>
        <div class="card-body pb-0">
            <div class="row">
                @foreach(array_chunk($categories, 3) as $chunk)
                    <div class="col-mb-3">
                        <ul class="list">
                            @foreach($chunk as $current)
                                <li><a href="{{route('cabinet.adverts.index', [null, $current])}}">{{$current->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card card-default mb-3">
        <div class="card-header">
            All Regions
        </div>
        <div class="card-body pb-0">
            <div class="row">
                @foreach(array_chunk($regions, 3) as $chunk)
                    <div class="col-mb-3">
                        <ul class="list">
                            @foreach($chunk as $current)
                                <li><a href="{{route('cabinet.adverts.index', [$current])}}">{{$current->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
