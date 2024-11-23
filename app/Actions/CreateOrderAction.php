<?php

namespace App\Actions;

use App\DTO\CreateOrderDTO;
use App\Repositories\OrderRepository;
use App\Repositories\ReminderRepository;
use Illuminate\Database\Eloquent\Model;

readonly class CreateOrderAction
{
    /**
     * @param OrderRepository $orderRepository
     * @param ReminderRepository $reminderRepository
     */
    public function __construct(
        private OrderRepository $orderRepository,
        private ReminderRepository $reminderRepository,
    )
    {}

    /**
     * @param CreateOrderDTO $createOrderDTO
     * @return Model
     */
    public function __invoke(CreateOrderDTO $createOrderDTO): Model
    {
        $replacementOrder = $this->orderRepository->getLastOrderByTypeAndUserId($createOrderDTO->getUserId(), $createOrderDTO->getOrderType());
        if (!empty($replacementOrder)) {
            $this->reminderRepository->update($replacementOrder->id);
        }

        $order = $this->orderRepository->create($createOrderDTO->toArray());
        $this->reminderRepository->create($order->toArray());

        return $order;
    }
}
