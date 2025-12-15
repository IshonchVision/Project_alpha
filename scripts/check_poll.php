<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;

$id = $argv[1] ?? 9;
$req = Request::create('/','GET',['last_id'=>0]);
$ctrl = new App\Http\Controllers\AdminController();
$resp = $ctrl->pollGroupMessages((int)$id, $req);
if (method_exists($resp, 'getData')) {
    echo json_encode($resp->getData(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
    echo (string)$resp;
}
