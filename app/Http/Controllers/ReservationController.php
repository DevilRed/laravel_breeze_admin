<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Rules\EndTimeAfterStartTime;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function __invoke(Room $room)
    {
        return view('room.booking', [
            'room' => $room
        ]);
    }

    public function store(Request $request, Room $room)
    {
        $request->validate([
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required' ,'date_format:H:i', 'after:start_time', new EndTimeAfterStartTime($request->start_time)],
        ]);
        $startTime = Carbon::createFromFormat('H:i', $request->start_time);
        $endTime = Carbon::createFromFormat('H:i', $request->end_time);

        $room->reservations()->create([
            'start_time' => $startTime,
            'end_time' => $endTime,
            'user_id' => auth()->id(),
            'room_id' => $room->id,
        ]);

        return redirect()->route('rooms.view', $room)->with('success', 'Registration Created!');
    }
}
