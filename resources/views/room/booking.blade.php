@extends('layouts.app')
@section('content')
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Room Booking Form</h1>
                <a class="btn btn-primary btn-sm" href="{{ route('home') }}"> {{ __('Back') }}</a>

                <form action="{{ route('reservation.book', ['room' => $room]) }}" method="post">
                    @csrf
                    <div class="form-group>
                        <label for="start_time" class="form-label">Start Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </form>
                <div class="mb-4">
                    <label for="startTime" class="form-label">Start Time</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-clock"></i></span>
                        <input type="time" class="form-control" id="startTime" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="endTime" class="form-label">End Time</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-clock-fill"></i></span>
                        <input type="time" class="form-control" id="endTime" required>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Book Room</button>
                </div>
                </form>
</div>
@endsection
