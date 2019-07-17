{{--@if (session('status'))--}}
{{--<div class="alert alert-success" role="alert">--}}
{{--    {{ session('status') }}--}}
{{--</div>--}}
{{--@endif--}}

{{--@if (session('success'))--}}
{{--    <div class="alert alert-success" role="alert">--}}
{{--        {{ session('success') }}--}}
{{--    </div>--}}
{{--@endif--}}

{{--@if (session('error'))--}}
{{--    <div class="alert alert-danger" role="alert">--}}
{{--        {{ session('error') }}--}}
{{--    </div>--}}
{{--@endif--}}

{{--@if (session('info'))--}}
{{--    <div class="alert alert-info" role="alert">--}}
{{--        {{ session('info') }}--}}
{{--    </div>--}}
{{--@endif--}}
@if (session('status'))
    <div class="ui green message">
        {{ session('status') }}
    </div>
@endif

@if (session('success'))
    <div class="ui green message">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="ui red message">
        <h4>{{$errors->first()}}</h4>
    </div>
@endif

@if (session('error'))
    <div class="ui red message">
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div class="ui yellow message">
        {{ session('info') }}
    </div>
@endif
