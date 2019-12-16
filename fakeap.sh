#!/bin/bash
# Start

#Assign the network Gateway and netmask to the interface and add the routing table
ifconfig wlan0 up 192.168.1.1 netmask 255.255.255.0
route add -net 192.168.1.0 netmask 255.255.255.0 gw 192.168.1.1

# Start DHCP/DNS server
dnsmasq -C conf/dnsmasq.conf -H conf/fakehosts.conf -d

# Enable routing
sysctl net.ipv4.ip_forward=1

# Enable NAT
iptables -t nat -A POSTROUTING -o ens33 -j MASQUERADE

# Run access point daemon
hostapd conf/hostapd.conf

# Stop

# Disable NAT
iptables -D POSTROUTING -t nat -o ens33 -j MASQUERADE

# Disable routing
sysctl net.ipv4.ip_forward=0

# Disable DHCP/DNS server
service dnsmasq stop
service hostapd stop
