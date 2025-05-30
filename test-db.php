<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $pdo = DB::connection()->getPdo();
    echo "Database connection successful!\n";
    echo "Database: " . DB::connection()->getDatabaseName() . "\n";
} catch (\Exception $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
} 