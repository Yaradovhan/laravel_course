@if ($paginator->hasPages())
    <div class="ui pagination menu">
        @if ($paginator->onFirstPage())
            <div class="disabled item">
                <i class="small angle left icon"></i>
            </div>
        @else
            <a class="item" href="{{ $paginator->previousPageUrl() }}"><i class="small angle left icon"></i></a>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <a class="item disabled">{{ $element }}</a>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active item">{{ $page }}</a>
                    @else
                        <a class="item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <a class="item" href="{{ $paginator->nextPageUrl() }}"><i class="small angle right icon"></i></a>
        @else
                <a class="disabled item" href="{{ $paginator->nextPageUrl() }}"><i class="small angle right icon"></i></a>
        @endif
    </div>
@endif
