<?php

class ComicsViewTest extends TestCase {
    
    public function testComicsList() {
        $this->client->request('GET', '/comics/list');
        $this->assertResponseOk();
    }
    
}
