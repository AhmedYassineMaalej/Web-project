<?php

namespace App\Entities;

class Cart {
    public int $id;
    public int $userId;
    public float $totalPrice;
    public string $createdAt;
    public string $updatedAt;
    private array $items = [];

    public function __construct(int $id, int $userId, float $totalPrice, string $createdAt, string $updatedAt) {
        $this->id = $id;
        $this->userId = $userId;
        $this->totalPrice = $totalPrice;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getItems(): array {
        return $this->items;
    }

    public function setItems(array $items): void {
        $this->items = $items;
    }

    public function addItem(CartItem $item): void {
        $this->items[] = $item;
        $this->recalculateTotal();
    }

    public function removeItem(int $itemId): void {
        foreach ($this->items as $key => $item) {
            if ($item->id === $itemId) {
                unset($this->items[$key]);
                break;
            }
        }
        $this->items = array_values($this->items);
        $this->recalculateTotal();
    }

    public function recalculateTotal(): void {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getSubtotal();
        }
        $this->totalPrice = $total;
    }

    public function getTotalCost(): float {
        return $this->totalPrice;
    }

    public function getItemCount(): int {
        $count = 0;
        foreach ($this->items as $item) {
            $count += $item->quantity;
        }
        return $count;
    }

    public function isEmpty(): bool {
        return empty($this->items);
    }
}