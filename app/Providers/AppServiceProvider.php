<?php

namespace App\Providers;

use App\Models\Photo;
use App\Models\Post;
use App\Models\Sanctum\PersonalAccessToken;
use App\Models\Support\Enum\MorphMapEnum;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            MorphMapEnum::USER->value => User::class,
            MorphMapEnum::POST->value => Post::class,
            MorphMapEnum::VIDEO->value => Video::class,
            MorphMapEnum::PHOTO->value => Photo::class,
        ]);

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
