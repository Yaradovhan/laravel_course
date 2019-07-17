<div class="ui tabular menu">
    <a class="item{{ $page === '' ? ' active' : '' }}" href="{{ route('admin.home') }}">Dashboard</a>
    @can ('manage-adverts')
        <a class="item{{ $page === 'adverts' ? ' active' : '' }}" href="{{ route('admin.adverts.adverts.index') }}">Adverts</a>
    @endcan
    @can ('manage-banners')
        <a class="item{{ $page === 'banners' ? ' active' : '' }}" href="{{ route('admin.banners.index') }}">Banners</a>
    @endcan
    @can ('manage-regions')
        <a class="item{{ $page === 'regions' ? ' active' : '' }}" href="{{ route('admin.regions.index') }}">Regions</a>
    @endcan
    @can ('manage-adverts-categories')
        <a class="item{{ $page === 'adverts_categories' ? ' active' : '' }}" href="{{ route('admin.adverts.categories.index') }}">Categories</a>
    @endcan
    @can ('manage-pages')
        <a class="item{{ $page === 'pages' ? ' active' : '' }}" href="{{ route('admin.pages.index') }}">Pages</a>
    @endcan
    @can ('manage-users')
        <a class="item{{ $page === 'users' ? ' active' : '' }}" href="{{ route('admin.users.index') }}">Users</a>
    @endcan
    @can ('manage-tickets')
        <a class="item{{ $page === 'tickets' ? ' active' : '' }}" href="{{ route('admin.tickets.index') }}">Tickets</a>
    @endcan
</div>
