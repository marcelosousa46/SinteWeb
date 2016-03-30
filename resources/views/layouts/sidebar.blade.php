<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    @if (!Auth::guest())
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/bower_components/AdminLTE/dist/img/marcelo.jpg") }}" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="{{ url('/logout') }}"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
    @else
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/bower_components/AdminLTE/dist/img/default-50x50.gif") }}" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
          <p>Visitane</p>
          <!-- Status -->
          <a href="{{ url('/login') }}"><i class="fa fa-circle text-danger"></i> Offline</a>
        </div>
      </div>
    @endif

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
        <span class="input-group-btn">
          <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <!-- Optionally, you can add icons to the links -->
      @if (Auth::guest())
        <li class="active"><a href="{{ url('/login') }}"><span>Entrar</span></a></li>
      @else
        <li class="header">Menu Principal</li>
        <?php
          $menu  = auth()->user()->Rotinas();
        ?>
        @for($i = 0; $i < count($menu); $i++)
            <li class="treeview">
              <a href="{{ $menu[$i]->url }}"><span>{{ $menu[$i]->descricao }}</span> <i class="fa fa-angle-left pull-right"></i></a>
              <?php
                $submenu  = auth()->user()->Subrotinas($menu[$i]->nivel);
              ?>
              @for($j = 0; $j < count($submenu); $j++)
                  <ul class="treeview-menu">
                    <li><a href="{{ route($submenu[$j]->url, ['id' => $submenu[$j]->id, 'in' => $submenu[$j]->descricao]) }}">{{ $submenu[$j]->descricao }}</a></li>
                  </ul>
              @endfor
            </li>
        @endfor
        <li class="active"><a href="{{ url('/logout') }}"><span>Sair</span></a></li>
    @endif
    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
