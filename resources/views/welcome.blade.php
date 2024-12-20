@extends('layouts.app')

@section('content')
<h2>Room list</h2>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Room ID</th>
        <th scope="col">Room Name</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rooms as $room)
        <tr>
            <td>{{ $room->id }}</td>
            <td>{{ $room->name }}</td>
            <td>
                <a href="{{ route('rooms.view', ['id' => $room->id]) }}" class="btn btn-primary">View</a>
                <a href="{{ route('reservation.book', ['room' => $room]) }}" class="btn btn-primary">Book</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
