<?php

namespace GRC;

use Debugbar;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use MongoClient;

class Repository
{
	protected $client;
	protected $collection;

	public function __construct()
	{
		$this->client = new Client([
			'base_url' => 'https://api.github.com/',
			'defaults' => [
				'query' => [
					'client_id' => config('grc.client_id'),
					'client_secret' => config('grc.client_secret'),
				],
			],
		]);

		$connection = new MongoClient();
		$db = $connection->grc;
		$this->collection = $collection = $db->{'api.github.com'};
	}

	public function get($repositories)
	{
		$repositories = (array)$repositories;

		$results = [];
		foreach ($repositories as $repository) {
			$result = $this->getOne($repository);
			if ($result) {
				$results[$repository] = $result;
			}
		}

		return $results;
	}

	public function getOne($repository)
	{
		if ( ! $this->isValidRepository($repository)) {
			throw new \RuntimeException('Repository must be follow the vendor/package format');
		}

		list($vendor, $package) = explode('/', $repository);

		$result = $this->collection->findOne(['full_name' => $repository]);

		if ($result && $this->resultNotExpired($result)) {
			return $result;
		}

		try {
			$result = $this->client->get('/repos/'.$vendor.'/'.$package)->json();
		} catch (ClientException $e) {
			return null;
		}

		$result['_grc']['pulls_count'] = $this->getPullRequestCount($vendor, $package);
		$result['_grc']['open_issues_count'] = $result['open_issues_count'] - $result['_grc']['pulls_count'];

		$result = $this->setTrackingProperties($result);
		$this->collection->update(
		[
			'full_name' => $result['full_name'],
		],
			$result,
		[
			'upsert' => true,
		]
		);

		return $result;
	}

	protected function resultNotExpired($data)
	{
		return ($expiresAt = array_get($data, '_grc.expires_at')) && $expiresAt > time();
	}

	protected function getPullRequestCount($vendor, $package)
	{
		$results = $this->client->get('/repos/'.$vendor.'/'.$package.'/pulls')->json();

		return count($results);
	}

	/**
	 * @param $data
	 */
	protected function setTrackingProperties($data)
	{
		array_set($data, '_grc.expires_at', time() + config('grc.cache.lifetime'));
		return $data;
	}

	public function isValidRepository($repository)
	{
		$parts = explode('/', $repository);

		return count($parts) === 2;
	}
}
