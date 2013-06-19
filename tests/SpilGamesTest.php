<?php
	#inlcude SpilGames lib
	require_once 'src/SpilGames.php';
    /**
     * Spil Games PHP API client tests
     * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_PHP_inclusion
     * @author Spil Games <integrationsupport@spilgames.com>
     * @copyright 2013 Spil Games
     * @version 1.0.0
     */
	class SpilGamesTest extends PHPUnit_Framework_TestCase {
		private static $_config;
		public static function setUpBeforeClass () {
    		//check test file
    		self::$_config = require_once('tests/test.settings.php');
    		if (!is_array(self::$_config)) {
    			self::$_config = array();
    		}
    		//check cli parameters for token and secret
    		foreach ($_SERVER['argv'] as $argv) {
    			if (preg_match("@^--(token|secret)=(.+)@", $argv, $match)) {
    				self::$_config[$match[1]] = trim($match[2], " \t\n\r\0\x0B\x22\x27");
    			}
    		}
    		//set settings
    		SpilGames::set(SpilGames::SETTING_SECRET, self::$_config['secret']);
    		SpilGames::set(SpilGames::SETTING_AUTH, self::$_config['token']);
		}
		/**
		 * Test SpilGames::AUTH_GETAPPLICATIONTOKEN
		 * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.auth.getApplicationToken
		 */
        public function testAuthGetApplicationToken () {
        	$result = SpilGames::call(SpilGames::AUTH_GETAPPLICATIONTOKEN);
        	$this->assertEquals(self::$_config['token'], $result['data']['token']);
        }
        /**
         * Test main constants
         * @see https://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_Constants
         */
        public function testMainConstants () {
            //version
            $this->assertRegExp('@^[1-9][0-9]*\.[0-9]+\.[0-9]+$@',  SpilGames::CLIENT_VERSION);
            //state
            $this->assertEquals('logged-in', SpilGames::STATE_LOGGEDIN);
            $this->assertEquals('logged-out', SpilGames::STATE_LOGGEDOUT);
            //level
            $this->assertEquals('guest', SpilGames::LEVEL_GUEST);
            $this->assertEquals('user', SpilGames::LEVEL_USER);
        }

		/**
		 * Test SpilGames::USER_GET
		 * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.user.get
		 */
        public function testUserGet() {
            $result = SpilGames::call(SpilGames::USER_GET);
			$this->assertInternalType("numeric",  $result['data']['guid']);
            $this->assertInternalType("string",  $result['data']['name']);
            $this->assertInternalType("integer",  $result['data']['age']);
            $this->assertRegExp("@m|f|u@",  $result['data']['gender']);
            $this->assertRegExp("@user|guest@", $result['data']['level']);
            $this->assertRegExp("@^https?://[.a-z0-9-]+/@",  $result['data']['avatarUrl']);
        }
		/**
		 * Test SpilGames::USER_GETEXTENDED
		 * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.user.getExtended
		 */
        public function testUserGetExtended () {
            $result = SpilGames::call(SpilGames::USER_GETEXTENDED);
            $this->assertInternalType("numeric",  $result['data']['guid']);
            $this->assertInternalType("string",  $result['data']['name']);
            $this->assertRegExp("@m|f|u@",  $result['data']['gender']);
            $this->assertRegExp("@^https?://[.a-z0-9-]+/@",  $result['data']['avatarUrl']);
            $this->assertRegExp("@^https?://[.a-z0-9-]+/@",  $result['data']['avatarLargeUrl']);
            $this->assertRegExp("@user|guest@", $result['data']['level']);
            $this->assertInternalType("integer",  $result['data']['age'], "age is not a integer");
            $this->assertInternalType("integer",  $result['data']['numFriends'], "numFriends is not a integer");
        }
		/**
		 * Test SpilGames::USER_LIST
		 * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.user.list
		 */
        public function testUserList () {
            $result = SpilGames::call(SpilGames::USER_LIST, array(
            	"guidList" => array("288516063279296192", "288512283708071058") 
            ));
            $this->assertArrayHasKey("data", $result);
            $this->assertCount(2, $result["data"]);

            for ($i = 0; $i < 2; $i++) {
                $this->assertInternalType("numeric",  $result['data'][$i]['guid']);
                $this->assertInternalType("string",  $result['data'][$i]['name']);
                $this->assertRegExp("@m|f|u@",  $result['data'][$i]['gender']);
                $this->assertEquals("user", $result['data'][$i]['level']);
                $this->assertRegExp("@^https?://[.a-z0-9-]+/@",  $result['data'][$i]['avatarUrl']);
            }

        }
		/**
		 * Test SpilGames::USER_LIST
		 * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.friend.list
		 */
		public function testFriendList() {
            $result = SpilGames::call(SpilGames::FRIEND_LIST);

            $this->assertArrayHasKey("data", $result);
            $this->assertArrayHasKey("pageControl", $result);
            if ($result['data']['0']) {
        		$this->assertInternalType("numeric",  $result['data']['0']['guid']);
                $this->assertInternalType("string",  $result['data']['0']['name']);
                $this->assertRegExp("@m|f|u@",  $result['data']['0']['gender']);
                $this->assertRegExp("@user|guest@", $result['data']['0']['level']);
                $this->assertRegExp("@^https?://[.a-z0-9-]+/@",  $result['data']['0']['avatarUrl']);
             }
        }
	}