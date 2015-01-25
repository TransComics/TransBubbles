<?php

class HomeControllerTest extends TestCase {

	public function index() {
		
		$this->client->request('GET', '/');
		$this->assertTrue($this->client->getResponse()->isOk());
		
	}
	public function indexInEn() {
		
		$this->client->request('GET', '/en');
		$this->assertTrue($this->client->getResponse()->isOk());
		
	}
	public function indexInFr() {
		
		$this->client->request('GET', '/fr');
		$this->assertRedirectedToAction('HomeController@index');
		
	}

}
