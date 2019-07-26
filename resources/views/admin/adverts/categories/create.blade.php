@extends('semantic.layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')

    <form class="ui form" method="POST" action="{{ route('admin.adverts.categories.store') }}">
        @csrf

        <div class="field">
            <label for="name">Name</label>
            <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="field">
            <label for="slug">Slug</label>
            <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" value="{{ old('slug') }}" required>
            @if ($errors->has('slug'))
                <span class="invalid-feedback"><strong>{{ $errors->first('slug') }}</strong></span>
            @endif
        </div>

        <div class="field">
            <label for="parent">Parent</label>
            <select class="ui selection dropdown" id="parent" name="parent">
                <option value=""></option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}"{{ $parent->id == old('parent') ? ' selected' : '' }}>
                        @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                        {{ $parent->name }}
                    </option>
                @endforeach;
            </select>
        </div>

        <div class="field">
            <button type="submit" class="ui primary button">Save</button>
        </div>
    </form>
@endsection
