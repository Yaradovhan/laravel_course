@extends('semantic.layouts.app')

@section('content')
    @include('admin.regions._nav')

    <p><a href="{{ route('admin.regions.create') }}" class="ui green button">Add Region</a></p>

    @include('admin.regions._list', ['regions' => $regions])
@endsection
