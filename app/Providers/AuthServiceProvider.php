<?php

namespace App\Providers;

use App\Metier\Security\Actions;
use App\Service;
use App\Utilisateur;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*
        Gate::before(function (Utilisateur $user, $serviceAllow){
	        if($user->employe->service->code == Service::INFORMATIQUE){
		        return true;
	        }
        });
        */

        Gate::define(Actions::CREATE, function (Utilisateur $user, array $serviceAllow){
	        foreach ($serviceAllow as $service)
	        {
		        if ($user->employe->service->code == $service){
        		    return true;
	            }
	        }
	        return false;
        });

        Gate::define(Actions::UPDATE, function (Utilisateur $user, array $serviceAllow){
	        foreach ($serviceAllow as $service)
	        {
		        if ($user->employe->service->code == $service){
	                return true;
		        }
	        }
	        return false;
        });

        Gate::define(Actions::READ, function (Utilisateur $user, Collection $serviceAllow){
        	foreach ($serviceAllow as $service)
	        {
		        if($user->employe->service->code == $service){
			        return true;
		        }
	        }
	        return false;
        });

        Gate::define(Actions::DELETE, function (Utilisateur $user, array $serviceAllow){
	        foreach ($serviceAllow as $service)
	        {
		        if($user->employe->service->code == $service){
        		    return true;
	            }
	        }
	        return false;
        });
    }
}
