<?php

class HomeControllerTest extends TestCase {
    public function testIndex() {
            $this->client->request('GET', '/');
            $this->assertResponseOk();
    }
}
