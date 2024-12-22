<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EndTimeAfterStartTime implements ValidationRule
{
    public function __construct(private string $startTime)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startTime = Carbon::createFromFormat('H:i', $this->startTime);
        $endTime = Carbon::createFromFormat('H:i', $value);

        $endTime->diffInMinutes($startTime) >= 60 ?: $fail('The :attribute must be at least 1 hour after the start time.');
    }
}
