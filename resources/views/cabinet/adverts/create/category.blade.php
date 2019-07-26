@extends('semantic.layouts.app')

@section('content')
    @include('cabinet.adverts._nav')

    <p>Choose category:</p>
    <div class="ui bulleted list">
        @include('cabinet.adverts.create._categories', ['categories' => $categories])
    </div>
@endsection
