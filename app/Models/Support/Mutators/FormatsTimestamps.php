<?php

namespace App\Models\Support\Mutators;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait FormatsTimestamps
{
    /**
     * Get the formatted created_at attribute.
     *
     * @param  mixed  $value
     * @return string
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => Carbon::parse($value)->format('Y-m-d H:i:s'),
        );
    }

    /**
     * Get the formatted updated_at attribute.
     *
     * @param  mixed  $value
     * @return string
     */
    protected function updatedAt(): Attribute // Change 'public' to 'protected'
    {
        return Attribute::make(
            get: fn (mixed $value) => Carbon::parse($value)->format('Y-m-d H:i:s'),
        );
    }
}
