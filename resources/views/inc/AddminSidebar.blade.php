<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="/images/{{auth::user()->avatar}}" class="img-circle" alt="User Image" style="width:60px;height:60px"><br>
        <a href="/Dashboard/ChangeAdminAvatar">Change Avatar</a>
      </div>
      <div class="pull-left info">
        <p>{{auth::user()->name}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="active">
        <a href="/admin">
          <i class="fa fa-dashboard"></i> <span><b>Dashboard</b></span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>

      <li class="treeview">
        <a href="#">
        <i class="fa fa-slideshare"></i>
        <span>Wireless Slides</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            <small class="label pull-right bg-red" style="border-radius:3px;Padding-left:3px;Padding-right:3px"> 0{{$s}} </small>
        </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="/Upload"><i class="fa fa-circle-o"></i>
              <span> Upload Slides</span>
            </a>
          </li>
          <li><a href="/Approved"><i class="fa fa-circle-o"></i>
            <span> Approved Slides</span>
            <span class="pull-right-container">
          </span>
          </a>
          </li>
          <li><a href="/Pending"><i class="fa fa-circle-o"></i>  Pending Slides
            @if($s != 0)
              <span class="pull-right-container">
                  <span class="dotred" style="margin-right:35px"></span>
              </span>
            @endif
          </a>
          </li>
          <li><a href="/Rejected"><i class="fa fa-circle-o"></i>  Rejected Slides</a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-youtube-play"></i>
          <span>Video Promotions</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-blue" style="border-radius:3px;Padding-left:3px;Padding-right:3px"> 0{{$v}} </small>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="/video/upload/form"><i class="fa fa-circle-o"></i> Upload Videos</a></li>
          <li><a href="/Admin/Pending-Videos"><i class="fa fa-circle-o"></i> Pending Videos
            @if($v != 0)
              <span class="pull-right-container">
                  <span class="dotblue" style="margin-right:35px"></span>
              </span>
            @endif
          </a></li>
          <li><a href="/Admin/approved-Videos"><i class="fa fa-circle-o"></i> Approved Videos</a></li>
          <li><a href="/Admin/rejected-Videos"><i class="fa fa-circle-o"></i> Rejected Videos</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-newspaper-o"></i>
          <span>News</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-green" style="border-radius:3px;Padding-left:3px;Padding-right:3px"> 0{{$n}} </small>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="/Upload/news"><i class="fa fa-circle-o"></i> Upload News
            @if($n != 0)
              <span class="pull-right-container">
                  <span class="dotgreen" style="margin-right:35px"></span>
              </span>
            @endif
          </a></li>
          <li><a href="/Played/news/1"><i class="fa fa-circle-o"></i> Played News</a></li>
          <li><a href="/rejected/news/1"><i class="fa fa-circle-o"></i> Rejected News</a></li>

        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Devices</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-yellow" style="border-radius:3px;Padding-left:3px;Padding-right:3px"> 0{{$d}} </small>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="/device"><i class="fa fa-circle-o"></i> All Devices</a></li>
          <li><a href="/pending"><i class="fa fa-circle-o"></i>Pending Devices
            @if($d != 0)
              <span class="pull-right-container">
                  <span class="dotyellow" style="margin-right:35px"></span>
              </span>
            @endif
          </a></li>
          <li><a href="/reject"><i class="fa fa-circle-o"></i>Rejected Devices</a></li>
          <li><a href="/device/location"><i class="fa fa-circle-o"></i> Device Location</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-list-alt"></i>
          <span>Category</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="/categories"><i class="fa fa-circle-o"></i> Categories</a></li>

        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-group"></i>
          <span>User Groups</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="/UserDetails"><i class="fa fa-circle-o"></i> All Users</a></li>
          <li><a href="/disabledusers"><i class="fa fa-circle-o"></i>Disabled Users </a></li>
          <li><a href="/activeusers"><i class="fa fa-circle-o"></i>Active Users </a></li>
        </ul>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
