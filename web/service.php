<?php
$service = "rpi-rf";
$output = shell_exec("systemctl is-active $service");
if (trim($output) == "active") {
    echo '<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true" style="background-color: #4BB543; color: white;">Service: '.$output.'</a>';
} else {
    echo '<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true" style="background-color: #FF9494; color: white;">Service: '.$output.'</a>';
}
?>