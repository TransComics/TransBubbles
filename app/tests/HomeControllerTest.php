<?php

class HomeControllerTest extends TestCase {

	public function setUp() {
		parent::setUp(); 
 
		$this->client->setServerParameter('HTTP_ACCEPT_LANGUAGE', 'en');
	}
	
	public function testIndex() {
		$this->client->request('GET', '/');
		$this->assertResponseOk();
	}

}
