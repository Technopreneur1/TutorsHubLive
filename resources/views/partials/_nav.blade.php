@if (!auth()->check())
    <div class="fresh-menu">
        <div class="logo">
            <a href="{{route('home')}}">
                <img src="{{asset('img/logotext.png')}}" alt="">
            </a>
        </div>
        <div class="buttons">
            @if (auth()->check())
                <a href="{{route('profile')}}" class="btn-join">Profile</a>
            @else

                <a href="{{route('login')}}" class="btn-join">Login</a>
            @endif
        </div>
    </div>
@else

<div class="topnav" id="navapp">
    <div class="logo">
        <a href="{{route('home')}}">
            <img src="{{asset('img/logotext.png')}}" alt="">
        </a>
    </div>
    <menu-icons url="{{route('home')}}"
        :user="{{auth()->check() ? auth()->user() : null}}"
        messages="{{auth()->user()->unreadMessages()->count()}}"
        sessions="{{auth()->user()->profile ? auth()->user()->profile->unseenSessions()->count() : 0}}
        ></menu-icons>
</div>

@endif
