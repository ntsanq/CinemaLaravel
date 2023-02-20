<?php

namespace App\Http\Controllers\API;

use App\Http\Traits\ResponseTrait;
use App\Models\Seat;

class SeatController
{
    use ResponseTrait;

    public function info(Seat $id)
    {
        $data = $id->toArray();
        unset($data['created_at'], $data['deleted_at'], $data['updated_at']);

        return $this->success($data);
    }
}
