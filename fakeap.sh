#!/bin/bash

#By Adrien Chaptal & Enrick Mondongue
#Description : Enable the wifi access point and configure the routes, Iptables, and net fowarding

#interfaces configuration
INT_WIFI="wlan0" # wifi access point interface
INT_NET="eth0" # interface connected to internet

#Ip & mask of the wlan network
SUBNET="192.168.0.0/24" 
IP="192.168.0.1"
MASK="255.255.255.0"

echo -e "WIFI interface configuration ..."
sudo ifconfig $INT_WIFI down
sleep 0.5
sudo ifconfig $INT_WIFI $IP netmask $MASK up

echo -e "startintg daemon hostapd..."
# start hostapd server (see hostapd.conf)
sudo hostapd conf/hostapd.conf &
sleep 1


echo -e "Starting daemon dnsmasq... "
# start dnsmasq server (see dnsmasq.conf) -7 /etc/dnsmasq.d
sudo dnsmasq -x /var/run/dnsmasq.pid -C conf/dnsmasq.conf
sleep 1

echo -e "Starting daemon dhcpd... "
# start or resart dhcpd server (see dhcpd.conf)
sudo touch /var/lib/dhcp/dhcpd.leases
sudo dhcpd  -f -pf /var/run/dhcp-server/dhcpd.pid -cf conf/dhcpd.conf $INT_WIFI &
sleep 2

#  Turn on IP forwarding
echo 1 > /proc/sys/net/ipv4/ip_forward

echo -e "IPTABLES configuration"
# IP TABLES
sudo iptables --table nat --append POSTROUTING --out-interface $INT_NET -j MASQUERADE 
sudo iptables --append FORWARD --in-interface $INT_WIFI -j ACCEPT 
sudo iptables -t nat -A PREROUTING -p tcp --dport 80 -j DNAT --to-destination $IP:80 
sudo iptables -t nat -A POSTROUTING -j MASQUERADE 

#dnsspoof
sudo dnsspoof -i $INT_WIFI 


echo -e "[finished! Please don't close the shell ]"
echo -e "[ENTER = STOP hostapd dhcpd dnsmasq   ]"
echo -e "[        STOP interface wifi     ]"
echo -e "[        ERRASE IPTABLES rules   ]"

echo -e "Stop hostapd, dhcpd, dnsmasq & wifi interface..."
# kill hostapd, dnsmasq & dhcpd
sudo killall hostapd dnsmasq dhcpd

echo -e "errasing IPTABLES RULES..."
sudo iptables -D POSTROUTING -t nat -o $INT_NET -j MASQUERADE 2>/dev/null
sudo iptables -D FORWARD -i $INT_WIFI --destination $SUBNET --match state --state NEW --jump ACCEPT 2>/dev/null
sudo iptables -D FORWARD --match state --state RELATED,ESTABLISHED --jump ACCEPT 2>/dev/null
sudo iptables -D INPUT -s $SUBNET --jump ACCEPT 2>/dev/null

echo -e "iptables CLEAN"

# interfaces
sudo ifconfig $INT_WIFI down
sudo ifconfig $INT_WIFI up
 
# Turn off IP forwarding
echo 0 > /proc/sys/net/ipv4/ip_forward
echo -e "Done!"
