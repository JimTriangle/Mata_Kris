@extends('layouts.public')

@section('content')
<div class="container">
    <h1>Nos prochains concerts</h1>
    <ul class="concert-list">
        @forelse ($concerts as $concert)
            <li>
                <div class="date">{{ \Carbon\Carbon::parse($concert->date)->format('d M') }}</div>
                <div class="details">
                    <h3>{{ $concert->ville }}</h3>
                    <p>{{ $concert->lieu }}</p>
                </div>
            </li>
        @empty
            <li>Aucun concert prévu pour le moment.</li>
        @endforelse
    </ul>
</div>
@endsection