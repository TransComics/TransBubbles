<?php

class HomeControllerTest extends TestCase {

	public function testIndex() {
		
		$this->client->request('GET', '/');
		$this->assertTrue($this->client->getResponse()->isOk());
		
	}
	public function testIndexInEn() {
		
		$this->client->request('GET', '/en');
		$this->assertTrue($this->client->getResponse()->isOk());
		
	}
	public function testIndexInFr() {
		
		$this->client->request('GET', '/fr');
		$this->assertRedirectedToAction('HomeController@index');
		
	}

}
