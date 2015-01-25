<?php

class HomeControllerTest extends TestCase {

	public function testIndex() {
		
		$this->client->request('GET', '/');
		$this->assertRedirectedToAction('HomeController@index');
		
	}
	public function testIndexInEn() {
		
		$this->client->request('GET', '/en');
		$this->assertTrue($this->client->getResponse()->isOk());
		
	}
	public function testIndexInFr() {
		
		$this->client->request('GET', '/fr');
		$this->assertTrue($this->client->getResponse()->isOk());
		
	}

}
