<?php

namespace Pokemon\Http\Middleware;

class OnlyAjax
{
    public function handle($request, \Closure $next)
    {
        if (! $request->ajax()) {
            return response('Forbidden. Only ajax requests accepted', 403);
        }

        return $next($request);
    }
}
