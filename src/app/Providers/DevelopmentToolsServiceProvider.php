<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class DevelopmentToolsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Configure Log Viewer authorization
        $this->configureLogViewerAuth();
    }

    /**
     * Configure Log Viewer authorization.
     */
    protected function configureLogViewerAuth(): void
    {
        if (class_exists(LogViewer::class)) {
            LogViewer::auth(function ($request) {
                // By default, only allow in local environment
                if (app()->environment('local')) {
                    return true;
                }

                // In other environments, require authentication and admin role
                // Uncomment and customize based on your user model:
                // return $request->user() && $request->user()->isAdmin();

                return false;
            });
        }
    }
}
