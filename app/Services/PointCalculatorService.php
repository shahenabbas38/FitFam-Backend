<?php

namespace App\Services;

class PointCalculatorService
{
    public static function calculate(array $data): int
    {
        $points = 0;

        if (($data['steps'] ?? 0) >= 1000) {
            $points += 10;
        }

        if (!empty($data['completed_challenge'])) {
            $points += 50;
        }

        if (!empty($data['invited_family'])) {
            $points += 30;
        }

        if (!empty($data['active_day'])) {
            $points += 20;
        }

        return $points;
    }

    public static function assignBadge(int $points): string
    {
        if ($points >= 100) {
            return 'Gold 🥇';
        } elseif ($points >= 50) {
            return 'Silver 🥈';
        } else {
            return 'Bronze 🥉';
        }
    }

    public static function assignVirtualReward(int $points): ?string
    {
        return $points >= 1000 ? 'مبروك! ربحت 5$ 🎉' : null;
    }
}
