@extends('layouts.app')

@section('content')
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="?" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="photos" class="col-form-label">Title</label>
            <input type="file" id="photos" class="form-control{{$errors->has('title') ? 'is-invalid' : ''}}"
                   name="photos" multiple required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </form>

@endsection
