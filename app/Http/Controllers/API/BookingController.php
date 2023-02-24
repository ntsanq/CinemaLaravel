<?php

namespace App\Http\Controllers\API;

use App\Enums\SeatStatus;
use App\Enums\TicketStatus;
use App\Http\Traits\ResponseTrait;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\SeatCategory;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController
{
    use ResponseTrait;

    public function getSeats(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'roomId' => 'required|int',
        ]);

        if ($validator->fails()) {
            return $this->failed($validator->messages());
        }

        $seats = Seat::query()
            ->join('rooms', 'rooms.id', 'seats.room_id')
            ->select([
                'rooms.id as room_id',
                'rooms.name as room_name',
                'seats.id',
                'seats.name',
                'seats.status'
            ])
            ->where('seats.room_id', $request->roomId)
            ->get()->toArray();

        $occupiedList = [];
        $room = [];
        $allSeats = [];

        $room['id'] = $seats[0]['room_id'];
        $room['name'] = $seats[0]['room_name'];

        foreach ($seats as $seat) {
            if ($seat['status'] === 1) {
                $occupiedList[] = $seat['id'];
            }

            $allSeats[] = $seat['id'];

        }

        return $this->success([
            'allSeats' => $allSeats,
            'occupied' => $occupiedList,
            'room' => $room,
        ]);
    }

    public function getTimes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filmId' => 'required|int',
            'date' => 'required|date_format:d-m-Y',
        ]);

        if ($validator->fails()) {
            return $this->failed($validator->messages());
        }

        $date = strtotime($request->date);

        $schedules = Schedule::query()
            ->join('films', 'films.id', 'schedules.film_id')
            ->select([
                'schedules.start',
                'schedules.end',
                'schedules.room_id',
            ])
            ->where('schedules.film_id', $request->filmId)
            ->whereDate('schedules.start', date('Y/m/d', $date))
            ->get()->toArray();

        if ($schedules === null) {
            return $this->successMessage([]);
        }

        foreach ($schedules as &$schedule) {
            $schedule['start'] = date('H:i', strtotime($schedule['start']));
            $schedule['end'] = date('H:i', strtotime($schedule['end']));
        }

        return $this->success($schedules);
    }

    public function confirmBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filmId' => 'required|int',
            'scheduleTime' => 'required|date',
            'seats' => 'required|array',
            'userId' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->failed($validator->messages());
        }

        $schedule = strtotime($request->scheduleTime);

        $userId = $request->userId;

        $filmId = $request->filmId;

        $discountId = $request->discountId;

        $seats = $request->seats;

        $filmSchedule = Schedule::query()
            ->where('start', 'like', '%' . date('Y-m-d H:i', $schedule) . '%')
            ->where('film_id', $filmId)
            ->first();

        if ($filmSchedule === null) {
            return $this->failed('no film schedule');
        }

        $bookedTickets = [];
        $filmSchedule = $filmSchedule->toArray();

        //each ticket for each value of seats array input
        foreach ($seats as $seat) {
            //check seat exist
            $seatIns = Seat::findOrFail($seat);
            if ($seatIns === null) {
                return $this->failed('no seat with this id');
            } else {
                //seat already booked
                if ($seatIns->status === SeatStatus::Booked) {
                    return $this->failed('this seat has been already booked');
                }
                $ticket = new Ticket();
                $ticket->user_id = $userId;
                $ticket->schedule_id = $filmSchedule['id'];

                $seatCategoryIns = SeatCategory::findOrFail($seatIns->seat_category_id);
                $ticket->price = $seatCategoryIns->price;

                $ticket->seat_id = $seat;
                if ($discountId !== null) {
                    $ticket->discount_id = $discountId;
                }

                $ticket->status = TicketStatus::HasNotBeenUsed;
                $ticket->save();

                //set seat was taken
                $seatIns->update([
                    'status' => SeatStatus::Booked
                ]);

                $ticketData = $ticket;
                $ticketData['seatType'] = $seatCategoryIns->name;
                $ticketData['seatName'] = $seatIns->name;
                $bookedTickets[] = $ticketData;
            }
        }

        return $this->success($bookedTickets);
    }
}
