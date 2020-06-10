<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('/img/masp.jpg') }}">
    <div class="logo">
        <a href="{{ route('dashboard.index') }}" class="simple-text logo-normal">Patronos <span class="masp-logo">MASP</span></a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ url()->current() == route('dashboard.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('patrons.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('patrons.index') }}">
                    <p>Pessoa Física</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('patrons.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('patrons.create') }}">
                    <p>Adicionar Pessoa Física</p>
                </a>
            </li>
        </ul>
    </div>
</div>
