<?php
/**
 * This file is part of Kabooodle.
 * Copyright (c) 2018. Kabooodle,LLC <help@kabooodle.com>
 */

namespace Kabooodle\Http\Middleware;

use Messages;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DisableRestfulResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->isNonBlockedMethod($request) && ! app()->isLocal()) {
            Messages::error('Unable to perform action in demo mode.');

            return redirect()->back();
        }

        return $next($request);
    }

    private function isNonBlockedMethod(Request $request): bool
    {
        return $request->isMethod('post') || $request->isMethod('put') || $request->isMethod('delete');
    }
}
