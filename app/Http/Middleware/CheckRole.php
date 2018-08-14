<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        //Se não tiver usuário logado, retorna para o login
        if (!auth()->check()){
            return redirect('login');
        }
        //Se não tiver passado as roles como parameotro, retorna a página de erro
        if (!$roles){
            return redirect('login');
        }
        //Verifica as roles passadas e ve se o usuário tem alguma delas
        foreach ($roles as $role){
            if (auth()->user()->hasTheRole($role)){
                return $next($request);
            }
        }
        return redirect('login');

    }
}
