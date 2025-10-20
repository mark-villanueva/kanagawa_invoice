<?php

namespace App\Traits;

use Carbon\Carbon;

trait FormatsJapaneseEra
{
    protected function formatJapaneseEraForDisplay(null|string|\DateTimeInterface $state): ?string
    {
        if (empty($state)) {
            return null;
        }

        $date = $state instanceof \DateTimeInterface ? Carbon::instance($state) : Carbon::parse((string) $state);

        $eras = [
            ['name' => '令和', 'start' => Carbon::create(2019, 5, 1)],
            ['name' => '平成', 'start' => Carbon::create(1989, 1, 8)],
            ['name' => '昭和', 'start' => Carbon::create(1926, 12, 25)],
        ];

        foreach ($eras as $era) {
            if ($date->greaterThanOrEqualTo($era['start'])) {
                $eraYear = $date->year - $era['start']->year + 1;
                return sprintf('%s%d年%d月', $era['name'], $eraYear, $date->month);
            }
        }

        return $date->format('Y年n月');
    }
}
