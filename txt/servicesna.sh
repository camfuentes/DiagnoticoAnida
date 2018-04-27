#!/bin/bash

zabbix_get -s $1 -k 'system.run[" powershell.exe -nologo -command \\\"Get-Service | select -property name,status,starttype | Sort-Object StartType \\\" "]' > /usr/share/zabbix/scripts/diagnostico/txt/services.txt
