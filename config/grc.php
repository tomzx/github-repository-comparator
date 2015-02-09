<?php

return [
	'client_id' => env('GITHUB_CLIENT_ID'),
	'client_secret' => env('GITHUB_CLIENT_SECRET'),

	'cache' => [
		'lifetime' => env('GRC_CACHE_LIFETIME', 60*60),
	]
];
