<?php

namespace App\Http\Middleware;

use App\Models\Models\Permissao;
use App\Models\Models\Role;
use App\Models\Models\Rota;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route as FacadesRoute;
use PhpParser\Node\Stmt\TryCatch;

class EnsureUserRoleIsAllowedToAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       /*  echo 'The middleare for access role runs everytime a http request is made'; */



        /* echo 'UserRole: ' . $userRole . '<br/>';
        echo 'Current Route: ' . $route . '<br/>'; */
        $userRole = Auth()->user()->role_id;
        $route = FacadesRoute::currentRouteName();
        $rota = Rota::where('nome', $route)->first();

        try {
            if (
                Permissao::isRoleHasRightToAccess($userRole, $rota->id)
                || in_array($route, $this->userAccessRole()[$userRole])) {
                return $next($request);
            } else {
                abort(403, 'Não Autorizado!');
            }
        } catch (\Throwable $th) {
            abort(403, 'Você não esta autorizador a aceder essa página!');
        }

        /* exit;
        return $next($request); */
    }

    private function userAccessRole()
    {
        $admin = Role::with('rotas')->where('nome', 'admin')->first();
        return [
            $admin->id => [
                'user',
                'permissao',
                'rota',
                'role'
            ]
        ];
    }
}
