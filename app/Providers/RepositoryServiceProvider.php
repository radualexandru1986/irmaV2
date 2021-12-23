<?php

namespace App\Providers;

use App\Contracts\Repositories\Departments\Department;
use App\Contracts\Repositories\Users\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Repositories\BaseRespository as BaseRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->bindUsers();
        $this->bindDepartments();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function bindUsers()
    {
        $this->app->bind(User::class, \App\Repositories\Users\User::class);
    }

    public function bindDepartments()
    {
        $this->app->bind(Department::class, \App\Repositories\Departments\Department::class);
    }
}
