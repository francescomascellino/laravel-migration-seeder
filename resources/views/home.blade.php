@extends('layout.app')

@section('title', 'Home')

@section('content')
    <main class="">

        <div class="container-fluid">
            <div class="row">
                <h1>TRENITALIA</h1>
                @forelse ($sorted_trains as $train)
                    {{ $train->departure_time }}
                @empty
                    <h1>NO TRAINS TO SHOW</h1>
                @endforelse
            </div>

        </div>
    </main>
@endsection
