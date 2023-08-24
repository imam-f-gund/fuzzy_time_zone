<aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="/dashboard" class="logo-wrapper text-center" title="Home">
                <span class="sr-only text--50">Home</span>
                <h5>Prediksi Pendapatan Kaos</h5>
                {{-- <img src="{{ asset('img/logo.png') }}" alt="Logo" class="icon-logo" /> --}}

            </a>
            {{-- <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button> --}}
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a href="{{ url('dashboard') }}"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
                <li>
                    <a href="{{ url('pendapatan') }}"><span class="icon fa-solid fa-file-pen fa-xl"
                            aria-hidden="true"></span>Pendapatan</a>
                </li>
                <li>
                    <a href="{{ url('cek-pendapatan') }}"><span class="icon fa-solid fa-ranking-star fa-xl"
                            aria-hidden="true"></span>Cek Pendapatan</a>
                </li>
            </ul>
            {{-- <span class="system-menu__title">system</span> --}}
        </div>
    </div>
</aside>
