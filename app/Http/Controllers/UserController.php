<?php

namespace App\Http\Controllers;


use App\Enums\TicketStatus;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function showProfile(Request $request)
    {
        $user = $this->getUserInfo();

        return view('user.index', [
            'user' => $user
        ]);
    }

    public function showUserTickets(Request $request)
    {
        $user = $this->getUserInfo();
        $sessionIds = Ticket::query()
            ->select('session_id', 'created_at')
            ->distinct()
            ->where('user_id', $user['id'])
            ->orderBy('created_at', 'desc')
            ->simplePaginate(5)
            ->toArray();

        $data = [];
        foreach ($sessionIds['data'] as $each) {
            $info = Ticket::query()
                ->join('schedules', 'schedules.id', 'tickets.schedule_id')
                ->join('films', 'films.id', 'schedules.film_id')
                ->join('media_links', 'media_links.id', 'films.media_link_id')
                ->select([
                    'tickets.created_at as created_date',
                    'media_links.image_link as path',
                    'films.name as film_name',
                    'tickets.session_id',
                    // Use a CASE statement to update the 'status' value
                    DB::raw('CASE
                        WHEN tickets.status = ' . TicketStatus::UnPaid . ' THEN "' . TicketStatus::getKey(TicketStatus::UnPaid) . '"
                        WHEN tickets.status = ' . TicketStatus::Paid . ' THEN "' . TicketStatus::getKey(TicketStatus::Paid) . '"
                        WHEN tickets.status = ' . TicketStatus::Expired . ' THEN "' . TicketStatus::getKey(TicketStatus::Expired) . '"
                        WHEN tickets.status = ' . TicketStatus::Printed . ' THEN "' . TicketStatus::getKey(TicketStatus::Printed) . '"
                        ELSE ""
                        END as status'
                    ),
                ])
                ->where('tickets.session_id', $each['session_id'])
                ->get()->toArray();
            $data[] = $info;
        }

        $sessionIds['data'] = $data;

        return view('user.showtickets', [
            'user' => $user,
            'userTickets' => $sessionIds['data'],
            'pagination' => $sessionIds,
        ]);
    }

    public function update(Request $request)
    {
        $user = null;
        $token = PersonalAccessToken::findToken(session()->get('token'));
        if (!empty($token)) {
            $user = $token->tokenable;
            $user->name = $request->name ?? $user->name;
            $user->email = $request->email ?? $user->email;
            $user->birthday = $request->birthday ?? $user->birthday;
            $user->address = $request->address ?? $user->address;

            if ($request->old_password || $request->new_password || $request->new_password_confirmation) {
                $request->validate([
                    'old_password' => 'required',
                    'new_password' => 'required|confirmed',
                    'new_password_confirmation' => 'required',
                ]);
                if (!Hash::check($request->old_password, $user->password)) {
                    return redirect('/profile')->with('error', 'The old password you entered is incorrect.');
                }

                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect('/profile')->with('status', 'Profile updated successfully!');
            }
            $user->save();

            return redirect('/profile')->with('status', 'Profile updated successfully!');
        }

        return redirect('/profile')->with('error', 'Unable to update profile.');
    }

}
