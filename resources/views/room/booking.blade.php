@extends('layouts.app')
@section('content')
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Booking</h1>
                <a class="btn btn-primary btn-sm" href="{{ route('home') }}"> {{ __('Back') }}</a>

                <form action="{{ route('reservation.book', ['room' => $room]) }}" method="post">
                    @csrf
                    <div class="form-group>
                        <label for="start_time">Start time</label>
                        <input type="datetime-local" name="start_time" class="form-control">
                    </form>
                    <div class="form-group>
                        <label for="start_time">End time</label>
                        <input type="datetime-local" name="end_time" class="form-control">
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-primary">Book</button>
                    </div>
                </form>
</div>
@endsection
