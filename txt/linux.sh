#!/bin/bash

su zabbix -c "ssh zabbix@10.93.70.116 'zabbix_get -s $1 -k \"system.run[df -k]\"'" |awk '$5 ~ /\%$/ {print $1 " " $5 }' | sort -rk 2,2 | grep -v Filesystem | head -1> /usr/share/zabbix/scripts/diagnostico/txt/disco_min.txt
#su zabbix -c "ssh zabbix@10.93.70.116 'zabbix_get -s $1 -k \"system.run[dmesg]\"'" |tail -n 5 > /usr/share/zabbix/scripts/diagnostico/txt/dmesg_min.txt
#su zabbix -c "ssh zabbix@10.93.70.116 'zabbix_get -s $1 -k \"system.run[df -h]\"'" > /usr/share/zabbix/scripts/diagnostico/txt/discos.txt
#su zabbix -c "ssh zabbix@10.93.70.116 'zabbix_get -s $1 -k \"system.run[dmesg -T]\"'" > /usr/share/zabbix/scripts/diagnostico/txt/dmesg.txt
#su zabbix -c "ssh zabbix@10.93.70.116 'zabbix_get -s $1 -k \"system.run[ps -fea]\"'" > /usr/share/zabbix/scripts/diagnostico/txt/procesos.txt
#su zabbix -c "ssh zabbix@10.93.70.116 'zabbix_get -s $1 -k \"system.run[TERM=vt100 top -c -b -n 1]\"'" > /usr/share/zabbix/scripts/diagnostico/txt/top.txt
#su zabbix -c "ssh zabbix@10.93.70.116 'zabbix_get -s $1 -k \"system.run[sar]\"'" > /usr/share/zabbix/scripts/diagnostico/txt/cpu.txt
#su zabbix -c "ssh zabbix@10.93.70.116 'zabbix_get -s $1 -k \"system.run[free -mk]\"'" > /usr/share/zabbix/scripts/diagnostico/txt/memoria.txt

