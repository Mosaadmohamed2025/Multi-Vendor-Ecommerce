<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Backend_Files/img/brand/logo.png')}}" class="logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Backend_Files/img/brand/logo-white.png')}}" class="dark-logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Backend_Files/img/brand/favicon.png')}}" class="logo-2" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Backend_Files/img/brand/favicon.png')}}" class="dark-logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
							<input class="form-control" placeholder="Search for anything..." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
						</div>
					</div>
					<div class="main-header-right">
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="nav-link" id="bs-example-navbar-collapse-1">
								<form class="navbar-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
											</button>
										</span>
									</div>
								</form>
							</div>

                            <div class="dropdown nav-item main-header-notification">
                                <a class="new nav-link" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                    </svg>
                                    <span class="pulse"></span>
                                </a>
                                <div class="dropdown-menu dropdown-notifications">
                                    <div class="menu-header-content bg-primary text-right">
                                        <div class="d-flex">
                                            <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
                                            <a href="{{route('notifications.markAllRead')}}" style="cursor: pointer" class="badge  badge-pill badge-warning mr-auto my-auto float-left mark-all-read-btn">Mark All Read</a>
                                        </div>
                                        <p data-count="{{ App\Models\Notification::where('reader_status' , 0)->count() }}" class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">{{ App\Models\Notification::where('reader_status' , 0)->count() }}</p>
                                    </div>

                                    <div class="main-notification-list Notification-scroll">

                                        @foreach(App\Models\Notification::where('reader_status', 0)->get() as $notification)
                                            <a class="d-flex p-3 border-bottom" href="#">
                                                <div class="notifyimg bg-pink">
                                                    <i class="la la-file-alt text-white"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <h5 class="notification-label mb-1">{{ $notification->message }} : {{ $notification->username }}</h5>
                                                    <div class="notification-subtext">{{ $notification->created_at }}</div>
                                                </div>
                                                <div class="ml-auto">
                                                    <i class="las la-angle-left text-left text-muted"></i>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href="">
                                    @if(auth()->user()->photo)
                                        <img alt="" src="/user_images/{{auth()->user()->photo}}"></a>
                                    @else
                                    <img alt="" src="{{URL::asset('Backend_Files/img/faces/6.jpg')}}"></a>
                                    @endif
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user">
                                                @if(auth()->user()->photo)
                                                    <img alt="" src="/user_images/{{auth()->user()->photo}}"></a>
                                                @else
                                                <img alt="" src="{{URL::asset('Backend_Files/img/faces/6.jpg')}}" class="">
                                                @endif
                                            </div>
											<div class="ml-3 my-auto">
												<h6>{{auth()->user()->username}}</h6><span>{{auth()->user()->email}}</span>
											</div>
										</div>
									</div>
                                    <a class="dropdown-item" href="" style="display: flex;align-items: center;justify-content: left;">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item" type="submit">Logout<i class="bx bx-log-out"></i> </button>
                                        </form>
                                    </a>
                                </div>
							</div>

						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('p[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('.main-notification-list');

    Pusher.logToConsole = true;

    var pusher = new Pusher('9e24af640d7af1a9b0ad', {
        cluster: 'mt1'
    });

    var channel = pusher.subscribe('create-order');
    channel.bind('App\\Events\\CreateOrder', function(data) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = `
            <a class="d-flex p-3 border-bottom" href="#">
                <div class="notifyimg bg-pink">
                    <i class="la la-file-alt text-white"></i>
                </div>
                <div class="ml-3">
                    <h5 class="notification-label mb-1">${data.message} : ${data.username}</h5>
                    <div class="notification-subtext">${data.created_at}</div>
                </div>
                <div class="ml-auto">
                    <i class="las la-angle-left text-left text-muted"></i>
                </div>
            </a>`;
        notifications.html(newNotificationHtml + existingNotifications);
        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsCountElem.text(notificationsCount);
        notificationsWrapper.show();
    });
</script>



