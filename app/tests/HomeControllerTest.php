<?php

class HomeControllerTest extends TestCase {

	public function setUp() {
		parent::setUp(); 
 
		$this->client->setServerParameter('HTTP_ACCEPT_LANGUAGE', 'en');
	}
	
	public function testIndex() {
		
		$this->client->request('GET', '/');
		$this->assertRedirectedToRoute('home.index', ['lang' => 'en']);
		
	}
	public function testIndexInEn() {
		
		$this->client->request('GET', '/en');
		$this->assertResponseOk();
		
	}
	public function testIndexInFr() {
		
		$this->client->request('GET', '/fr');
		 $this->assertResponseOk();
		
	}

}
