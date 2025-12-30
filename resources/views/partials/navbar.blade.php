<nav class="navbar">
    <div class="nav-flex">

        <a href="/" class="brand">
            <img src="{{ asset('images/logo papua selatan png.png') }}" alt="Logo">
            <span>Sekretariat DPRP Papua Selatan</span>
        </a>

        <ul class="nav-menu">
            @foreach ($menus as $menu)
                <li class="dropdown">
                    <a href="#">{{ $menu->name }}</a>

                    <ul class="dropdown-menu">
                        @foreach ($menu->items as $item)
                            <li>
                                <a href="{{ url($item->slug) }}">
                                    {{ $item->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>

    </div>
</nav>
