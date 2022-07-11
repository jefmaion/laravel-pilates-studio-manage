<li class="breadcrumb-item {{ $active }}" aria-current="page">
    @if($href) <a href="{{ $href }}">{{ $label }}</a> @else {{ $label }} @endif
</li>