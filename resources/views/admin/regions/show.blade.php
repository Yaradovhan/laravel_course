@extends('semantic.layouts.app')

@section('content')
    @include('admin.regions._nav')

    <div class="ui buttons">
        <a href="{{ route('admin.regions.edit', $region) }}" class="ui blue basic button">Edit</a>
        <form method="POST" action="{{ route('admin.regions.update', $region) }}">
            @csrf
            @method('DELETE')
            <button class="ui red basic button">Delete</button>
        </form>
    </div>
    <table class="ui collapsing table">
        <tbody>
        <tr>
            <td>ID</td><td>{{ $region->id }}</td>
        </tr>
        <tr>
            <td>Name</td><td>{{ $region->name }}</td>
        </tr>
        <tr>
            <td>Slug</td><td>{{ $region->slug }}</td>
        </tr>
        </tbody>
    </table>

    <p><a href="{{ route('admin.regions.create', ['parent' => $region->id]) }}" class="ui basic button">Add SubRegion</a></p>

    @include('admin.regions._list', ['regions' => $regions])
@endsection
