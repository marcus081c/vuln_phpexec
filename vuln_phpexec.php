<?php 

function executeping($ipaddr)
{
    $stdout = [];
    exec("ping -c 3 " . $ipaddr, $stdout);
    return ["stdout" => $stdout]; //
}

if (isset($_GET["ip"])) {
    $response = null;
    $response = executeping(($_GET["ip"]));
    header("Content-Type: application/json");
    echo json_encode($response);
    die();
}
?>


<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8" />
    <title>SSRF vulnerable website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script>

window.onload = function() {
    ipaddr = document.getElementById("ipinput"), pingoutput = document.getElementById("webpage-output")};


function _insertStdout(e) {
    pingoutput.innerHTML += e, pingoutput.scrollTop = pingoutput.scrollHeight
}

function sendip(e) {

    i = new XMLHttpRequest;
    i.open("GET", "?ip=" + e, 1), i.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), i.onreadystatechange = function() { 
        if (4 === i.readyState && 200 === i.status) try {
            var e = JSON.parse(i.responseText); // e is response from php script (echo), is key value pair stdout
            _insertStdout(e.stdout.join("\n")); //e is the stdout from php script
        } catch (e) {
            alert("Error while parsing response: " + e)
        }
    }, i.send()
}

function presskey(e) {
    switch (e.key) {
        case "Enter":
            sendip(ipaddr.value);
            break;
    }
}

    </script>
  	</head>
  <body>
    <div id="webpage">
      <pre id="webpage-output"></pre>
      <div id="webpage-input">
        <label for="ipinput">IP to ping</label>
        <input id="ipinput" name="ipinput" onkeydown="presskey(event)" />
      </div>
    </div>
  </body>
</html>
