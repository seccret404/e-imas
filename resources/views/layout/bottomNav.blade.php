<div class="appBottomMenu">
    <a href="/home" class="item {{ request()->is('home') ? 'active' : ''}}">
        <div class="col">
            <ion-icon name="home-outline" role="img" class="md hydrated"
                aria-label="file tray full outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="/histori" class="item {{ request()->is('histori') ? 'active' : ''}}">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated"
            aria-label="document text outline"></ion-icon>
            <strong>Histori</strong>
        </div>
    </a>
    <a href="/presensi/create" class="item {{ request()->is('/presensi/create') ? 'active' : ''}}">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="/presensi/izin" class="item {{ request()->is('presensi/izin') ? 'active' : ''}}">
        <div class="col">
            <ion-icon name="calendar-outline"></ion-icon>
            <strong>Izin</strong>
        </div>
    </a>
    <a href="/editprofile" class="item {{ request()->is('editprofile') ? 'active' : ''}}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
</div>
