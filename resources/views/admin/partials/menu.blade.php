@php
    $r = \Route::current()->getAction();
    $route = (isset($r['as'])) ? $r['as'] : '';
@endphp



<li class="nav-item mT-30">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.dash') ? 'actived' : '' }}" href="{{ route(ADMIN . '.dash') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">{{__("app.Dashboard")}}</span>
    </a>
</li>



<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.clients') ? 'actived' : '' }}" href="{{ route(ADMIN . '.clients.index') }}">
        <span class="icon-holder">
            <i class="fa-solid fa-users"></i>
        </span>
        <span class="title">{{__("app.clients")}}</span>
    </a>
</li>


<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.processes') ? 'actived' : '' }}" href="{{ route(ADMIN . '.processes.index') }}">
        <span class="icon-holder">
          <i class="c-brown-500 ti-reload"></i>
        </span>
        <span class="title">{{__("app.actions")}}</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.stock') ? 'actived' : '' }}" href="{{ route(ADMIN . '.stock.index') }}">
        <span class="icon-holder">
          <i class="fa-solid fa-truck-ramp-box"></i>
        </span>
        <span class="title">{{__("app.Inventory")}}</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.expenses') ? 'actived' : '' }}" href="{{ route(ADMIN . '.expenses.index') }}">
        <span class="icon-holder">
          <i class="fa-solid fa-money"></i>
        </span>
        <span class="title">{{__("app.expenses")}}</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.advances') ? 'actived' : '' }}" href="{{ route(ADMIN . '.advances.index') }}">
        <span class="icon-holder">
          <i class="fa-solid fa-dollar"></i>
        </span>
        <span class="title">{{__("app.advances")}}</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.invoices') ? 'actived' : '' }}" href="{{ route(ADMIN . '.invoices.index') }}">
        <span class="icon-holder">
            <i class="far fa-file"></i>
        </span>
        <span class="title">{{__("app.invoices")}}</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.users') ? 'actived' : '' }}" href="{{ route(ADMIN . '.users.index') }}">
        <span class="icon-holder">
           <i class="fa-solid fa-users-gear"></i>
        </span>
        <span class="title">{{__("app.users")}}</span>
    </a>
</li>


<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.drivers') ? 'actived' : '' }}" href="{{ route(ADMIN . '.drivers.index') }}">
        <span class="icon-holder">
         <i class="fas fa-car"></i>
        </span>
        <span class="title">{{__("app.drivers")}}</span>
    </a>
</li>

<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.history') ? 'actived' : '' }}" href="{{ route(ADMIN . '.history.index') }}">
        <span class="icon-holder">
        <i class="fas fa-history"></i>
        </span>
        <span class="title">{{__("app.history")}}</span>
    </a>
</li>

<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.initialization') ? 'actived' : '' }}" href="{{ route(ADMIN . '.initialization.index') }}">
        <span class="icon-holder">
         <i class="fa-brands fa-font-awesome"></i>
        </span>
        <span class="title">{{__("app.initialization")}}</span>
    </a>
</li>


<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.setting') ? 'actived' : '' }}" href="{{ route(ADMIN . '.setting.index') }}">
        <span class="icon-holder">
           <i class="fa-solid fa-gear"></i>
        </span>
        <span class="title">{{__("app.setting")}}</span>
    </a>
</li>

