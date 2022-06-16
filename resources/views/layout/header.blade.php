  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links --> 
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item dropdown">
        <a class="nav-link"  data-toggle="dropdown" href="#" role="button">
          <i class="fas fa-power-off mr-2"></i>
          {{Auth::user()->name}}
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">  {{Auth::user()->name}}</span>
          <div class="dropdown-divider"></div>


          <form action="/logout" method="post">
            @csrf
            <button class="dropdown-item">
            
              <i class="fas fa-power-off mr-2"></i> Logout
              
            </button>
            </form>
        
        
        </div>
       
      </li>

  
    </ul>
  </nav>
  <!-- /.navbar -->