    <div class="page-sidebar navbar-collapse collapse">
      <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="sidebar-toggler-wrapper">
            <div class="sidebar-toggler">
          </div>
        </li>
        <li style="height:10px">

        </li>
        <li class="start @if($sidebar == 'dashboard') active @endif ">
          <a href="javascript:;">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
          </a>
        </li>
        <li class="@if($sidebar == 'sports' ) active open @endif">
          <a href="javascript:;">
          <i class="icon-basket"></i>
          <span class="title">Sports Management</span>
          <span class="arrow "></span>
          </a>
          <ul class="sub-menu">
            <li class="@if($sidebar == 'sports' && $subsidebar == 1 ) active @endif">
              <a href="{{route('admin.sports.index')}}">
              <i class="icon-home"></i>
              Sports</a>
            </li>
            <li class="@if($sidebar == 'sports' && $subsidebar == 2 ) active @endif">
              <a href="{{route('admin.category.index')}}">
              <i class="icon-basket"></i>
              Categories</a>
            </li>
            <li class="@if($sidebar == 'sports' && $subsidebar == 3 ) active @endif">
              <a href="{{url('/admin/tree')}}">
              <i class="icon-tag"></i>
              Tree</a>
            </li>
          </ul>
        </li>
          <li class="@if($sidebar == 'poll' ) active @endif" >
            <a href="{{url('/admin/poll')}}">
              <i class="fa fa-edit icon"></i>
              <span class="title">Poll Management</span>
              <span class="selected"></span>
            </a>
          </li>

           <li class="@if($sidebar == 'teams' ) active @endif" >
            <a href="{{url('/admin/teams')}}">
              <i class="fa fa-edit icon"></i>
              <span class="title">Teams</span>
              <span class="selected"></span>
            </a>
          </li>

        <li class="@if($sidebar == 'football' ) active open @endif">
          <a href="javascript:;">
          <i class="icon-basket"></i>
          <span class="title">Football</span>
          <span class="arrow "></span>
          </a>
          <ul class="sub-menu">
            <li class="@if($sidebar == 'football' && $subsidebar == 1 ) active @endif" >
              <a href="{{url('/admin/point')}}">
                <i class="fa fa-edit icon"></i>
                <span class="title">Points Table</span>
                <span class="selected"></span>
              </a>
            </li>
          </ul>
        </li>

          
          <li class="@if($sidebar == 'match' ) active open @endif">
            <a href="javascript:;">
            <i class="icon-basket"></i>
            <span class="title">Matches</span>
            <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
              <li class="@if($sidebar == 'match' && $subsidebar == 1  ) active @endif" >
                <a href="{{url('/admin/match')}}">
                  <i class="fa fa-edit icon"></i>
                  <span class="title">Match schedule</span>
                  <span class="selected"></span>
                </a>
              </li>
              <li class="@if($sidebar == 'match' && $subsidebar == 2 ) active @endif" >
                <a href="{{url('/admin/match/all')}}">
                  <i class="fa fa-edit icon"></i>
                  <span class="title">All Matches</span>
                  <span class="selected"></span>
                </a>
              </li>
            </ul>
          </li>
          
         
           <li class="@if($sidebar == 'post' ) active @endif" >
            <a href="{{url('/admin/post')}}">
              <i class="fa fa-edit icon"></i>
              <span class="title">Post Message</span>
              <span class="selected"></span>
            </a>
          </li>
          <li class="@if($sidebar == 'news' ) active @endif" >
            <a href="{{url('/admin/news')}}">
              <i class="fa fa-edit icon"></i>
              <span class="title">News</span>
              <span class="selected"></span>
            </a>
          </li>
           <li class="@if($sidebar == 'groups' ) active @endif" >
            <a href="{{url('/admin/groups')}}">
              <i class="fa fa-edit icon"></i>
              <span class="title">Groups</span>
              <span class="selected"></span>
            </a>
          </li>
      </ul>
    </div>