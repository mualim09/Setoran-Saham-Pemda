  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link " > 
      <img src="logo_bank_sumut_2.png" alt="logo_bank_sumut" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">Saham Pemda</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
  

  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
   
          <li class="nav-item">
            <a href="/" class="nav-link {{Request::is('/')? 'active ':''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard  
                
                
              </p>
            </a>
          </li>

            {{-- <li class="nav-item">
              <a href="/aktivitas" class="nav-link {{(Request::segment(1)=='aktivitas')? 'active ':''}}">
                <i class="nav-icon fas fa-plus"></i>
                <p>
                  Aktivitas
                  
                </p>
              </a>
            </li> --}}
          <li class="nav-item">
            <a href="/histories" class="nav-link {{(Request::segment(1)=='histories')? 'active ':''}}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Histories
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/report" class="nav-link {{(Request::segment(1)=='report')? 'active ':''}}">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Report
                
              </p>
            </a>
          </li>
         

           

           

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
 