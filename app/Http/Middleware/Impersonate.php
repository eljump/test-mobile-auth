<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Impersonate
{
    private int $impersonateCode;
    private int $impersonateNumsCount;
    private int $phoneNumsCount = 11;

    public function __construct()
    {
        $this->impersonateCode = config('custom.impersonate_code');
        $this->impersonateNumsCount = (int)log10($this->impersonateCode) + 1;
    }

    public function handle(Request $request, Closure $next)
    {

        $request->merge([
            'impersonate ' => false
        ]);

        if (!$request->has('phone')) {
            return $next($request);
        }

        $phone = $request->input('phone');
        $numsCount = (int)log10($phone) + 1;

        if ($numsCount !== $this->phoneNumsCount + $this->impersonateNumsCount) {
            return $next($request);
        }

        $depth = (10 ** $this->impersonateNumsCount);
        $code = $phone % $depth;
        if ($code !== $this->impersonateCode) {
            return $next($request);
        }

        $phone = (int)($phone / $depth);
        $request->replace([
            'phone' => $phone,
            'impersonate ' => true
        ]);

        return $next($request);
    }
}
