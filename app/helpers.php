<?php

use App\Models\SalesProfile;
use App\Models\WebsiteSetting;

if (!function_exists('site_setting')) {
    function site_setting(string $key, ?string $default = null): ?string
    {
        return WebsiteSetting::get($key, $default);
    }
}

if (!function_exists('sales_profile')) {
    function sales_profile(): SalesProfile
    {
        return SalesProfile::get();
    }
}
