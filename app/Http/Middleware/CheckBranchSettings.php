<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckBranchSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $branch_settings = Session::get('branch_settings');
        // dd('sd');
        // dd($branch_settings->settings_completed);
        if ((!isset($branch_settings->settings_completed)) || ($branch_settings->settings_completed == 0)) {
            return redirect('/branch-settings');
        }

        return $next($request);
    }
}
