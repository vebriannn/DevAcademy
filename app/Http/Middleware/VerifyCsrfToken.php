<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'admin/tools',
        'admin/tools/create/store',
        'admin/tools/edit/update/*',
        'admin/tools/delete/*',
        'admin/chapter',
        'admin/chapter/create/store',
        'admin/chapter/edit/update/*',
        'admin/chapter/delete/*',
        'admin/lesson',
        'admin/lesson/create/store',
        'admin/lesson/edit/update/*',
        'admin/lesson/delete/*'
    ];
}