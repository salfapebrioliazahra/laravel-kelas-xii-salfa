<div class="header">
  <div class="container">
    <div class="w3layouts_logo">
      <a href="{{ route('home') }}"><h1>One<span>Movies</span></h1></a>
    </div>
    <div class="w3_search">
      <form action="{{ route('movies') }}" method="get">
        <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" required="">
        <input type="submit" value="Go">
      </form>
    </div>
    <div class="w3l_sign_in_register">
      <ul>
        @guest
          <li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>
        @else
          <li><i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}</li>
          @if (Auth::user()->isAdmin())
            <li><a href="{{ route('admin.dashboard') }}" style="background: #212121; color: #fff; padding: 6px 15px; margin-right: 5px;">Dashboard</a></li>
          @endif
          <li>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" style="background: #FF8D1B; color: #fff; border: none; text-transform: uppercase; font-weight: bold; padding: 6px 20px; cursor: pointer; transition: .5s ease-in;" onmouseover="this.style.background='#212121'" onmouseout="this.style.background='#FF8D1B'">Logout</button>
            </form>
          </li>
        @endguest
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
