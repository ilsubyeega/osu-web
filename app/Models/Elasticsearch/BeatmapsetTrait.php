<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models\Elasticsearch;

use App\Traits\EsIndexable;
use Carbon\Carbon;
use Es;

trait BeatmapsetTrait
{
    use EsIndexable;

    public function toEsJson(array $options = [])
    {
        return array_merge([
            'index' => static::esIndexName(),
            'type' => static::esType(),
            'id' => $this->beatmapset_id,
            'body' => $this->esJsonBody(),
        ], $options);
    }
    public static function esIndexName()
    {
        return 'beatmaps';
    }

    public static function esType()
    {
        return 'beatmaps';
    }

    public static function esMappings()
    {
        return array_merge(
            static::ES_MAPPINGS_BEATMAPSETS,
            ['difficulties' => ['properties' => static::ES_MAPPINGS_BEATMAPS]]
        );
    }

    public static function esReindexAll($batchSize = 1000, $fromId = 0, array $options = [])
    {
        $startTime = time();

        $baseQuery = static::withoutGlobalScopes()
            ->with('beatmaps'); // note that the with query will run with the default scopes.

        $count = static::esIndexEach($baseQuery, 'beatmapset_id', $batchSize, $fromId, $options);

        $duration = time() - $startTime;
        \Log::info("Indexed {$count} records in {$duration} s.");
    }

    private function esJsonBody()
    {
        return array_merge(
            $this->esBeatmapsetValues(),
            ['difficulties' => $this->esBeatmapValues()]
        );
    }

    private function esBeatmapsetValues()
    {
        $mappings = static::ES_MAPPINGS_BEATMAPSETS;

        $values = [];
        foreach ($mappings as $field => $mapping) {
            $value = $this[$field];
            if ($value instanceof Carbon) {
                $value = $value->toIso8601String();
            }

            $values[$field] = $value;
        }

        return $values;
    }

    private function esBeatmapValues()
    {
        $mappings = static::ES_MAPPINGS_BEATMAPS;

        $values = [];
        // initialize everything to an array.
        foreach ($mappings as $field => $mapping) {
            $values[$field] = [];
        }

        foreach ($this->beatmaps as $beatmap) {
            foreach ($mappings as $field => $mapping) {
                $values[$field][] = $beatmap[$field];
            }
        }

        return $values;
    }
}
