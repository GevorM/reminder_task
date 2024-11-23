<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreateOrderAction;
use App\DTO\CreateOrderDTO;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderController extends BaseController
{
    /**
     * @param CreateOrderRequest $createOrderRequest
     * @param CreateOrderAction $createOrderAction
     * @param CreateOrderDTO $createOrderDTO
     * @return JsonResponse
     */
    public function store(
        CreateOrderRequest $createOrderRequest,
        CreateOrderAction $createOrderAction,
        CreateOrderDTO $createOrderDTO
    ): JsonResponse
    {
        $orderDTO = $createOrderDTO->init($createOrderRequest->validated());
        $order = $createOrderAction($orderDTO);

        if ($order instanceof Order) {
            return $this->sendResponse($order, 'Order created successfully.', 201);
        } else {
            return $this->sendError($order, 'Error creating order.', 400);
        }
    }
}
