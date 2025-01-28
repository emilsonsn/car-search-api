@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar vh-100">
            <div class="position-sticky p-3">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white bg-primary rounded p-2" href="{{ route('groups') }}">Grupos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white bg-secondary rounded p-2" href="{{ route('links') }}">Links</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @if(View::hasSection('crud-content'))
                @yield('crud-content')
            @else
                <div class="d-flex justify-content-center align-items-center pt-4">
                    <img style="width: 400px" src="https://cdn-icons-png.flaticon.com/512/20/20699.png" alt="">
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
