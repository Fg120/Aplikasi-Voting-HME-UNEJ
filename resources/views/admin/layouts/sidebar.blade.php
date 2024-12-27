<div class="main-sidebar sidebar-style-2 shadow">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('asset/logo-HME.png') }}" style="height: 30px">
                HME
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">HME</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('home.index') }}"><i class="fas fa-eye"></i><span>Public</span></a>
            </li>
            <li class="menu-header">Users</li>
            <li class="{{ request()->segment(2) == 'mahasiswa' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.mahasiswa.index') }}"><i class="fas fa-user-graduate"></i></i><span>Mahasiswa</span></a>
            </li>
            <li class="{{ request()->segment(2) == 'admin' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.admin.index') }}"><i class="fas fa-user-cog"></i></i><span>Admin</span></a>
            </li>
            <li class="menu-header">Voting</li>
            <li class="{{ request()->segment(2) == 'kandidat' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.kandidat.index') }}"><i class="fas fa-user-tie"></i><span>Kandidat</span></a>
            </li>
            <li class="{{ request()->segment(3) == 'monitor' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.voting.monitor') }}"><i class="fas fa-desktop"></i><span>Monitor</span></a>
            </li>
            <li class="{{ request()->segment(2) == 'export' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.export.index') }}"><i class="fas fa-file-export"></i><span>Export</span></a>
            </li>
            <li class="{{ request()->segment(2) == 'setting' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.setting.index') }}"><i class="fas fa-cog"></i><span>Setting</span></a>
            </li>
        </ul>
    </aside>
</div>
