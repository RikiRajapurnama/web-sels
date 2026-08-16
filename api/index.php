<?php

declare(strict_types=1);

use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Vercel (serverless) runtime defaults
|--------------------------------------------------------------------------
| Every Vercel function runs in a fresh, stateless container. Anything
| written to the local filesystem is lost after the request, so we point
| every Laravel cache / compiled-view path at /tmp (writable, ephemeral).
| Values already provided through the Vercel dashboard are never
| overridden.
*/

$vercelDefaults = [
    'APP_CONFIG_CACHE' => '/tmp/config.php',
    'APP_EVENTS_CACHE' => '/tmp/events.php',
    'APP_PACKAGES_CACHE' => '/tmp/packages.php',
    'APP_ROUTES_CACHE' => '/tmp/routes.php',
    'APP_SERVICES_CACHE' => '/tmp/services.php',
    'VIEW_COMPILED_PATH' => '/tmp',
    'LOG_CHANNEL' => 'stderr',
];

foreach ($vercelDefaults as $key => $value) {
    if (empty(getenv($key)) && empty($_ENV[$key] ?? null) && empty($_SERVER[$key] ?? null)) {
        putenv("{$key}={$value}");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

require __DIR__.'/../vendor/autoload.php';

/** @var \Illuminate\Foundation\Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| First deploy only: create the schema + seed admin/content
|--------------------------------------------------------------------------
| Vercel has no "artisan" step, so when APP_SEED=true (set in the Vercel
| dashboard) migrations and seeders run on the very first request. Both
| migrate and the seeders are idempotent, so repeating them is safe.
| Set APP_SEED=false once the first deploy has finished.
*/

if (getenv('APP_SEED') === 'true') {
    try {
        $kernel = $app->make(ConsoleKernelContract::class);
        $kernel->call('migrate', ['--force' => true]);
        $kernel->call('db:seed', ['--force' => true]);
    } catch (\Throwable $e) {
        error_log('[Vercel] APP_SEED migrate/seed failed: '.$e->getMessage());
    }
}

$app->handleRequest(Request::capture());
