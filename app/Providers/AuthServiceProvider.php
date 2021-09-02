<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\User' => 'App\Policies\UserPolicy',
        'App\Especie' => 'App\Policies\EspeciePolicy',
        'App\Variedad' => 'App\Policies\VariedadPolicy',
        'App\Categoria' => 'App\Policies\CategoriaPolicy',
        'App\UnidadMedida' => 'App\Policies\UnidadMedidaPolicy',
        'App\Tamano' => 'App\Policies\TamanoPolicy',
        'App\Producto' => 'App\Policies\ProductoPolicy',
        'App\Permisos' => 'App\Policies\PermisosPolicy',
        'App\Venta' => 'App\Policies\VentaPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isPresidente', function($user){
            return $user->rols->first()->slug == 'presidente';
        });
        Gate::define('isAsociado', function($user){
            return $user->rols->first()->slug == 'asociado';
        });
        //
        Gate::define('isAdministrador', function($user){
            return $user->rols->first()->slug == 'administrador';
        });
    }
}
