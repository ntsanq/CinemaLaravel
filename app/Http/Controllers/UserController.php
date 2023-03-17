<?php

namespace App\Http\Controllers;


use App\Models\Schedule;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $userTickets = Ticket::query()
            ->where('user_id', $user['id'])
            ->get()->toArray();

        $ticketsData = [];
        $checkedSessionIds = [];
        foreach ($userTickets as $ticket) {
            if (in_array($ticket['session_id'], $checkedSessionIds)){
                continue;
            } else {
                $ticket['created_date'] = Carbon::parse($ticket['created_at'])->format('d-m-Y H:i:s');
                $filmInfos = Schedule::query()
                    ->join('films', 'films.id', 'schedules.film_id')
                    ->join('images', 'images.id', 'films.image_id')
                    ->where('schedules.id', $ticket['schedule_id'])
                    ->select([
                        'schedules.start',
                        'schedules.end',
                        'images.path',
                        'films.name as film_name',
                    ])
                    ->first()->toArray();

                $ticket['path'] = $filmInfos['path'];
                $ticket['film_name'] = $filmInfos['film_name'];

                $checkedSessionIds[] = $ticket['session_id'];


                $ticketsData[] = $ticket;
            }
        }

        usort($ticketsData, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });


        return view('user.showtickets', [
            'user' => $user,
            'userTickets' => $ticketsData
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

            return redirect('/profile')->with('status', 'Profile updated successfully!');
        }

        return redirect('/profile')->with('error', 'Unable to update profile.');
    }

}
