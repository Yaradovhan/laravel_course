@extends('semantic.layouts.app')

@section('content')
    @include('cabinet.adverts._nav')

    <div class="region-selector" data-selected="{{ json_encode((array)old('regions')) }}" data-source="{{ route('ajax.regions') }}"></div>
@endsection
