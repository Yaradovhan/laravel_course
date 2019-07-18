@extends('semantic.layouts.app')

@section('content')
    @include('admin.regions._nav')

    <form method="POST" class="ui form" action="{{ route('admin.regions.store', ['parent' => $parent ? $parent->id : null]) }}">
        @csrf

        <div class="field">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="field">
            <label for="slug" class="col-form-label">Slug</label>
            <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" value="{{ old('slug') }}" required>
            @if ($errors->has('slug'))
                <span class="invalid-feedback"><strong>{{ $errors->first('slug') }}</strong></span>
            @endif
        </div>

        <div class="field">
            <button type="submit" class="ui primary button">Save</button>
        </div>
    </form>
@endsection
