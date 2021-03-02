<header>
    <a href="#" class="hamburger"><span></span></a>
    <div class="link-wrap">
        <a href="{{ route('days.all') }}" class="btn-custom btn-blue-inverse"><i class="fas fa-calendar-day"></i>Prikaži sve dane</a>
        <a href="{{ route('days.create') }}" class="btn-custom btn-blue-inverse"><i class="fas fa-plus-circle"></i>Unesi podatke za danas</a>
    </div>
</header>

<div class="nav-wrap">
    <a href="#" class="exit"></a>
    <nav>
        <ul>
            <li><a href="{{ route('index') }}"><i class="fas fa-home"></i>Početna</a></li>
            <li><a href="#"><i class="fas fa-cloud-moon"></i>Sleep info</a></li>
            <li><a href="#"><i class="fas fa-utensils"></i>Meal info</a></li>
            <li><a href="#"><i class="fas fa-dumbbell"></i>Activity info</a></li>
            <li><a href="#"><i class="fas fa-user-cog"></i>User settings</a></li>
            <li>
                <a href="{{ route('reports.weekly') }}" class="btn-custom btn-blue-inverse"><i class="far fa-envelope"></i>Izveštaj za prethodnih 7 dana</a>
                <a href="{{ route('reports.monthly') }}" class="btn-custom btn-blue-inverse"><i class="far fa-envelope"></i>Izveštaj za poslednjih 30 dana</a>
                <a href="{{ route('reports.quarterly') }}" class="btn-custom btn-blue-inverse"><i class="far fa-envelope"></i>Izveštaj za poslednjih 90 dana</a>
            </li>
        </ul>
    </nav>
</div>
