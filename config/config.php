<?php

use Cloudinary\Configuration\Configuration;
use Cloudinary\Cloudinary;
use Cloudinary\Uploader;
require_once __DIR__ . '/../vendor/autoload.php';

$config = new Configuration();
$config->cloud->cloudName = 'empresa';
$config->cloud->apiKey = '333173433478636';
$config->cloud->apiSecret = 'U6qEYTE6_Jy1wqSFZR8tAV9b_uA';
$config->url->secure = true;
$cloudinary = new Cloudinary($config);

$host = "localhost";
$dbname = "crud-empresa";
$user = "postgres";
$password = "123456";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
