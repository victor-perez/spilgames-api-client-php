<?php
    /**
     * Spil Games PHP API client
     * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_PHP_inclusion
     * @author Spil Games <integrationsupport@spilgames.com>
     * @copyright 2013 Spil Games
     * @version 1.0.2
     */
    class SpilGames {
        ################## Public API ##################
        /**
         * @var string contains client version
         * @see https://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_Constants#CLIENT_VERSION
         */
        const CLIENT_VERSION = "1.0.2";
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_Constants#STATE_LOGGEDIN
         */
        const STATE_LOGGEDIN = 'logged-in';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_Constants#STATE_LOGGEDOUT
         */
        const STATE_LOGGEDOUT = 'logged-out';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_Constants#LEVEL_GUEST
         */
        const LEVEL_GUEST = 'guest';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_Constants#LEVEL_USER
         */
        const LEVEL_USER = 'user';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_Constants#STATE_PAYMENT_CLOSED
         */
        const STATE_PAYMENT_CLOSED = "payment-closed";
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_Constants#STATE_PAYMENT_SUCCESS
         */
        const STATE_PAYMENT_SUCCESS = "payment-success";
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_Constants#STATE_PAYMENT_FAILURE
         */
        const STATE_PAYMENT_FAILURE = "payment-failure";
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_Constants#STATE_PAYMENT_PENDING
         */
        const STATE_PAYMENT_PENDING = "payment-pending";
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_Constants#STATE_PAYMENT_CANCEL
         */
        const STATE_PAYMENT_CANCEL = "payment-cancel";
        ### USER ###
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.user.get
         */
        const USER_GET = "api.user.get";
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.user.getExtended
         */
        const USER_GETEXTENDED = "api.user.getExtended";
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.user.list
         */
        const USER_LIST = "api.user.list";
        ### AUTH ###
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.auth.getApplicationToken
         * @deprecated use AUTH_GETAPPLICATIONTOKEN instead
         */
        const ACCOUNT_GETAPPLICATIONTOKEN = "api.account.getApplicationToken";
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.auth.getApplicationToken
         */
        const AUTH_GETAPPLICATIONTOKEN = "api.auth.getApplicationToken";
        ### FRIEND ###
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.friend.list
         */
        const FRIEND_LIST = "api.friend.list";
        ### PORTAL ###
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.portal.force.auth
         */
        const FORCE_AUTH = 'api.portal.force.auth';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.portal.user.consent
         */
        const USER_CONSENT = 'api.portal.user.consent';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.portal.invite.friends
         */
        const INVITE_FRIENDS = 'api.portal.invite.friends';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.portal.canvas.setSize
         */
        const CANVAS_SETSIZE = 'api.portal.canvas.setSize';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.portal.canvas.setSize
         */
        const PAYMENT_SHOP = 'api.portal.payment.shop';
        ### EVENTS ###
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.event.user.login
         */
        const EVENT_USER_LOGIN  = 'api.event.user.login';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.event.user.logout
         */
        const EVENT_USER_LOGOUT = 'api.event.user.logout';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.event.appauth.changed
         */
        const EVENT_APPAUTH_CHANGED = 'api.event.appauth.changed';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.event.overlay.shown
         */
        const EVENT_OVERLAY_SHOWN = 'api.event.overlay.shown';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_api.event.overlay.hidden
         */
        const EVENT_OVERLAY_HIDDEN = 'api.event.overlay.hidden';
        ### SETTINGS ###
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_PHP_inclusion
         */
        const SETTING_AUTH = 'set.application.token';
        /**
         * @see http://devs.spilgames.com/docs/w/Developer_platform_-_Learning_center_-_API_-_PHP_inclusion
         */
        const SETTING_SECRET = 'set.application.secret';
        /**
         * The main interface of the API
         * @param $call string, Contains the name of the call for the API, for example "api.user.get".
         * @param $data array|null, Contains the data that is needed for the call, if no extra data is needed for the call you can use NULL
         * @param $callback function, Contains the callback function, if supported.
         */
        public final static function call($call, $data = null, $callback = null) {
            return self::_getInstace()->_call($call, $data, $callback);
        }
        /**
         * Subscribe to the an event
         * @param string $event, event name
         * @param function $subscriber, subscriber that you want to subscrive to the event.
         */
        public final static function subscribe($event, $subscriber) {
            self::_getInstace()->_subscribe($event, $subscriber);
        }
        /**
         * unsubscribe from an event
         * @param string $event, event name
         * @param function $subscriber, subscriber that you want to unsubscrive from the event.
         */
        public final static function unsubscribe ($event, $subscriber) {
            self::_getInstace()->_unsubscribe($event, $subscriber);
        }
        /**
         * Set some settings that are needed for Backend to backend communication
         * @param string $key, name of the setting
         * @param mixed $value, value of the setting
         */
        public final static function set ($key, $value) {
            self::_getInstace()->_set($key, $value);
        }
        ################## end Public API ##################

        /**
         * Array with all subscribers for the SpilGames event system
         * @var array
         */
        private $_subscribers = array();
        /**
         * Array with all settings
         * @var array
         */
        private $_settings = array();
        /**
         * Instance of the SpilGames
         * @var SpilGames
         */
        private static $_instance = null;
        /**
         * SpilGames constuctor
         */
        protected final function __construct () {
            //set apptoken
            if(isset($_REQUEST['apptoken'])) {
                $this->_settings[self::SETTING_AUTH] = $_REQUEST['apptoken']
            } else if (isset($_REQUEST['appToken'])) {
                $this->_settings[self::SETTING_AUTH] = $_REQUEST['appToken']
            } else {
                $this->_settings[self::SETTING_AUTH] = "";
            }
        }
        /**
         * Set some settings that are needed for Backend to backend communication
         * @param string $key, name of the setting
         * @param mixed $value, value of the setting
         */
        private final function _set($key, $value) {
            $this->_settings[$key] = $value;
        }
        /**
         * Main API calls controller
         * @param string $call, name of the API call that you want to do
         * @param array|null $data, data that you want to send along the API call
         * @param function|null $callback, callback function that will handle the API result
         * @return array, result of the API call
         */
        private final function _call($call, $data, $callback) {
            //check of a token is set, else return errro
            if (empty($this->_settings[self::SETTING_AUTH])) {
                return $this->_makeResult($this->_makeError('Application-token is missing, please provide an application-token'), $callback);
            }
            //check of secret is set
            if (empty($this->_settings[self::SETTING_SECRET])) {
                return $this->_makeResult($this->_makeError(
                        'Application-secret is missing, please provide an application-secret', 0, 'use SpilGames::set(SpilGames::SETTINGS_SECRET, "yoursecret") to set an secret'),
                    $callback);
            }
            //parse call string
            $call = substr($call, 3); // -api
            list($prefix, $other) = explode('.', $call, 2);
            //event api calls
            if ($prefix === 'event') {
                return $this->_makeResult($this->_makeError('Event is not supported, use SpilGames::subscribe'), $callback);
            }
            //portal api calls
            if ($prefix === 'portal') {
                return $this->_makeResult($this->_makeError('Not supported on the backend'), $callback);
            }
            //return token
            if ('api' . $call  === self::AUTH_GETAPPLICATIONTOKEN) {
                //check of token is valid
                try {
                    $this->_parseToken($this->_settings[self::SETTING_AUTH]);
                    //token is valid, return token
                    $result = array (
                        "appAuth" =>array(
                            "token"=> $this->_settings[self::SETTING_AUTH]
                        )
                    );  
                } catch (Exception $tokenError) {
                    //return error
                    $result = $this->_makeError($tokenError->getMessage(), 0, 'The application has provided an invalid token or the secret is invalid');
                }
                //return result
                return $this->_makeResult($result, $callback);
            }
            //spapi call
            $result = $this->_spapiRequest(str_replace('.', '/', $call) , $data);
            return $this->_makeResult($result, $callback);
        }
        /**
         * Subscribe to the an event
         * @param string $event, event name
         * @param function $subscriber, subscriber that you want to subscrive to the event.
         */
        private final function _subscribe($event, $subscriber) {
            if (!isset($this->_subscribers[$event])) {
                $this->_subscribers[$event] = array();
            }
            $this->_subscribers[$event][] = $subscriber;
        }
        /**
         * unsubscribe from an event
         * @param string $event, event name
         * @param function $subscriber, subscriber that you want to unsubscrive from the event.
         */
        private final function _unsubscribe($event, $subscriber) {
            //check of event has subscribers
            if (isset($this->_subscribers[$event])) {
                //loop through all subscribers
                for ($i = 0, $max = count($this->_subscribers[$event]); $i < $max; $i++) {
                    //check of subscriber match test subscriber in subscribers list
                    if ($subscriber === $this->_subscribers[$event][$i]) {
                        //remove subscriber
                        unset($this->_subscribers[$event][$i]);
                    }
                }
            }
        }
        /**
         * publish event to the event system
         * @param string $event, event name
         * @param array, data that you want to send along with the event
         */
        private final function _publish($event, $data) {
            //check of event has subscribers
            if (isset($this->_subscribers[$event])) {
                for ($i = 0, $max = count($this->_subscribers[$event]); $i < $max; $i++) {
                    call_user_func($this->_subscribers[$event][$i], $data);
                }
            }
        }
        /**
         * Will make the request to SPAPI ( SpilGames Public API) and will return the result of the call
         * @param string $path, path of the RESTApi call
         * @param array|null $data, data that you want to send along the API call
         * @return array, SPAPI request result
         */
        private final function _spapiRequest ($path, $data) {
            //settings
            $host = 'api.spilgames.com';
            $port = 443;
            $crlf = "\r\n";
            $timeout = 2;
            //check of call has token
            if (!isset($data['auth'])) {
                $data['auth'] = array('token'=>$this->_settings[self::SETTING_AUTH]);
            }
            //check of token is valid
            try {
                $this->_parseToken($data['auth']['token']);
            } catch (Exception $tokenError) {
                //return error
                return $this->_makeError($tokenError->getMessage(), 0, 'The application has provided an invalid token or the secret is invalid');
            }
            //encode token
            $encodeData = json_encode($data);
            //build connection
            $context = stream_context_create();
            stream_context_set_option($context, 'ssl', 'verify_host', true);
            $fp = stream_socket_client('ssl://' . $host . ':' . $port, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT, $context);
            //check connection
            if(!$fp) {
                return $this->_makeError($errstr, $errno);
            }
            //set timeout
            stream_set_timeout($fp, $timeout);
            //headers
            $sendData = 'POST ' . $path . '/ HTTP/1.1' . $crlf;
            $sendData .= 'Host: ' . $host . $crlf;
            $sendData .= 'User-Agent: SpilGames-API-PHP-Client-v' . self::CLIENT_VERSION . $crlf;
            $sendData .= 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8' . $crlf;
            $sendData .= 'Accept-Encoding: gzip, deflate' . $crlf;
            $sendData .= 'Content-length: '. strlen($encodeData). $crlf;
            $sendData .= 'X-App-Sig: ' . base64_encode(sha1($encodeData . $this->_settings[self::SETTING_SECRET], true)) . $crlf;
            //extra header
            $sendData .= 'Connection: keep-alive' . $crlf . $crlf;
            $sendData .= $encodeData . $crlf . $crlf;
            //send
            //exit;
            fwrite($fp, $sendData);
            //read content and headers
            $content = null;
            $headers = array();
            $lineNr = 0;
            $responceCode = 0;
            while (!feof($fp)) {
                //get line
                $line = stream_get_line($fp, 1024, $crlf);
                //first line contains http responce code.
                if ($lineNr === 0) {
                    $firstLine = preg_match('@HTTP/[1-9][0-9]*.[1-9][0-9]*\s([1-9][0-9]*)\s(.*)@', $line, $firstLineData);
                    $responceCode = intval($firstLineData[1]);
                    //bigger than 300 is always a error for the SPAPI
                    if($responceCode >= 300) {
                        //close on error
                        fclose($fp);
                        //return error
                        return $this->_makeError($firstLineData[0], $responceCode, $firstLineData[2]);
                    }
                }
                //headers and content
                if ($lineNr > 0) {
                    //headers
                    if ($content === null) {
                        //check of line is empty ( first line what is empty separate header - body)
                        if (!empty($line)) {
                            list($key, $value) = explode(':', $line, 2);
                            //remove left space
                            $value = substr($value, 1);
                            //exists header already
                            if (isset($headers[$key])) {
                                //is header already a array?
                                if (is_array($headers[$key])) {
                                    //add header value to header array
                                    $headers[$key][] = $value;
                                } else {
                                    //change single header to header array
                                    $headers[$key] = array($headers[$key], $value);
                                }
                            } else {
                                //add header
                                $headers[$key] = $value;
                            }
                        } else {
                            $content = '';
                            //break loop on empty body responce codes
                            if ($responceCode === 204 || ($responceCode >= 100 && $responceCode < 200)) {
                                break;
                            }
                            //if Content-Length header is set use content header param to read body
                            if (isset($headers['Content-Length'])) {
                                $content = fread($fp, intval($headers['Content-Length']));
                            }
                            //transfer-length
                            stream_get_line($fp, 128, $crlf);
                        }
                    } else {
                        //end part
                        if (trim($line) === "0") {
                            break;
                        }
                        //add line to the content
                        $content .= $line;
                    }
                }
                //next line nr
                $lineNr++;
            }
            //close connection
            fclose($fp);
            //json decode
            $jsonContent = json_decode($content, true);
            //check for errors
            if ($jsonContent === null) {
                //default error
                $errorMessage =  'Unknown error';
                //check
                if (function_exists('json_last_error')) {
                    switch (json_last_error()) {
                        case JSON_ERROR_DEPTH:
                            $errorMessage = 'Maximum stack depth exceeded';
                            break;

                        case JSON_ERROR_STATE_MISMATCH:
                            $errorMessage = 'Underflow or the modes mismatch';
                            break;

                        case JSON_ERROR_CTRL_CHAR:
                            $errorMessage = 'Unexpected control character found';
                            break;

                        case JSON_ERROR_SYNTAX:
                            $errorMessage = 'Syntax error, malformed JSON';
                            break;

                        case JSON_ERROR_UTF8:
                            $errorMessage = 'Malformed UTF-8 characters, possibly incorrectly encoded';
                    }
                }
                //return error
                return $this->_makeError($errorMessage, 0, null, $content);
            }
            //parse and return result
            return $this->_parseResult($jsonContent);
        }
        /**
         * Parse backend result, and will return the parse result
         * @param string $result, backend result
         * @return array, the parse result.
         */
        private final function _parseResult($result) {
            //check error in responce
            if (isset($result['error'])) {
                return $this->_makeError($result['error'], 0, $result['detail']);
            }
            //check for new auth key
            if (isset($result['appAuth'])) {
                //parse token
                try {
                    $token = $this->_parseToken($result['appAuth']['token']);
                } catch (Exception $tokenError) {
                    //return error
                    return $this->_makeError($tokenError->getMessage(), 0, 'The server has returned an invalid token',  json_encode($result));
                }
                //set new token for next calls
                $this->_set(self::SETTING_AUTH, $result['appAuth']['token']);
                //get state
                $state = self::STATE_LOGGEDOUT;
                if ($token['authorization_level'] === 1) {
                    $state = self::STATE_LOGGEDIN;
                }
                //trigger event
                $this->_publish(self::EVENT_APPAUTH_CHANGED , array('state'=>$state));
                unset($result['appAuth']);
            }
            //remove auth, this should never happen
            if (isset($result['auth'])) {
                unset($result['auth']);
            }
            //return result
            return $result;
        }
        /**
         * Will check of the token is valid and will return the parse token.
         * This method will throw execptions if the token is not valid!
         * @param string $token, the token that you want to check
         * @return array, the parse token
         */
        private final function _parseToken ($token) {
            //token header
            $header = substr($token, 0, 4);
            //decode code token
            $rawToken = base64_decode(str_pad(strtr($token, '-_', '+/'), strlen($token) % 4, '='));
            //check apptoken header
            if ($header !== 'UwAB') {
                throw new Exception ("Invalid token header");
            }
            //spil signature
            $spilSignature = substr($rawToken, -40, 20);
            //app signature
            $appSignature = substr($rawToken, -20);
            //raw data
            $rawData = substr($rawToken, 0, -40);
            //calculated app sig
            $calculatedAppSig = sha1( $rawData . $spilSignature . $this->_settings[self::SETTING_SECRET], true);
            //check signature
            if ($calculatedAppSig !== $appSignature) {
                throw new Exception("Invalid application signature");
            }
            //decode data
            $decodeData = unpack("a1magic_byte/Cversion/Ctype/Creserved/Ckeyspace/Ckey/Ngid_high/Ngid_low/nsite/Cchannel/Cauthorization_level/Ntimestamp/NappId_high/NappId_low/a*profilar_username", $rawData);
            //check keyspace
            if ($decodeData['keyspace'] > 1) {
                throw new Exception("Invalid keyspace");
            }
            //retrun data
            return $decodeData;
        }
        /**
         * Creates an error as specified in the documentation
         * @param string $err, the main error string ( required )
         * @param int $errorCode, error code of the error
         * @param string $errorString, option extra error explanation
         * @param string $backendResult, the result of the bakend, if the error occurs after the backend call
         * @return array, the error
         */
        private final function _makeError($err, $errorCode = 0, $errorString = null,  $backendResult = null) {
            //error
            $error = array(
                'isError' => true,
                'error' => $err,
                'errorCode' => $errorCode,
                'errorString' =>  $errorString
            );
            //set error string to error if errorString is null
            if ($errorString === null) {
                $error['errorString'] = $err;
            }
            //add backend error
            if ($backendResult !== null) {
                $error['backendResult'] = $backendResult;
            }
            return $error;
        }
        /**
         * Will make the result of the API as specified in the documentation
         * And will call the callback if provided.
         * @param array $data, any backend result
         * @param function|null $callback
         * @return array, API result
         */
        private final function _makeResult($data, $callback) {
            $noDataKeys = array("pageControl");
            $result = array();
            if (isset($data['isError']) && $data['isError'] === true) {
                $result = $data;
            } else {
                //use first record in the array, most result of the SPAPI will have only 1 key.
                $result = array_merge($data, array(
                    'isError' => false,
                    'data' => current($data)
                ));                
                //check of the result has more keys, if so we need to find the correct data key
                if (count($data)  > 1) {
                    foreach ($data as $key=>$value) {
                        //check of the key is in the no data key list
                        if(!in_array($key, $noDataKeys)) {
                            //set the $value as data
                            $result['data'] = $value;
                            break;
                        }
                    }
                }
            }
            //check for callback
            if ($callback !== null) {
                //callback
                call_user_func($callback, $result);
            }
            return $result;
        }
        /**
         * Get instance from the SpilGame object
         * @final
         * @static
         * @return SpilGames
         */
        private final static function _getInstace() {
            if (self::$_instance === null) {
                self::$_instance = new SpilGames();
            }
            return self::$_instance;
        }

    }
    /**
     * SpilGames function, main function to call the API.
     * @see URL_TO_THE_API
     * @param string $call, name of the API call that you want to do
     * @param array|null $data, data that you want to send along the API call
     * @param function|null $callback, callback function that will handle the API result
     * @return array, result of the API call
     */
    function SpilGames($call, $data = null, $callback = null) {
        return SpilGames::call($call, $data, $callback);
    }
