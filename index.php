<?php
    #inlcude SpilGames lib
    require_once('SpilGames.php');
    #example settings
    require_once('example.settings.php');
    //small test of the secret is set
    if (empty($SpilGamesSecret)) {
        echo '<p><mark>The $SpilGamesSecret is empty in the example.settings.php, you must enter your SpilGames secret here<mark></p>';
    }
    //set SpilGames secret
    SpilGames::set(SpilGames::SETTING_SECRET, $SpilGamesSecret);
    //subscribe to auth changed event, this is always needed, because if the auth change you need to store the new token for this user
    SpilGames::subscribe(SpilGames::EVENT_AUTH_CHANGED, function ($data) {
        //add event result to SpilResults object
        SpilResults::$data[SpilGames::EVENT_AUTH_CHANGED] = array("data" => $data);
        //get new token
        SpilResults::$data[SpilGames::ACCOUNT_GETAPPLICATIONTOKEN] = SpilGames(SpilGames::ACCOUNT_GETAPPLICATIONTOKEN);
    });
    //check of call is post
    if (!empty($_POST) && isset($_POST['call'])) {
        //switch for all supported calls
        switch ($_POST['call']) {



####### USER_GET #######
        case 'SpilGames::USER_GET' :
            ###### Example ######
            $example = <<<EXAMPLE
SpilGames(SpilGames::USER_GET , null, function (\$result) {
    //check of result is an error
    if (\$result[isError]) {
        echo 'Error:';
    }
    //show result
    var_dump(\$result);
});
EXAMPLE;

            ###### call ######
            SpilGames(SpilGames::USER_GET , null, function ($result) {
                SpilResults::$data[SpilGames::USER_GET] = $result;
            });
            break;
####### USER_GET #######



####### ACCOUNT_GETAPPLICATIONTOKEN #######
        case 'SpilGames::ACCOUNT_GETAPPLICATIONTOKEN' :
            ###### Example ######
            $example = <<<EXAMPLE
SpilGames(SpilGames::ACCOUNT_GETAPPLICATIONTOKEN , null, function (\$result) {
    //check of result is an error
    if (\$result[isError]) {
        echo 'Error:';
    }
    //show result
    var_dump(\$result);
});
EXAMPLE;

            ###### call ######
            SpilGames(SpilGames::ACCOUNT_GETAPPLICATIONTOKEN , null, function ($result) {
                SpilResults::$data[SpilGames::ACCOUNT_GETAPPLICATIONTOKEN] = $result;
            });
            break;
####### ACCOUNT_GETAPPLICATIONTOKEN #######




        //close switch
        }
        //output
        ob_clean();
        echo json_encode(array(
            "example" => $example,
            "result" => SpilResults::$data
        ));
        exit();
    //close if
    }

    ###### only needed for testing ######
    class SpilResults {
        public static $data = array();
    }
    ###### ----------------- ######
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
        <!-- SpilGames JavaScript API -->
        <script src="//api.spilgames.com/js"></script>
        <style type="text/css">
            #callResult > details > summary { font-size: 20px; font-weight: bolder; }
            tr:nth-child(2n+1) { background: #C0C0C0; }
            td { padding: 2px; }
        </style>
        <!-- SyntaxHighlighter //-->
        <script src="//google-code-prettify.googlecode.com/svn/trunk/src/prettify.js" type="text/javascript"></script>
        <link href="//google-code-prettify.googlecode.com/svn/trunk/src/prettify.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <script type="text/javascript">
            SpilGames({readyevent: 'sp.jsready'}, ['JSLib', 'Net'], function (jslib, Net) {
                //backend
                var backend = "<?php echo $_SERVER['REQUEST_URI']; ?>",
                    formElm = document.getElementById('callForm'),
                    exampleElm = document.getElementById('callExample'),
                    resultElm = document.getElementById('callResult'),
                    TmpDetails = '<details open="open"><summary>:callname:</summary><table>:calltable:</table></details>',
                    TmpTableRow = '<tr><td>:param:</td><td>:value:</td></tr>';
                //force reset of the form
                formElm.reset();
                //subscribe to change event
                jslib.subscribe('sp.call.changed', function (select) {
                    var slt = select || formElm.apicall,
                        //get value
                        value = slt.options[slt.selectedIndex].value;
                    if (value !== "0") {
                        //clear
                        exampleElm.innerHTML = resultElm.innerHTML = '';
                        //get example
                        Net.post(backend, {call: value, example: true}, function (data) {
                            jslib('sp.show', data);
                        }, 'json');
                    }
                });
                //subscribe to show event that will show the backend result
                jslib.subscribe('sp.show', function (data) {
                    var row = '',
                        details,
                        result;
                    if (data.example) {
                        exampleElm.innerHTML = prettyPrintOne(data.example, 'js');
                    }
                    if (data.result) {
                        for (var name in data.result) {
                            details = TmpDetails.replace(':callname:', name);
                            result = data.result[name];
                            if (!result.isError) {
                                row = TmpTableRow.replace(':param:', 'isError').replace(':value:', 'false');
                                result = result.data;
                            }
                            for (var param in result) {
                                row += TmpTableRow.replace(':param:', param).replace(':value:', result[param]);
                            }
                            resultElm.innerHTML += details.replace(':calltable:', row);
                        }
                    }
                });
            });
        </script>
        <details>
            <summary>PHP Version</summary>
            <strong><?php echo phpversion(); ?></strong>
        </details>
    </body>
    <form action="/", method="post" id="callForm">
        <select onchange="SpilGames({waiton: 'sp.jsready'}, 'sp.call.changed', this);" name="apicall" id="apicall">
            <option value="0" selected="selected">
                Select an API call
            </option>
            <optgroup label="User">
                <option value="SpilGames::USER_GET">
                    SpilGames::USER_GET
                </option>
                <option value="SpilGames::ACCOUNT_GETAPPLICATIONTOKEN">
                    SpilGames::ACCOUNT_GETAPPLICATIONTOKEN
                </option>
            </optgroup>
        </select>
    </form>
    <pre id="callExample" class="prettyprint"></pre>
    <div id="callResult">

    </div>
</html>
