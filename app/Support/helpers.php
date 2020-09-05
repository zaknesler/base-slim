<?php

if (!function_exists('_env')) {
    /**
     * Fetch an item from the application's environment file.
     *
     * @param  string  $key
     * @param  string  $default
     * @return string
     */
    function _env($key, $default = null)
    {
        return $_SERVER[$key] ?? $default;
    }
}
