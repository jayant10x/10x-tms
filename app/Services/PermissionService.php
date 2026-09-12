<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class PermissionService {
    protected array $permissions;

    public function __construct() {
        $this->permissions = require app_path(
            'Permissions/permissions.php'
        );
    }


    /**
     * Get the currently logged-in user's role.
     */
    public function role(): ?string {
        if (!Auth::check()) {
            return null;
        }

        return Auth::user()->adm_role;
    }


    /**
     * Get all permissions for the logged-in user.
     */
    public function all(): array {
        $role = $this->role();

        if (!$role) {
            return [];
        }

        return $this->permissions[$role] ?? [];
    }


    /**
     * Get a particular module.
     *
     * Example:
     * permissionService()->module('employees');
     */
    public function module(string $module): ?array {
        return $this->all()[$module] ?? null;
    }


    /**
     * Check whether the logged-in user has access to a module.
     *
     * Example:
     * permissionService()->hasModule('employees');
     */
    public function hasModule(string $module): bool {
        return isset($this->all()[$module]);
    }


    /**
     * Check add/edit/delete permission.
     *
     * Example:
     * permissionService()->can('employees', 'edit');
     */
    public function can(string $module, string $action): bool {
        $moduleData = $this->module($module);

        if (!$moduleData) {
            return false;
        }

        return (bool)(
            $moduleData['permissions'][$action] ?? false
        );
    }


    /**
     * Get the route name of a module.
     *
     * Example:
     * permissionService()->routeName('employees');
     */
    public function routeName(string $module): ?string {
        return $this->module($module)['route'] ?? null;
    }


    /**
     * Generate the URL for a module.
     *
     * Example:
     * permissionService()->route('employees');
     */
    public function route(
        string $module,
        array  $parameters = [],
        bool   $absolute = true
    ): ?string {

        $routeName = $this->routeName($module);

        if (!$routeName) {
            return null;
        }

        return route(
            $routeName,
            $parameters,
            $absolute
        );
    }


    /**
     * Get module label.
     */
    public function label(string $module): ?string {
        return $this->module($module)['label'] ?? null;
    }


    /**
     * Get module icon.
     */
    public function icon(string $module): ?string {
        return $this->module($module)['icon'] ?? null;
    }


    /**
     * Get complete module data.
     */
    public function get(string $module): ?array {
        return $this->module($module);
    }
}
