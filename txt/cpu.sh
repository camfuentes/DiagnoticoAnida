#!/bin/bash

su zabbix -c "ssh zabbix@10.93.70.116 'zabbix_get -s $1 -k system.run[\"powershell.exe -nologo -command \\\"Get-Process | Sort-Object cpu -Descending | Format-Table -AutoSize | Out-String -Width 4096\\\"\"]'" > /usr/share/zabbix/scripts/diagnostico/txt/processtime.txt

