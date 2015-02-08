<?php

class ExampleTest extends TestCase {
	public function testIndex()
	{
		$response = $this->call('GET', '/');

		$this->assertEquals(200, $response->getStatusCode());
	}
}
