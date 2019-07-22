@extends('semantic.layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')

    <p><a href="{{ route('admin.adverts.categories.create') }}" class="ui green button">Add Category</a></p>

    <table class="ui celled striped table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach ($categories as $category)
            <tr>
                <td>
                    @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                    <a href="{{ route('admin.adverts.categories.show', $category) }}">{{ $category->name }}</a>
                </td>
                <td>{{ $category->slug }}</td>
                <td>
                    <div class="ui grid centered">
                        <div class="row">
                            <form method="POST" action="{{ route('admin.adverts.categories.first', $category) }}" class="mr-1">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-double-up"></span></span></button>
                            </form>
                            <form method="POST" action="{{ route('admin.adverts.categories.up', $category) }}" class="mr-1">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-up"></span></button>
                            </form>
                            <form method="POST" action="{{ route('admin.adverts.categories.down', $category) }}" class="mr-1">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-down"></span></button>
                            </form>
                            <form method="POST" action="{{ route('admin.adverts.categories.last', $category) }}" class="mr-1">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-double-down"></span></span></button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
