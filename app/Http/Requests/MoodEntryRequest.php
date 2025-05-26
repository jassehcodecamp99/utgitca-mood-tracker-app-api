<?php

namespace App\Http\Requests;

use App\Models\MoodEntry;
use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Boolean;

class MoodEntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'mood' => ['required', 'integer', 'in:-2,-1,0,1,2'],
        'feelings' => ['required', 'array'],
        'feelings.*' => ['string'],
        'journal_entry' => ['nullable', 'string'],
        'sleep_hours' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    function save() :bool
    {
        $moodEntry = MoodEntry::find($this->route('moodEntry')) ?? new MoodEntry();
        $moodEntry->user_id = auth()->id();
        $moodEntry->mood = $this->mood;
        $moodEntry->feelings = $this->feelings;
        $moodEntry->journal_entry = $this->journal_entry;
        $moodEntry->sleep_hours = $this->sleep_hours;
        return $moodEntry->save();
}

}