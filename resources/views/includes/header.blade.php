<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      @if(Auth::user())
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      @endif
      <a class="navbar-brand">ST Reports</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::user())
            @if(Auth::user()->isAdmin == 1)
              <li><a class="white" href="{{ route('dashboard') }}">Dashboard</a></li>
            @endif
            <li><a href="{{ route('report') }}">Report</a></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
        @endif
      </ul>
    </div>
</nav>