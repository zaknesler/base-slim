<?php

if (!function_exists('env')) {
    /**
     * Fetch an item from the application's environment file.
     *
     * @param  string  $key
     * @param  string  $default
     * @return string
     */
    function env($key, $default = null)
    {
        return $_SERVER[$key] ?? $default;
    }
}
