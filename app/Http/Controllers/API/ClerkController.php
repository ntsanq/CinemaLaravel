<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;

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

        foreach ($clerks as &$clerk) {
            switch ($clerk['role']) {
                case UserRole::Clerk:
                    $clerk['role'] = UserRole::getKey(UserRole::Clerk);
                    break;
                case UserRole::Admin:
                    $clerk['role'] = UserRole::getKey(UserRole::Admin);
                    break;
            }
        }

        $total = $paginator->total();
        $data = array_values($clerks);

        return response()->json($data)->header('X-Total-Count', $total);
    }


    public function infoForAdmin($id)
    {

    }

    public function updateForAdmin($id, Request $request)
    {

    }

    public function createForAdmin(Request $request)
    {

    }

    public function deleteForAdmin($id)
    {

    }

}
