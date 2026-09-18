<?php

namespace App\Http\Middleware;

use App\Services\PermissionService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission {
    public function __construct(
        protected PermissionService $permissionService
    ) {}

    public function handle(
        Request $request,
        Closure $next,
        string  $permissions
    ): Response {

        $permissionList = explode('|', $permissions);

        foreach ($permissionList as $permission) {

            [$module, $action] = explode('.', $permission, 2);

            if ($this->permissionService->can($module, $action)) {
                return $next($request);
            }
        }

        abort(403);
    }
}
