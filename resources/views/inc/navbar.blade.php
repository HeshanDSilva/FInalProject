<nav class="navbar navbar-static-top">

    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <h1>WirelessTV</h1>
    <!-- User Account: style can be found in dropdown.less -->
    <!-- User Account: style can be found in dropdown.less -->
     <li class="dropdown user user-menu">
       <button href="#" class="dropdown-toggle btn btn-outline-dark" data-toggle="dropdown">
         <img src="/images/{{auth::user()->avatar}}" class="user-image" alt="User Image" style="width:85px;height:85px">
         <span class="hidden-xs">{{auth::user()->name}} :- {{auth::user()->type}}</span>
       </button>
       <ul class="dropdown-menu">
         <!-- User image -->
         <li class="user-header">

            <img src="/images/{{auth::user()->avatar}}" class="img-circle" alt="User Image" style="width:220px;height:220px">
            <br>
          <p>
             {{auth::user()->name}} - {{auth::user()->type}}
           </p>
         </li>

         <li class="user-footer">
           <div class="pull-left">
             <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
           </div>
           <div class="pull-right">
             <a href="#" class="btn btn-default btn-flat">profile</a>
           </div>
         </li>
       </ul>
     </li>
  </nav>
