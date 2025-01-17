<?php

namespace App\Models;

use App\Models\Support\Mutators\FormatsTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use FormatsTimestamps, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'user_id',
        'comment_type_id',
        'commentable_type',
        'commentable_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    public function toArray(): array
    {
        return parent::toArray();
    }

    /**
     * The model morphs to the commentable model.
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * The model belongs to a comment type.
     *
     * BelongsTo
     */
    public function commentType(): BelongsTo
    {
        return $this->belongsTo(CommentType::class);
    }

    /**
     * The model belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The model belongs to a video.
     */
    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
