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
use Stripe\StripeClient;

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

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filmId' => 'required|int',
            'scheduleTime' => 'required|date',
            'seats' => 'required|array',
            'userId' => 'required',
            'payment' => 'required',
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
        $filmSchedule = $filmSchedule->toArray();

        $link = '';
        if ($request->payment === 'stripe') {
            $link = $this->stripeCheckout($seats, $userId, $filmSchedule, $discountId);
        }

        return $this->success($link);
    }

    private function stripeCheckout($seats, $userId, $filmSchedule, $discountId)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        $lineItems = [];
        $tickets = [];

        foreach ($seats as $seat) {
            $seatIns = Seat::findOrFail($seat);
            if ($seatIns === null) {
                throw new \Exception('no seat with this id');
            } else {
                if ($seatIns->status === SeatStatus::Booked) {
                    throw new \Exception('this seat has been already booked');
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
                $ticket->status = TicketStatus::UnPaid;
                $ticket->save();
                $tickets[] = $ticket;

                $seatIns->update([
                    'status' => SeatStatus::Booked
                ]);

                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'vnd',
                        'product_data' => [
                            'name' => 'Seat ' . $seatIns->name . '(' . $seatCategoryIns->name . ')',
                        ],
                        'unit_amount' => $seatCategoryIns->price,
                    ],
                    'quantity' => 1,
                ];
            }
        }

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('stripe.success', [], true) . "?sessionId={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('stripe.cancel', [], true) . "?sessionId={CHECKOUT_SESSION_ID}",
        ]);

        foreach ($tickets as $ticket) {
            $ticket->update([
                'session_id' => $checkout_session->id
            ]);
        }

        return $checkout_session->url;
    }
}
