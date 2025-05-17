<?php

namespace App\Providers;

use App\Repository\IAdminRepository;
use App\Repository\IClassScheduleRepository;
use App\Repository\Implementations\AdminRepository;
use App\Repository\Implementations\ClassScheduleRepository;
use App\Repository\Implementations\TeacherRepository;
use App\Repository\ITeacherRepository;
use App\Services\IAdminServices;
use App\Services\IClassScheduleServices;
use App\Services\implementations\AdminService;
use App\Services\implementations\ClassScheduleService;
use App\Services\implementations\TeacherService;
use App\Services\ITeacherServices;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Class Schedule
        $this->app->bind(IClassScheduleRepository::class, ClassScheduleRepository::class);
        $this->app->bind(IClassScheduleServices::class, ClassScheduleService::class);

        // Teacher
        $this->app->bind(ITeacherRepository::class, TeacherRepository::class);
        $this->app->bind(ITeacherServices::class, TeacherService::class);

        // Admin
        $this->app->bind(IAdminRepository::class, AdminRepository::class);
        $this->app->bind(IAdminServices::class, AdminService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
