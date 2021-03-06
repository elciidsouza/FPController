<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="/home" class="simple-text logo-normal">
      FPController
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <!--<li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Laravel Examples') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>-->
        <li class="nav-item{{ $activePage == 'ganhos' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('ganhos') }}">
                <i class="material-icons">attach_money</i>
                <p>Ganhos</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'despesas' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('despesas') }}">
                <i class="material-icons">money_off</i>
                <p>Despesas</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'cartão' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('cartoes') }}">
                <i class="material-icons">credit_card</i>
                <p>Cartões</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'categorias' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('categorias') }}">
                <i class="material-icons">list</i>
                <p>Categorias</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'objetivos' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('objetivos') }}">
                <i class="material-icons">done_all</i>
                <p>Objetivos</p>
            </a>
        </li>
    </ul>
  </div>
</div>