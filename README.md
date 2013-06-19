Spil Games API PHP client
========================

Please read the documentation on:

[Developer Platform - PHP Client](http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_PHP_inclusion)

Testing
========================

Requirements
------------
- PHPUnit >= 3.7

Before you can test, you need to check the secret and or token settings in `tests/test.settings.php`.
You can also send the token and secret via the cli parameters

`--token="UwAB_YOUR_APPTOKEN"`

`--secret="secret"`

Examples
------------

`phpunit tests/SpilGamesTest.php`

`phpunit tests/SpilGamesTest.php  --token="UwAB_YOUR_APPTOKEN"`

`phpunit tests/SpilGamesTest.php  --secret="secret"`

`phpunit tests/SpilGamesTest.php  --token="UwAB_YOUR_APPTOKEN" --secret="secret"`