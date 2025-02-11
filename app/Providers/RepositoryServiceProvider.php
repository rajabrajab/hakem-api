<?php

namespace App\Providers;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\DoctorRepositoryInterface;
use App\Interfaces\FamilyMemberRepositoryInterface;
use App\Interfaces\PatientRepositoryInterface;
use App\Interfaces\SpecialtyRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\FamilyMembersRepository;
use App\Repositories\PatientRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\SpecialtyRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(FamilyMemberRepositoryInterface::class, FamilyMembersRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(SpecialtyRepositoryInterface::class, SpecialtyRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
