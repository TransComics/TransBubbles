<?php

class HomeControllerTest extends TestCase {

	public function testIndex() {
		
		$this->client->request('GET', '/');
		$this->assertRedirectedToRoute('home.index', ['lang']);
		
	}
	public function testIndexInEn() {
		
		$this->client->request('GET', '/en');
		$this->assertResponseOk();;
		
	}
	public function testIndexInFr() {
		
		$this->client->request('GET', '/fr');
		 $this->assertResponseOk();
		
	}

}
