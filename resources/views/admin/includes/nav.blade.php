<!-- top navigation -->
<div class="top_nav">
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="nav_menu">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
                <ul class="navbar-right">
                    <!-- User Profile Dropdown -->
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('adminassets/images/img.jpg')}}" alt=""> John Doe
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            <!-- Dropdown items for user profile -->
                            <a class="dropdown-item" href="javascript:;"> Profile</a>
                            <a class="dropdown-item" href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>Settings</span>
                            </a>
                            <a class="dropdown-item" href="javascript:;">Help</a>
                            <a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </div>
                    </li>

                    <!-- Messages Dropdown -->
                    <li role="presentation" class="nav-item dropdown open">
                        <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-green">{{$unread}}</span>
                        </a>
                        <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                            <!-- Message items -->
                            @foreach ($messages as $message)
                            @if (is_object($message) && isset($message->fname))
                                <li class="nav-item active">
                                    <a href="{{ route('showmsg',['id'=>$message->id])}}" class="dropdown-item">
                                        <span class="image"><img src="{{asset('adminassets/images/img.jpg')}}" alt="Profile Image" /></span>
                                        <span>
                                            <span class="fname">{{$message->fname}}</span>
                                            <span class="time">{{$message->created_at->diffForHumans()}}</span>
                                        </span>
                                        <span class="message">{{$message->message}}</span>
                                    </a>
                                </li>
                               @endif
                            @endforeach
                            <!-- See All Alerts link -->
                            <li class="nav-item">
                                <div class="text-center">
                                    <a class="dropdown-item" href="{{route('messages')}}">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </form>
</div>
<!-- /top navigation -->