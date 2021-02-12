<!--Developed by pthon-->
<!--Разработано pthon-->
<?php
$code = $_POST['code'];
$pulse = $_POST['pulselength'];
$protocol = $_POST['protocol'];
$repeat = $_POST['repeat'];
$length = $_POST['length'];
$ini_array = parse_ini_file('/etc/rpi-config');
if ($repeat == "") {
    $repeat = 10;
}

if (isset($code) and isset($pulse) and isset($protocol)) {
    $command = "/usr/bin/python3 ".$ini_array['send_location']. " -g ".$ini_array['send']." -p ".$pulse." -t ".$protocol." -r ".$repeat." ".$code;
    $command_length = "/usr/bin/python3 ".$ini_array['send_location']. " -g ".$ini_array['send']." -p ".$pulse." -t ".$protocol." -r ".$repeat. " -l ".$length." ".$code;
    $output = null;
    $return_val = null;
    if ($length == "" or $length == null){
        passthru($command, $return_val);
    } else {
        passthru($command_length, $return_val);
    }
    if ($return_val != 0) {
        header("HTTP/1.1 500 Internal Server Error");
        echo "<br>";
        echo $output;
        echo "<br>";
        echo $return_val;
        echo "<br>";
        die("ERROR: Cannot execute command. Command: ".$command);
    } elseif ($return_val == 0) {
        header("HTTP/1.1 200 OK");
    }

} else {
    header("HTTP/1.1 400 Bad Request");
    die("ERROR: Some field is not filled");
}