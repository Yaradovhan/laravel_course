@extends('semantic.layouts.app')

@section('content')
    <p>Choose category:</p>

    <div class="ui bulleted list">
        @include('cabinet.adverts.create._categories', ['categories'=> $categoies])
    </div>

@endsection
