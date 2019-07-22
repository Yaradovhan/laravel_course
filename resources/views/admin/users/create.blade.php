@extends('semantic.layouts.app')

@section('content')
    @include('admin.users._nav')

    <form class="ui form" action="{{route('admin.users.store')}}" method="post">
        @csrf

        <div class="field">
            <label for="name" class="col-form-label">Name</label>
            <input type="text" id="name" class="form-control{{$errors->has('name') ? ' is-invalid' : ''}}" name="name" value="{{old('name')}}" required>
            @if($errors->has('name'))
                <span class="invalid-feedback"><strong>{{$errors->first('name')}}</strong></span>
            @endif
        </div>

        <div class="field">
            <label for="email" class="col-form-label">E-Mail Address</label>
            <input type="email" id="email" class="form-control{{$errors->has('email') ? ' is-invalid' : ''}}" name="email" value="{{old('email')}}" required>
            @if($errors->has('email'))
                <span class="invalid-feedback"><strong>{{$errors->first('email')}}</strong></span>
            @endif
        </div>

        <div class="field">
            <button type="submit" class="ui primary button">Save</button>
        </div>
    </form>
@endsection
