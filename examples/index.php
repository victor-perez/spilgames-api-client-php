<?php
    session_start();
    #inlcude SpilGames lib
    require_once('../src/SpilGames.php');
    #example settings
    require_once('example.settings.php');
    //small test of the secret is set
    if (empty($SpilGamesSecret)) {
        exit('<p><mark>The $SpilGamesSecret is empty in the example.settings.php, you must enter your SpilGames secret here<mark></p>');
    }
    //set SpilGames secret
    SpilGames::set(SpilGames::SETTING_SECRET, $SpilGamesSecret);
    /**
     * Handle token changes
     */
    //update currentToken from request 
    if (isset($_REQUEST['apptoken'])) {
        //check of oldToken is the not the same as token from reques
        if (isset($_SESSION['oldToken']) && $_REQUEST['apptoken'] != $_SESSION['oldToken']) {
            $_SESSION['currentToken'] = $_REQUEST['apptoken'];
        }
        //if oldToken is not set create oldToken
        if (!isset($_SESSION['oldToken'])) {
            $_SESSION['oldToken'] = $_SESSION['currentToken'] = $_REQUEST['apptoken'];
        }
    }
    //subscribe to appauth change event and update the current token.
    SpilGames::subscribe(SpilGames::EVENT_APPAUTH_CHANGED, function () {
        $_SESSION['currentToken'] = SpilGames(SpilGames::AUTH_GETAPPLICATIONTOKEN);
    });
    //set token
    SpilGames::set(SpilGames::SETTING_AUTH, $_SESSION['currentToken']);
    //SpilGames::set(SpilGames::SETTING_REQUEST_HANDLER, SpilGames::SETTING_REQUEST_HANDLER_CURL);
    /**
     * Run example what is selected on the font-end
     */
    //method to parse the data in the xml
    function parseData ($node, &$data) {
        //get type from atr.
        switch ((string) $node["type"]) {
            case 'array':
                $data = array();
                foreach ($node  as $item) {
                    parseData($item, $data[]);
                }
                break;

            case "string":
                $data = (string) $node;
                break;

            case "int" :
                $data = (int) $node;
                break;

        }
    }
    //check of call is a post
    if (!empty($_POST) && isset($_POST['example'])) {
        //needed because some server block read file in the libxml
        $xmlFile = file_get_contents('example.xml');
        $XML = new SimpleXMLElement($xmlFile);
        $Method = $XML->xpath("//method[@name='" . $_POST['example'] . "']");
        if (!empty($Method)) {
            $data = null;
            //check of method need data
            if($Method[0]->data) {
                $data = array();
                foreach ($Method[0]->data->children() as $key=>$value) {
                    parseData($value, $data[$key]);
                }
            }
            SpilGames(constant('SpilGames::' . $_POST['example']), $data, function ($result) {
                if ($result["isError"]) {
                    var_dump($result);
                } else {
                    $data = array("data"=>$result["data"]);
                    if (isset($result["pageControl"])) {
                        $data["pageControl"] = $result["pageControl"];
                    }
                    var_dump($data);
                }
            });
        }
        exit();
    }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SpilGames API test page</title>
        <meta name="description" content="SpilGames API test page">
        <meta name="viewport" content="width=device-width">
        <!-- SpilGames JavaScript lib -->
        <script src="//api.spilgames.com/js/"></script>
        <!-- SyntaxHighlighter //-->
        <script src="//google-code-prettify.googlecode.com/svn/loader/run_prettify.js?autoload=false&skin=sons-of-obsidian" type="text/javascript"></script>
        <!--[if lt IE 9]>
            <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
        <![endif]-->
        <style type="text/css">
            summary {
                display: block;
            }
            pre {
                border-radius: 9px;
                padding: 10px 0px;
            }
        </style>
    </head>
    <body>

        <script type="text/javascript">
            SpilGames(['Net', 'DOMSelect', 'JSLib'], function (Net, DOM, jslib) {
                var apicalls = {};
                Net.get('example.xml', function (examples) {
                    var select = DOM.get("#api-calls"),
                        modules = DOM.getAll("module", examples),
                        methods,
                        optgroup,
                        option,
                        exmaple;
                    //module
                    for (var i = 0, max = modules.length; i < max; i++) {
                        optgroup = document.createElement('optgroup');
                        optgroup.label = modules[i].getAttribute('name');
                        methods = DOM.getAll("method", modules[i]);
                        for (var j = 0, maxj = methods.length; j < maxj; j++) {
                            option = document.createElement('option');
                            option.innerHTML = option.value =  methods[j].getAttribute("name");
                            exmaple = DOM.get('example', methods[j]).childNodes;
                            apicalls[option.value] = "";
                            for (var x = 0, maxx = exmaple.length; x < maxx; x++) {
                                apicalls[option.value] += exmaple[x].nodeValue;
                            }
                            //trim
                            apicalls[option.value] = apicalls[option.value].replace(/^(\n|\r| )|(\n|\r| )$/, "");
                            optgroup.appendChild(option);
                        }
                        select.appendChild(optgroup);
                    }
                }, 'xml');
                //live test example
                jslib.subscribe('example.test', function () {
                    var select = DOM.get("#api-calls"),
                        method = select.options[select.selectedIndex].value,
                        callResult = DOM.get("#callResult");
                    //post the exmaple method
                    callResult.innerHTML = "LOADING...";
                    Net.post(location.href, {example: method}, function (result){
                        //reset for pretty print
                        callResult.className = "prettyprint lang-php linenums";
                        callResult.innerHTML = result;
                         PR.prettyPrint();
                    }, "text");
                });
                //show example
                jslib.subscribe('example.show', function (select) {
                    var method = select.options[select.selectedIndex].value,
                        example = DOM.get("#callExample"),
                        test = DOM.get("#testExample");
                    if (apicalls[method]) {
                        //reset for pretty print
                        example.className = "prettyprint lang-php linenums";
                        example.innerHTML = apicalls[method];
                        PR.prettyPrint();

                        test.style.display =  "block";
                        test.innerHTML = "Test " + method + " example!";
                    } else {
                        example.innerHTML = "";
                        test.style.display =  "none";
                    }
                });
            });
        </script>
        <details>
            <summary>PHP Version</summary>
            <strong><?php echo phpversion(); ?></strong>
        </details>
        <details>
            <summary>PHP parameters</summary>
            <?php 
                foreach ($_GET as $key => $value ) {
                    echo $key . ' : <strong>' . $value . '</strong><br />';
                }
            ?>
        </details>
        <details>
            <summary>Current Token</summary>
            <strong><?php echo $_SESSION['currentToken']; ?></strong>
        </details>
        <h3>API example calls</h3>
        <select id="api-calls" onchange="SpilGames('example.show', this)">
            <option value="">Please selected a example call</option>
        </select>
        <pre id="callExample"></pre>
        <button style="display: none" onclick="SpilGames('example.test')" id="testExample"></button>
        <pre id="callResult"></pre>
    </body>
</html>
