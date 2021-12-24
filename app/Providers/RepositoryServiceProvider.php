<?php

namespace App\Providers;

use App\Contracts\Repositories\Containers\Container;
use App\Contracts\Repositories\Contracts\Contract;
use App\Contracts\Repositories\Departments\Department;
use App\Contracts\Repositories\Users\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Repositories\BaseRepository as BaseRepositoryInterface;

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
        $this->bindContainers();
        $this->bindContracts();
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

    public function bindContainers()
    {
        $this->app->bind(Container::class, \App\Repositories\Containers\Container::class);
    }

    public function bindContracts()
    {
        $this->app->bind(Contract::class, \App\Repositories\Contracts\Contract::class);
    }
}
