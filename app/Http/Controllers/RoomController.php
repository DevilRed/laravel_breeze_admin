<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RoomRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $rooms = Room::paginate();

        return view('room.index', compact('rooms'))
            ->with('i', ($request->input('page', 1) - 1) * $rooms->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $room = new Room();

        return view('room.create', compact('room'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request): RedirectResponse
    {
        Room::create($request->validated());

        return Redirect::route('rooms.index')
            ->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $room = Room::find($id);

        return view('room.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $room = Room::find($id);

        return view('room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, Room $room): RedirectResponse
    {
        $room->update($request->validated());

        return Redirect::route('rooms.index')
            ->with('success', 'Room updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Room::find($id)->delete();

        return Redirect::route('rooms.index')
            ->with('success', 'Room deleted successfully');
    }
}
