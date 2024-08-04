<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->city(),
            'country' => fake()->countryCode(),
            'state' => fake()->state(),
            'latitude' => fake()->latitude($min = -90, $max = 90),
            'longitude' => fake()->longitude($min = -180, $max = 180),
            'alias' => null,
        ];
    }

    public function as_sp(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'São Paulo',
            'country' => 'BR',
            'state' => 'São Paulo',
            'latitude' => -23.5506507,
            'longitude' => -46.6333824,
            'alias' => [
                "Сан-Паулу",
                "Сан-Паулу",
                "Сао Паоло",
                "San-Paŭlo",
                "San-Paulu",
                "São Paulo",
                "São Paulo",
                "ސައޮ ޕައުލޯ",
                "سائوپائولو",
                "ساو باولو",
                "Сао Пауло",
                "ساؤ پالو",
                "साओ पाओलो",
                "San Pauluw",
                "Сао Пауло",
                "São Paulo",
                "Сан-Паўлу",
                "聖保羅",
                "Sawo Pålo",
                "סאו פאולא",
                "ಸಾವೊ ಪೌಲೊ",
                "Sao Paulo",
                "Сан Паулу",
                "San Paulas",
                "São Paulo",
                "Սան Պաուլո",
                "เซาเปาลู",
                "São Paulo",
                "ሳው ፓውሉ",
                "상파울루",
                "Сан-Паулу",
                "ਸਾਓ ਪਾਓਲੋ",
                "Σάο Πάολο",
                "San Paulo",
                "São Paulo",
                "სან-პაულუ",
                "サンパウロ",
                "Sao Paulo",
                "San Paulo",
                "Сан-Паулу",
                "São Paulo",
                "സാവോ പോളോ",
                "Сан-Паулу",
                "Sao Paulo",
                "Сан-Паулу",
                "साओ पाउलो",
                "साओ पाउलो",
                "Сан-Паулу",
                "San Pawlo",
                "Сан-Паулу",
                "Сан-Паулу",
                "Paulopolis",
                "San Pablo",
                "সাঁউ পাউলু",
                "São Paulo",
                "Сан-Паулу",
                "சாவோ பாவுலோ",
                "San Paolo",
                "Сан-Паулу",
                "San-Paulu",
                "Сан-Паулу",
                "Sanpaulu",
                "साओ पाउलो",
                "São Paulo",
                "סאו פאולו",
            ],
        ]);
    }
}
