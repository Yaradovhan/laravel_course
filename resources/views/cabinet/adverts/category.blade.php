@extends('semantic.layouts.app')

@section('content')
    <p>Choose category:</p>

    @include('cabinet.adverts.create._categories', ['categories'=> $categoies])
    
@endsection
