<?php

namespace App\Repositories;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderRepository extends BaseRepositories
{
    public function __construct()
    {
        parent::__construct(new Order());
    }

    public function getLastOrderByTypeAndUserId(int $userId, string $orderType)
    {
        return $this->model->where('order_type', $orderType)
            ->where('user_id', $userId)
            ->where('expiration_date', '>=', Carbon::now())
            ->orderBy('created_at', 'desc')->first();
    }
}
