#!/bin/bash
# Start


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
