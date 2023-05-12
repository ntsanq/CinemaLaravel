<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClerkController
{
    public function index(Request $request)
    {
        $search = !empty($request->search) ? $request->search : '';
        $start = $request->input('_start', 0);
        $end = $request->input('_end', 10);

        $sort = $request->input('_sort', '');
        $order = $request->input('_order', '');

        $clerks = User::query()
            ->select([
                'users.*'
            ])
            ->where('name', 'like', '%' . $search . '%')
            ->where(function ($query) {
                $query->where('role', UserRole::Clerk)
                    ->orWhere('role', UserRole::Admin);
            });

        $order = strtolower($order);
        if (in_array($order, ['asc', 'desc'])) {
            $clerks = $clerks->orderBy('users.' . $sort, $order);
        }

        $paginator = $clerks->paginate($end - $start);
        $clerks = $paginator->toArray()['data'];

//        foreach ($clerks as &$clerk) {
//            switch ($clerk['role']) {
//                case UserRole::Clerk:
//                    $clerk['role'] = UserRole::getKey(UserRole::Clerk);
//                    break;
//                case UserRole::Admin:
//                    $clerk['role'] = UserRole::getKey(UserRole::Admin);
//                    break;
//            }
//        }

        $total = $paginator->total();
        $data = array_values($clerks);

        return response()->json($data)->header('X-Total-Count', $total);
    }


    public function infoForAdmin($id)
    {
        $clerks = User::findOrFail($id);

        return response()->json($clerks);
    }

    public function updateForAdmin($id, Request $request)
    {
        $clerks = User::findOrFail($id);
        $clerks->name = $request->name;
        $clerks->email = $request->email;
        $clerks->birthday = $request->birthday;
        $clerks->address = $request->address;
        $clerks->save();

        return response()->json($clerks);
    }

    public function createForAdmin(Request $request)
    {
        $clerks = new User();
        $clerks->name = $request->name;
        $clerks->email = $request->email;
        $clerks->password = Hash::make($request->password);
        $clerks->birthday = $request->birthday;
        $clerks->address = $request->address;
        $clerks->role = UserRole::Clerk;
        $clerks->save();

        return response()->json($clerks);
    }

    public function deleteForAdmin($id)
    {

    }

}
