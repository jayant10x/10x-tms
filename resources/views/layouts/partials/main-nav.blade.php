<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
        <a href="{{ route('dashboard')}}" class="logo-dark">
            <img src="/images/logo-sm.png" class="logo-sm" alt="logo sm">
            <img src="/images/logo-dark.png" class="logo-lg" alt="logo dark">
        </a>

        <a href="{{ route('dashboard')}}" class="logo-light">
            <img src="/images/logo-sm.png" class="logo-sm" alt="logo sm">
            <img src="/images/logo-light.png" class="logo-lg" alt="logo light">
        </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <i class="ri-menu-2-line fs-24 button-sm-hover-icon"></i>
    </button>

    <div class="scrollbar" data-simplebar>

        <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">Menu</li>
            @if(!empty($logged_in_user_permissions))
                @foreach($logged_in_user_permissions AS $user_permission)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route($user_permission['route'])}}">
                         <span class="nav-icon">
                              <i class="{{$user_permission['icon']}}"></i>
                         </span>
                            <span class="nav-text">{{$user_permission['label']}}</span>
                        </a>
                    </li>
                @endforeach
            @endif
            {{--<li class="nav-item">
                 <a class="nav-link menu-arrow" href="#sidebarProperty" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProperty">
                      <span class="nav-icon">
                           <i class="ri-community-line"></i>
                      </span>
                      <span class="nav-text"> Property </span>
                 </a>
                 <div class="collapse" id="sidebarProperty">
                      <ul class="nav sub-navbar-nav">
                           <li class="sub-nav-item">
                                <a class="sub-nav-link" href="--}}{{--{{ route('second', ['property', 'grid'])}}--}}{{--">Property Grid</a>
                           </li>
                           <li class="sub-nav-item">
                                <a class="sub-nav-link" href="--}}{{--{{ route('second', ['property', 'list'])}}--}}{{--">Property List</a>
                           </li>
                           <li class="sub-nav-item">
                                <a class="sub-nav-link" href="--}}{{--{{ route('second', ['property', 'details'])}}--}}{{--">Property Details</a>
                           </li>
                           <li class="sub-nav-item">
                                <a class="sub-nav-link" href="--}}{{--{{ route('second', ['property', 'add'])}}--}}{{--">Add Property</a>
                           </li>
                      </ul>
                 </div>
            </li>--}} <!-- end Pages Menu -->
        </ul>
    </div>
</div>
