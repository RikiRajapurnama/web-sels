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
|
| Session and cache are also switched to storage that does not depend on a
| database or writable disk (cookie sessions + array cache + sync queue),
| so the customer website and the admin login page keep working even when
| no external database has been configured yet.
|
| Values already provided through the Vercel dashboard are never
| overridden.
*/

$vercelDefaults = [
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'false',
    'APP_LOCALE' => 'id',
    'APP_FALLBACK_LOCALE' => 'en',
    'APP_CONFIG_CACHE' => '/tmp/config.php',
    'APP_EVENTS_CACHE' => '/tmp/events.php',
    'APP_PACKAGES_CACHE' => '/tmp/packages.php',
    'APP_ROUTES_CACHE' => '/tmp/routes.php',
    'APP_SERVICES_CACHE' => '/tmp/services.php',
    'VIEW_COMPILED_PATH' => '/tmp',
    'LOG_CHANNEL' => 'stderr',
    'LOG_LEVEL' => 'info',
    'SESSION_DRIVER' => 'cookie',
    'SESSION_SECURE_COOKIE' => 'true',
    'CACHE_STORE' => 'array',
    'QUEUE_CONNECTION' => 'sync',
    'BROADCAST_CONNECTION' => 'log',
    'FILESYSTEM_DISK' => 'local',
];

foreach ($vercelDefaults as $key => $value) {
    if (empty(getenv($key)) && empty($_ENV[$key] ?? null) && empty($_SERVER[$key] ?? null)) {
        putenv("{$key}={$value}");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

/*
|--------------------------------------------------------------------------
| Database connection
|--------------------------------------------------------------------------
| The website can run before an external database exists: with no database
| configured we fall back to SQLite in-memory semantics so the customer page
| and the admin login page keep loading. As soon as a production database is
| configured (DB_HOST / DB_CONNECTION set in the Vercel dashboard) the app
| connects to it, so the Admin Sales panel can authenticate and save data.
|
| A DB_CONNECTION explicitly set in the dashboard always wins.
*/

if (empty(getenv('DB_CONNECTION')) && empty($_ENV['DB_CONNECTION'] ?? null) && empty($_SERVER['DB_CONNECTION'] ?? null)) {
    $dbHost = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? null) ?: ($_SERVER['DB_HOST'] ?? null);
    $dbConnection = empty($dbHost) ? 'sqlite' : 'mysql';
    putenv("DB_CONNECTION={$dbConnection}");
    $_ENV['DB_CONNECTION'] = $dbConnection;
    $_SERVER['DB_CONNECTION'] = $dbConnection;
}

/*
|--------------------------------------------------------------------------
| Application URL
|--------------------------------------------------------------------------
| Serverless functions run on many hosts/aliases (preview deployments,
| production domain, custom domains). Deriving APP_URL from the incoming
| request guarantees that generated URLs always point at the host the
| visitor is currently using, instead of being hard-coded to one domain.
| A value already configured through the Vercel dashboard is never
| overridden.
*/

if (empty(getenv('APP_URL')) && empty($_ENV['APP_URL'] ?? null) && empty($_SERVER['APP_URL'] ?? null)) {
    $host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? null;

    if ($host) {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower((string) $_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
            $scheme = 'https';
        }

        $appUrl = $scheme.'://'.$host;
        putenv("APP_URL={$appUrl}");
        $_ENV['APP_URL'] = $appUrl;
        $_SERVER['APP_URL'] = $appUrl;
    }
}

/*
|--------------------------------------------------------------------------
| Application encryption key fallback
|--------------------------------------------------------------------------
| A missing APP_KEY makes Laravel throw on every request (the EncryptCookies
| middleware needs an encrypter). If the key was not configured in the Vercel
| dashboard we generate one for this request so the site never 500s because of
| it. For sessions to survive across serverless invocations (login, forms),
| add a stable APP_KEY in the Vercel dashboard: generate one locally with
| `php artisan key:generate --show` and paste it as the APP_KEY value.
*/

if (empty(getenv('APP_KEY')) && empty($_ENV['APP_KEY'] ?? null) && empty($_SERVER['APP_KEY'] ?? null)) {
    $appKey = 'base64:'.base64_encode(random_bytes(32));
    putenv("APP_KEY={$appKey}");
    $_ENV['APP_KEY'] = $appKey;
    $_SERVER['APP_KEY'] = $appKey;
}

/*
|--------------------------------------------------------------------------
| Fail loudly instead of failing silently
|--------------------------------------------------------------------------
| The runtime php.ini sets memory_limit=3008M but the Vercel function is
| limited to 1024M. If a request ever goes near the container limit the OS
| kills the whole process and the user sees an empty 500 with no way to
| diagnose it. Cap PHP well below the container so it raises a normal
| "Allowed memory size exhausted" Error that we can render/log.
|
| We also keep display_errors on for the router: combined with the outer
| try/catch below, any error that escapes Laravel is shown (and written to
| stderr, which Vercel surfaces in the function runtime logs) instead of
| disappearing into an empty response body.
*/

ini_set('memory_limit', '768M');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('log_errors', '1');

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

/*
|--------------------------------------------------------------------------
| Request handling with a safety net
|--------------------------------------------------------------------------
| Laravel catches and renders almost everything itself, but if the
| exception handler ever fails too (double fault), the exception escapes
| uncaught and PHP's built-in server answers with an EMPTY 500 — exactly
| the symptom this project saw. The try/catch below guarantees that any
| error escaping Laravel is written to stderr (visible in the Vercel
| function runtime logs) and, when nothing was sent yet, returned as a
| plain-text 500 so the cause is always visible.
*/

try {
    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    $message = sprintf(
        '[Vercel] Unhandled exception %s: %s @ %s:%d',
        get_class($e),
        $e->getMessage(),
        $e->getFile(),
        $e->getLine()
    );

    fwrite(STDERR, $message.PHP_EOL);

    if (!headers_sent()) {
        http_response_code(500);
        header('Content-Type: text/plain; charset=utf-8');
        echo $message.PHP_EOL;
    }
}
