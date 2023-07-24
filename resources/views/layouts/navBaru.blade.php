<ul>
    @guest
        <li><a class="getstarted scrollto" href="{{ url('/auth') }}">Masuk</a></li>
    @endguest
    @auth
        <li><a class="nav-link scrollto {{Route::is('dashboard') ? 'active':''}}" href="{{ url('dashboard') }}">Beranda</a></li>
        {{-- supllier --}}
        @if (Auth::user()->role_id == '3')
            <li><a class="nav-link scrollto {{Route::is('supplier.po.index') ? 'active':''}}" href="{{ route('supplier.po.index') }}">Purchase Order</a></li>
            <li><a class="nav-link scrollto {{Route::is('supplier.surat.index') ? 'active':''}}" href="{{ route('supplier.surat.index') }}">Surat Jalan</a></li>
        @endif
        {{-- subcon --}}
        @if (Auth::user()->role_id == '2')
            <li><a class="nav-link scrollto {{Route::is('subcon.po.index') ? 'active':''}} " href="{{ route('subcon.po.index') }}">Purchase Order</a></li>
           
            <li class="dropdownx">
                <a href="#">Surat Jalan
                    <i class="bi bi-chevron-down">
                    </i>
                </a>
            <ul>
                <li><a class="nav-link scrollto {{Route::is('subcon.surat.index') ? 'active':''}}" href="{{ route('subcon.surat.index') }}">Surat HKI</a></li>
                <li><a class="{{Route::is('subcon.suratSup.index') ? 'active':''}}" href="{{ route('subcon.suratSup.index') }}">Surat Supplier</a></li>
                <li>
            </ul>
            <li><a class="nav-link scrollto {{Route::is('subcon.sisa.index') ? 'active':''}}" href="{{ route('subcon.sisa.index') }}">Monitoring Sisa</a></li>

        </li>

        @endif
        {{-- hki --}}
        @if (Auth::user()->role_id == '1')
        <li class="dropdown"><a href="#"><span>Data Master</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a class="{{Route::is('hki.user.index') ? 'active':''}}" href="{{ route('hki.user.index') }}">User</a></li>
                <li><a class="{{Route::is('hki.part.index') ? 'active':''}}" href="{{ route('hki.part.index') }}">Part</a></li>
            </ul>
        </li>
            <li class="dropdown"><a href="#"><span>Purchase Order</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a class="{{Route::is('hki.po.supplier.index') ? 'active':''}}" href="{{ route('hki.po.supplier.index') }}">Supplier</a></li>
                    <li><a class="{{Route::is('hki.po.subcon.index') ? 'active':''}}" href="{{ route('hki.po.subcon.index') }}">Subcon</a></li>
                </ul>
            </li>
            <li><a class="nav-link scrollto {{Route::is('hki.surat.index') ? 'active':''}}" href="{{ route('hki.surat.index') }}">Surat Jalan</a></li>
            <li><a class="nav-link scrollto {{Route::is('hki.sisabarang.index') ? 'active':''}}" href="{{ route('hki.sisabarang.index') }}">Sisa Barang</a></li>
            <li><a class="nav-link scrollto {{Route::is('hki.monitorsurat.index') ? 'active':''}}" href="{{ route('hki.monitorsurat.index') }}">Monitor Surat</a></li>
            <li><a class="nav-link scrollto {{Route::is('hki.production.index') ? 'active':''}}" href="{{ route('hki.production.index') }}">Production</a></li>
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
