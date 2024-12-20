<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __invoke(Room $room)
    {
        return view('room.booking', [
            'room' => $room
        ]);
    }
}
