<?php

namespace App\Models;

use App\Models\Support\Mutators\FormatsTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CommentType extends Model
{
    use FormatsTimestamps, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    public function toArray(): array
    {
        return parent::toArray();
    }
}
