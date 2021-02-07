   @extends('layouts.search')
   @section('content')
   <nav class="navbar navbar-expand-lg navbar-dark"  >
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/dashboard">
                            <b> لوحة التحكم </b>
                        </a>
                    </li>
                </ul>

                <!-- Right Navbar -->
                <ul class="navbar-nav navbar-right mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    </li>
                 
                </ul>
                <!-- ./End of right navbar -->
            </div>
        </div>
    </nav>
    <!-- ./End of navbar -->
        <!-- Search Box -->
    

    <livewire:search />

 
    <!-- ./End of search box -->
    @endsection