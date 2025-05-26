<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MoodEntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'mood' => $this->mood,
            'feelings' => $this->feelings,
            'journal_entry' => $this->journal_entry,
            'sleep_hours' => $this->sleep_hours,
            'date' => \Carbon\Carbon::parse($this->date)->toDayDateTimeString() ??  $this->date,
        ];
    }
}
