<h1>Hello {{ auth()->user()->first_name }}</h1> 

<a href="{{ url('/auth/logout') }}">Logout</a>