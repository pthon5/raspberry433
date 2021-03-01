# Это веб интерфейс для rpi-rf  
# raspberry433

# Install :  
sudo apt update  
sudo apt install python3-pip  
sudo apt install mariadb-server  
sudo apt install apache2  
sudo apt install php  
sudo apt install php7.3-mysqli  
sudo pip3 install pymysql  
sudo pip3 install configparser  
sudo pip3 install rpi-rf  
sudo pip3 install systemd  
# Setup DataBase  
sudo mysql  
CREATE USER 'USERNAME'@'localhost' IDENTIFIED BY 'PASSWORD';  
GRANT ALL PRIVILEGES ON *.* TO 'USERNAME'@'localhost';  
CREATE DATABASE rpi;  
USE rpi  
\. /home/pi/rpi.sql  
exit;  
#   EDIT rpi-config  
#   Измените файл rpi-config, в секции DB установите те данные, которые указали при создании пользователя выше.
sudo cp ~/rpi-config /etc/  
sudo cp ~/rpi-rf.service /lib/systemd/system/  
sudo systemctl daemon-reload  
sudo systemctl enable rpi-rf  
sudo systemctl start rpi-rf  
sudo mkdir /usr/local/lib/rpi-rf  
sudo cp ~/rpi-rf_receive /usr/local/lib/rpi-rf/  
sudo adduser www-data gpio  

# ADD "open_basedir=/YOUR LOCATION OF rpi-rf_send FILE" in /etc/php/7.3/cli/php.ini
# Добавьте в файл /etc/php/7.3/cli/php.ini строку "open_basedir=/РАСПОЛОЖЕНИЕ ФАЙЛА rpi-rf_send"
# COPY ALL FILES FROM web FOLDER TO /var/www/html/  
# Скопируйте все файлы из папки web в /var/www/html/   

