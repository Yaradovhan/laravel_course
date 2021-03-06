@extends('layouts.app')

@section('content')
    <form action="{{route('login.phone')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="token" class="col-form-label">SMS Code</label>
            <input class="form-control{{$errors->has('token') ? 'is-invalid' : ''}}" name="token" id="token"
                   value="{{old('token')}}" required>
            @if($errors->has('token'))
                <span class="invalid-feedback"><strong>{{$errors->first('token')}}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Verify</button>
        </div>
    </form>
@endsection
