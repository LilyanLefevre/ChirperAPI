<?php

namespace App\Providers;

use App\Models\Chirp;
use App\Models\ChirpLike;
use App\Models\Rechirp;
use App\Models\TrendingTopic;
use App\Models\User;
use App\Policies\ChirpLikePolicy;
use App\Policies\ChirpPolicy;
use App\Policies\RechirpPolicy;
use App\Policies\TrendingTopicPolicy;
use App\Policies\UserPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Chirp::class => ChirpPolicy::class,
        ChirpLike::class => ChirpLikePolicy::class,
        Rechirp::class => RechirpPolicy::class,
        TrendingTopic::class => TrendingTopicPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        //
    }
}
