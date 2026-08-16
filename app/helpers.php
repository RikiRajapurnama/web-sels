<?php

use App\Models\WebsiteSetting;
use App\Support\SiteData;

if (!function_exists('site_setting')) {
    function site_setting(string $key, ?string $default = null): ?string
    {
        return WebsiteSetting::get($key, $default);
    }
}

if (!function_exists('sales_profile')) {
    function sales_profile(): \App\Models\SalesProfile
    {
        return SiteData::salesProfile();
    }
}
