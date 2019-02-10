<nav class="navbar navbar-expand-lg align-items-center justify-content-between">

    <!-- Branding Image -->
    <a class="navbar-brand white-text{{ url()->current() == url('/') ? ' active' : '' }}" href="{{ route('welcome') }}">{{ config('app.name', 'Laravel') }}</a>

    <!-- SideNav slide-out button -->
    <a href="#" data-activates="slide-out" class="btn btn-primary p-3 button-collapse navbar-toggler" data-toggle="collapse" data-target="#app-navbar-collapse" aria-controls="app-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle Navigation</span>
        <i class="fa fa-bars"></i>
    </a>

    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav fixed">
        <ul class="custom-scrollbar">
            <!--/. Side navigation links -->
            <li class="nav-item">
                @if (Auth::guest())
                    <img src="{{ asset('/images/commissioner.jpg') }}" class="mx-auto img-fluid" height="300px" width="250" />
                @else
                    @if(Auth::user()->league)
                        <img src="{{ Auth::user()->league->picture != null ? route('sub_photo', ['picture' => Auth::user()->league->picture]) : asset('/images/commissioner.jpg') }}" class="mx-auto img-fluid" height="300px" width="250" />
                    @elseif(Auth::user()->player)
                        <img src="{{ Auth::user()->player->image ? asset(Auth::user()->player->image->path) : asset('/images/commissioner.jpg') }}" class="mx-auto img-fluid" height="300px" width="250" />
                    @endif
                @endif
            </li>
            <li class="nav-item border-bottom mr-3" id="">
                <a class="nav-link white-text" href="{{ route('welcome') }}">Home</a>
            </li>
            <li class="nav-item border-bottom mr-3" id="">
                <a class="nav-link white-text" href="{{ route('rec_centers.index') }}">Parks N Recs</a>
            </li>
            <li class="nav-item border-bottom mr-3" id="">
                <a class="nav-link white-text" href="{{ route('players.index') }}">Players</a>
            </li>
            <li class="nav-item border-bottom mr-3" id="">
                <a class="nav-link white-text" href="{{ route('leagues.index') }}">City Leagues</a>
            </li>
            <li class="nav-item border-bottom mr-3" id="">
                <a class="nav-link white-text" href="{{ route('news.index') }}">News</a>
            </li>
            <li class="nav-item border-bottom mr-3{{ session('admin') !== null ? ' dropdown' : '' }}" id="">
                <a class="nav-link white-text" href="{{ route('clips.index') }}">Clips</a>
            </li>
            <li class="nav-item border-bottom mr-3" id="">
                <a class="nav-link white-text" href="{{ route('about') }}">About TTR</a>
            </li>

            @if (Auth::guest())
                <li class="nav-item border-bottom mr-3">
                    <a class="nav-link white-text" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link white-text" href="{{ route('register') }}">Register</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link white-text" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
										 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
        @endif
        <!--/. Side navigation links -->
        </ul>
    </div>
    <!--/. Sidebar navigation -->

    <div class="d-none d-lg-flex" id="">
        <!-- Right Side Of Navbar -->
        <ul class="nav md-pills pills-primary">
            <li id="rec_li" class="nav-item{{ session('admin') ? ' dropdown' : '' }}">
                <a class="nav-link white-text{{ url()->current() == url('rec_centers') ? ' active' : '' }}{{ session('admin') ? ' dropdown-toggle' : '' }}" href="{{ session('admin') ? '#' : route('rec_centers.index') }}"{!! session('admin') ? ' data-toggle="dropdown" role="button" aria-expanded="false"' : '' !!}>Parks N Recs{!! session('admin') ? '&nbsp;<span class="caret"></span>' : '' !!}</a>

                @if(Auth::check())
                    @if(session('admin'))
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="{{ route('admin.recs.create') }}">Add Rec Centers</a>
                            <a class="dropdown-item" href="{{ route('admin.recs.edit') }}">Edit Rec Centers</a>
                        </div>
                    @endif
                @endif
            </li>
            <li id="player_li" class="nav-item{{ session('admin') ? ' dropdown' : '' }}">
                <a class="nav-link white-text{{ url()->current() == url('players') ? ' active' : '' }}{{ session('admin') ? ' dropdown-toggle' : '' }}" href="{{ session('admin') ? '#' : route('players.index') }}"{!! session('admin') ? ' data-toggle="dropdown" role="button" aria-expanded="false"' : '' !!}>Players{!! session('admin') ? '&nbsp;<span class="caret"></span>' : '' !!}</a>

                @if(Auth::check())
                    @if(session('admin'))
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="{{ route('admin.videos.index') }}">Edit Players</a>
                        </div>
                    @endif
                @endif
            </li>
            <li id="league_li" class="nav-item{{ session('admin') ? ' dropdown' : '' }}">
                <a class="nav-link white-text{{ url()->current() == url('leagues') ? ' active' : '' }}{{ session('admin') ? ' dropdown-toggle' : '' }}" href="{{ session('admin') ? '#' : route('leagues.index') }}"{!! session('admin') ? ' data-toggle="dropdown" role="button" aria-expanded="false"' : '' !!}>City Leagues{!! session('admin') ? '&nbsp;<span class="caret"></span>' : '' !!}</a>

                @if(Auth::check())
                    @if(session('admin'))
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="{{ route('admin.videos.index') }}">Edit Leagues</a>
                        </div>
                    @endif
                @endif
            </li>
            <li id="news_li" class="nav-item{{ session('writer') !== null || session('admin')? ' dropdown' : '' }}">
                <a class="nav-link white-text{{ url()->current() == url('news') ? ' active' : '' }}{{ session('writer') !== null || session('admin') ? ' dropdown-toggle' : '' }}" href="{{ session('writer') !== null || session('admin') ? '#' : route('news.index') }}"{!! session('writer') !== null || session('admin') ? ' data-toggle="dropdown" role="button" aria-expanded="false"' : '' !!}>News{!! session('writer') !== null || session('admin') ? '&nbsp;<span class="caret"></span>' : '' !!}</a>

                @if(Auth::check())
                    @if(Auth::user()->writer)
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="{{ route('news.index') }}">View Articles</a>
                            <a class="dropdown-item" href="{{ route('news.create') }}">Add Article</a>
                            <a class="dropdown-item" href="{{ route('writers.show', ['writer' => Auth::user()->writer->id]) }}">My Articles</a>
                        </div>
                    @elseif(session('admin'))
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="{{ route('admin.news.index') }}">Edit Articles</a>
                            <a class="dropdown-item" href="{{ route('admin.news.index') }}">Add Writer</a>
                            <a class="dropdown-item" href="{{ route('admin.news.index') }}">Edit Writers</a>
                        </div>
                    @endif
                @endif
            </li>
            <li id="clips_li" class="nav-item{{ session('admin') ? ' dropdown' : '' }}">
                <a class="nav-link white-text{{ url()->current() == url('videos') ? ' active' : '' }}{{ session('admin') ? ' dropdown-toggle' : '' }}" href="{{ session('admin') ? '#' : route('clips.index') }}"{!! session('admin') ? ' data-toggle="dropdown" role="button" aria-expanded="false"' : '' !!}>Clips{!! session('admin') ? '&nbsp;<span class="caret"></span>' : '' !!}</a>

                @if(Auth::check())
                    @if(session('admin'))
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="{{ route('admin.videos.index') }}">View Clips</a>
                            <a class="dropdown-item" href="{{ route('admin.videos.delete') }}">Remove Clips</a>
                        </div>
                    @endif
                @endif
            </li>
            <li id="contact_li" class="nav-item">
                <a class="nav-link white-text{{ url()->current() == url('about_us') ? ' active' : '' }}" href="{{ route('about') }}">About TTR</a>
            </li>
        </ul>
    </div>

    <div class="d-none d-lg-flex" id="">
        <ul class="nav navbar-nav navbar-right flex-column flex-xl-row">
        @if(Auth::guest())
            <!-- Logins -->
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link btn indigo">Login
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link btn indigo lighten-1">Register
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </a>
                </li>
        @else
            <!-- Authentication Links -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle white-text{{ url()->current() == url('home') ? ' active' : '' }}" data-toggle="dropdown" role="button" aria-expanded="false">
                        @if(Auth::user()->player)
                            {{ Auth::user()->player->full_name() }}
                        @elseif(Auth::user()->league)
                            {{ Auth::user()->league->commish }}
                        @elseif(Auth::user()->writer)
                            {{ Auth::user()->writer->full_name() }}
                        @else
                            {{ 'Admin' }}
                        @endif
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{ route('home') }}">Profile</a>

                        @if(session('admin'))
                            <a class="dropdown-item" href="{{ route('about') }}">Settings</a>
                        @endif

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>