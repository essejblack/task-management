<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

if (!function_exists('vd')) {
    function vd(...$vars): void
    {
        var_dump(...$vars);
        exit();
    }
}