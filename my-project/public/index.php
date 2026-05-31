define('LARAVEL_START', microtime(true));

// Auto-redirect installer helper
// If the application is not installed (no .env or storage/installed marker), redirect to /install
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$installedPaths = [
    __DIR__.'/../.env',
    __DIR__.'/laravel_app/.env',
    __DIR__.'/../laravel_app/.env',
    __DIR__.'/storage/installed',
    __DIR__.'/../storage/installed',
    __DIR__.'/laravel_app/storage/installed',
];
$installed = false;
foreach ($installedPaths as $p) {
    if (file_exists($p)) {
        $installed = true;
        break;
    }
}

// Allow installer routes to run even when not installed
if (!$installed && strpos($requestUri, '/install') !== 0) {
    header('Location: /install');
    exit;
}

/**
 * Check If The Application Is Under Maintenance
 */
if (file_exists(__DIR__.'/../storage/framework/maintenance.php')) {
    require __DIR__.'/../storage/framework/maintenance.php';
}
// Bootstrap Laravel and handle the request...
// Ensure Composer autoload is included from possible locations
$autoloadCandidates = [
    __DIR__.'/../vendor/autoload.php',
    __DIR__.'/vendor/autoload.php',
    __DIR__.'/laravel_app/vendor/autoload.php',
    __DIR__.'/../laravel_app/vendor/autoload.php',
];
$loaded = false;
foreach ($autoloadCandidates as $candidate) {
    if (file_exists($candidate)) {
        require $candidate;
        $loaded = true;
        break;
    }
}

// Try to find bootstrap/app.php in common locations
$bootstrapCandidates = [
    __DIR__.'/../bootstrap/app.php',
    __DIR__.'/bootstrap/app.php',
    __DIR__.'/laravel_app/bootstrap/app.php',
    __DIR__.'/../laravel_app/bootstrap/app.php',
];
$app = null;
foreach ($bootstrapCandidates as $b) {
    if (file_exists($b)) {
        /** @var \Illuminate\Foundation\Application $app */
        $app = require_once $b;
        break;
    }
}

if (!$app) {
    header('Content-Type: text/plain; charset=utf-8', true, 500);
    echo "Application bootstrap not found.\n";
    echo "If you placed the Laravel app files in a subfolder (e.g. 'laravel_app'), ensure you uploaded 'vendor' and 'bootstrap' directories and that 'public/index.php' can find them.\n";
    exit;
}

$app->handleRequest(Request::capture());
