<nav class="navbar fixed-top navbar-light bg-light">
  <div class="container-fluid">
    <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas">
      <span class="navbar-toggler-icon"></span>
    </button>      
    <div>
      <img src="{{ url('/images/avatars/blank.png') }}" 
        alt="{{ Auth::user()->name }} - avatar" 
        width="32" height="32" class="rounded-circle">
      {{ Auth::user()->name }}
    </div> 
  </div>
</nav>


<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas">
  <div class="offcanvas-header">    
    <h5 class="fs-4">Password manager</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column ">
    <div class="p-2 border-top">  
    <ul class="list-unstyled">
      <li class="mb-1 ps-0">
        <x-menu-link :href="route('password.index')" :active="request()->routeIs('password.index')">
          Zarządzaj hasłami
        </x-menu-link>      
      </li>
    </ul>
    </div>


    <div class="mt-auto p-2 border-top">
      <ul class="nav nav-pills flex-column">
        <li>
          <x-menu-link :href="route('logout')">
            <i class="bi bi-box-arrow-right pe-2"></i>{{ __('Log out') }}
          </x-menu-link>
        </li>
      </ul>
    </div>   
  </div>
</div>

