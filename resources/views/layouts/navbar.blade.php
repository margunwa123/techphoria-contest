<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white shadow-sm">
  <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
         <img src="{{URL::asset('asset/vinaid-text.svg')}}" style="height:40px" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
        
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                  @endif
              @else
                @if (Auth::user()->isClient())
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.home') }}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.consultant.index') }}">Consultants</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.request.index') }}">Requests</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.personal_request.index') }}">Personal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.project.index') }}">Project</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.company.index') }}">Companies</a>
                  </li>
                @else
                {{-- If the user is consultant --}}
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('consultant.home') }}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('consultant.personal_request.index') }}">Personal Request</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('consultant.request.index') }}">Requests</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('consultant.project.index') }}">Projects</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('consultant.apply_request.index') }}">Applied Requests</a>
                  </li>
                @endif
                  <li class="nav-item dropdown">
                      <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          <i class="fas fa-bell text-yellow notification-bell">
                          </i>
                          <span class="badge" id="unread-count">{{ App\Models\Notification::where(['user_id' => Auth::user()->id, 'read' => False])->count() }}</span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifications" id="notifications">
                          @foreach (Auth::user()->notifications->take(5) as $notification)
                            <div class="notification" id="notification-{{$notification->id}}">
                              <div class="notification-title d-flex justify-content-between">
                                {{ $notification->title }}
                                <span class="ml-auto">
                                  @if ($notification->read == False)
                                  <button id="read-btn-{{$notification->id}}" class="btn btn-success" onclick="readNotification({{$notification->id}})">
                                    <i class="fas fa-check"></i> Read
                                  </button>
                                  @endif
                                  <button id="delete-btn-{{$notification->id}}" class="btn btn-danger" onclick="deleteNotification({{$notification->id}})">
                                    <i class="fas fa-trash"></i>
                                  </button>
                                </span>
                              </div>
                              <div class="notification-body">{{ $notification->body }}</div>
                            </div>
                          @endforeach
                      </div>
                  </li>
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="dropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                          </form>
                          @if (Auth::user()->isClient())
                            <a href="{{ route('client.profile.show', Auth::id()) }}" class="dropdown-item">Profile</a>
                          @endif
                          @if (Auth::user()->isConsultant())
                            <a href="{{ route('consultant.profile.show', Auth::id()) }}" class="dropdown-item">Profile</a>
                            @endif
                      </div>
                  </li>
              @endguest
          </ul>
      </div>
  </div>
</nav>
<script>
  function readNotification(notif_id) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "/notification/" + notif_id,
      method: 'POST',
      success: function (response) {
        $("#unread-count").html($("#unread-count").html() - 1);
        $("#read-btn-" + notif_id).prop('hidden', true);
      }
    });
  }

  function deleteNotification(notif_id) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "/notification/" + notif_id,
      method: 'DELETE',
      success: function (response) {
        $("#notification-" + notif_id).remove();
      }
    })
  }
</script>