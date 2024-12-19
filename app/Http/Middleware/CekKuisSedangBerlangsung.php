<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekKuisSedangBerlangsung
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $idKuis = session('id_kuis_sedang_dikerjakan');
        $endTime = session("kuis_{$idKuis}_end_time");

        if (!$endTime || now()->greaterThan($endTime)) {
            // Jika kuis sudah selesai atau tidak ada kuis yang berlangsung
            return redirect('/dashboard')->with('message', 'Kuis sudah selesai atau tidak sedang berlangsung.');
        }
        return $next($request);
        
    }
}
