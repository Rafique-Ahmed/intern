<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('memory_limit', '1G'); // or -1 for unlimited

require 'vendor/autoload.php'; // Ensure this path is correct relative to your project structure

\Stripe\Stripe::setApiKey('sk_test_51PSF4LFx6VKQ3HS8UqoHC5EMVoOS0vpewOAHuEDjh6WvQ0RB4XhyNZPOtvVLiY40TY0nhiupUnnMxENYAPhFcOIo00dbNS7zHV');

$token = $_POST['stripeToken'];

try {
    $charge = \Stripe\Charge::create([
        'amount' => 999, // Amount in cents (e.g., $9.99)
        'currency' => 'usd',
        'description' => 'Example charge',
        'source' => $token,
    ]);
    echo 'Success! Your payment was successful.';
} catch (\Stripe\Exception\CardException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
