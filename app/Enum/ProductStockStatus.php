<?php

namespace App\Enum;

enum ProductStockStatus: string
{
    case IN_STOCK = 'in_stock';
    case OUT_OF_STOCK = 'out_of_stock';
    case LOW_STOCK = 'low_stock';
    case PREORDER = 'preorder';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match($this) {
            self::IN_STOCK => 'Tersedia',
            self::OUT_OF_STOCK => 'Habis',
            self::LOW_STOCK => 'Stok Menipis',
            self::PREORDER => 'Pre-order',
        };
    }

    public function badgeClass(): string
    {
        return match($this) {
            self::IN_STOCK => 'badge-success',
            self::OUT_OF_STOCK => 'badge-danger',
            self::LOW_STOCK => 'badge-warning',
            self::PREORDER => 'badge-info',
        };
    }
}