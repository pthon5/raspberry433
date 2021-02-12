<!--Developed by pthon-->
<!--Разработано pthon-->
<?php
$config = parse_ini_file('/etc/rpi-config');
$connect = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name'])or die ('Нет связи с Базой Данных');
mysqli_set_charset ($connect , "utf8");