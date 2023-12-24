<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Главная</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('cars.index') ? 'active' : '' }}" aria-current="page" href="{{ route('cars.index') }}">Автомобили на стоянке</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ (request()->routeIs('clients.index') || request()->routeIs('clients.edit')) ? 'active' : '' }}" href="{{ route('clients.index') }}">Клиенты</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('clients.create') ? 'active' : '' }}" href="{{ route('clients.create') }}">Добавить клиента</a>
  </li>
</ul>
