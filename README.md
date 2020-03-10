# fakeap

This repository contain the files requiered in order to setup a fake access point with a captive portal. The goal is to usurp a public wifi access point and steal personal data from the clients.

<h2> Requierements </h2>

Debian is recommended, but this project should work on any debian based distribution. You may encouter somme errors with some distributions such as Ubuntu or Kali, so feel free to ask me if you have any issues.

You will need to install those tools :

The AP is setup with the <b> Hostapd deamon </b>.
You will also need <b> Dhcpd </b> for the DHCP and <b>Dnsmasq</b> for the DNS resolution.
At last, the captive portal is hosted on <b> Apache2 </b> with a <b>MySQL </b>Database.

Make sure you have all of them installed before running the Script.

<h2> Configuration </h2>

Replace the "interface" fields in <b>conf/hostapd.conf</b> and <b>conf/dnsmasq.conf</b> with the name of your wifi interface.
Also, you can change the field "ssid" in <b>conf/hostapd.conf</b> to anything you want, it will change the name of the wifi spot.

At the begining of the script <b>fakeap.sh</b>, you need to change the variables "INT_WIFI" with your wifi interface and "INT_ETH" with your ethernet interface.

The <b>Html </b> folder contain my captive portal. If you want to use it, you need to edit <b>html/econnect/conf/conf.php</b> with the name and password of your MySQL database and move the folder to <b> /var/www/apache2 </b>

<h2> Utilisation </h2>

Run in a terminal and wait !

<h2> Ameliorations </h2>
In this version, the ap doesn't grant acces to internet after the client have filed the formula of the captive portal. All the trafic is redireted to the captive portal.
Also, the captive portal doesn't work with https requests.
