@extends('layouts.app')
@section('content')
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Room Booking Form</h1>
                <a class="btn btn-primary btn-sm" href="{{ route('home') }}"> {{ __('Back') }}</a>
                {{--@if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif--}}

                <form action="{{ route('reservation.book', ['room' => $room]) }}" method="post">
                    @csrf
                    <div class="form-group>
                        <label for="start_time" class="form-label">Start Date</label>
                        <input type="text" name="date" class="form-control date" value="{{ old('date') }}" required>

                <div class="mb-4">
                    <label for="startTime" class="form-label">Start Time</label>
                    <div class="input-group">
                        <input type="time" class="form-control" id="startTime" name="start_time" value="{{ old('start_time') }}" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="endTime" class="form-label">End Time</label>
                    <div class="input-group">
                        <input type="time" class="form-control w-100 @error('end_time') is-invalid @enderror" id="endTime" name="end_time" value="{{ old('end_time') }}" required>

                        @error('end_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Book Room</button>
                </div>
                </form>
</div>
@endsection
