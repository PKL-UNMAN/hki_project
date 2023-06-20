<ul>
    @guest
        <li><a class="getstarted scrollto" href="{{ url('/auth') }}">Masuk</a></li>
    @endguest
    @auth
        <li><a class="nav-link scrollto " href="{{ url('dashboard') }}">Beranda</a></li>

        @if (Auth::user()->role_id == '3')
            <li><a class="nav-link scrollto" href="{{ route('supplier.po.index') }}">Purchase Order</a></li>
            <li><a class="nav-link scrollto" href="{{ route('supplier.surat.index') }}">Surat Jalan</a></li>
        @endif

        @if (Auth::user()->role_id == '2')
            <li><a class="nav-link scrollto" href="{{ route('subcon.po.index') }}">Purchase Order</a></li>
            <li><a class="nav-link scrollto" href="{{ route('subcon.surat.index') }}">Surat Jalan</a></li>
        @endif
        @if (Auth::user()->role_id == '1')
            <li><a class="nav-link scrollto" href="{{ route('hki.surat.index') }}">Surat Jalan</a></li>
            <li class="dropdown"><a href="#"><span>Purchase Order</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a href="{{ route('hki.po.supplier.index') }}">Supplier</a></li>
                    <li><a href="{{ route('hki.po.subcon.index') }}">Subcon</a></li>
                </ul>
            </li>
            <li><a class="nav-link scrollto" href="{{ route('hki.user.index') }}">Manage User</a></li>
        @endif
        <li class="dropdownx"><a class="getstarted scrollto" href="#">{{ Auth::user()->username }}<i
                    class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#"></a></li>
                <li><a href="{{ url('user/profile/' . Auth::user()->id) }}">Profil</a></li>
                <li>
                    <a class="dropdown-item" href="{{ route('user.logout') }}"
                        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                        {{ __('Keluar') }}
                    </a>
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST">
                        @csrf
                    </form>

            </ul>
        </li>
    @endauth
</ul>
<i class="bi bi-list mobile-nav-toggle"></i>
