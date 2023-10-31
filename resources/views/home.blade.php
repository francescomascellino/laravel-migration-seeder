@extends('layout.app')

@section('title', 'Home')

@section('content')
    <main class="">

        <div class="container-fluid">
            <div class="row my-3 g-3">
                <h1 class="text-center">TRENITALIA</h1>
                @forelse ($sorted_trains as $train)
                    <div class="col-2">

                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title">TRENO DIRETTO PER</h4>
                                <h5 lass="card-subtitle mb-2 text-muted">{{ $train->arrival_station }}</h5>

                                <h4 class="card-title">IN PARTENZA DA</h4>
                                <h5 lass="card-subtitle mb-2 text-muted">{{ $train->arrival_station }}</h5>

                                <h4 class="card-title">ALLE ORE</h4>
                                <h5 lass="card-subtitle mb-2 text-muted">{{ $train->departure_time }}</h5>

                            </div>

                        </div>

                    </div>

                @empty
                    <h1>NO TRAINS TO SHOW</h1>
                @endforelse
            </div>
            <div class="my-3">
                {{$sorted_trains->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </main>
@endsection
