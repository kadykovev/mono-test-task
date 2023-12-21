<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Главная</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('clients.index') ? 'active' : '' }}" href="{{ route('clients.index') }}">Все клиенты</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('clients.create') ? 'active' : '' }}" href="{{ route('clients.create') }}">Новый клиент</a>
  </li>
</ul>
