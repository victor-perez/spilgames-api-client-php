<?php
    require_once('../SpilGames.php');
    class SpilGamesTest extends  PHPUnit_Framework_TestCase {
        public function testUserGet() {
            SpilGames::call(SpilGames::USER_GET, null, function ($result) {
                $this->assertArrayHasKey('data', $result);
            });
        }
    }