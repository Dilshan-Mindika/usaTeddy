@props(['route', 'title', 'bi_icon' => null, 'active' => false])


<!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
<li class="nav-item">
    <a href="{{ route($route) }}" class="nav-link {{ request()->routeIs($route) || $active ? 'active' : '' }}">
        @if ($bi_icon)
            <i class="nav-icon bi {{ $bi_icon }}"></i>
        @endif
        <p>
            {{ $title }}
        </p>
    </a>
</li>
