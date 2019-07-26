@extends('semantic.layouts.app')

@section('content')
    <form action="{{route('login.phone')}}" method="post" class="ui form">
        @csrf
        <div class="inline fields">
            <div class="field">
                <label for="token">SMS Code</label>
                <input  name="token" id="token" value="{{old('token')}}" required>
            </div>
            <div class="five wide field">
                <button type="submit" class="ui primary button">Verify</button>
            </div>
        </div>
    </form>
@endsection
