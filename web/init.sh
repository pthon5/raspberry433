sudo apt update
sudo apt install python3-pip
sudo apt install mariadb-server
sudo apt install apache2
sudo apt install php
sudo pip3 install pymysql
sudo pip3 install configparser
sudo pip3 install rpi-rf
#Setup DataBase
sudo mysql
CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'user_password';
GRANT ALL PRIVILEGES ON *.* TO 'database_user'@'localhost';
CREATE DATABASE rpi;
\. /home/pi/rpi.sql
exit;
#EDIT rpi-config
sudo cp ~/rpi-config /etc/
sudo cp ~/rpi-rf.service /lib/systemd/system/
sudo systemctl daemon-reload
sudo mkdir /usr/local/lib/rpi-rf
sudo cp ~/rpi-rf_receive /usr/local/lib/rpi-rf/