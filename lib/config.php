<?php
header("charset=utf-8");

// Database
define("HOST", "localhost");
define("USER", "luis_dias");
define("PASSWORD", "XPk4hWPeTVdtKwEU");
define("DATABASE", "php_test");
define("CHARSET", "utf8");

try {
	$pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . ";charset=" . CHARSET, USER, PASSWORD);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
	header("HTTP/1.0 503 Service Unavailable", true, 503);
	exit();
}

// API
define("API_URL", "http://localhost/php-test/api/");
define("API_SECURE", false);

function get_randon_token ($size) {
	$size = intval($size);

	if ($size % 2 === 1)
		$size++;
	
	return bin2hex(openssl_random_pseudo_bytes($size/2));
}