#!/bin/bash

zabbix_get -s $1 -k 'system.run[" powershell.exe -nologo -command \\\"  Get-WmiObject Win32_PerfFormattedData_PerfProc_Process |Sort-Object PercentProcessorTime -Descending | Format-Table Name,IDProcess,PercentProcessorTime -AutoSize   \\\" "]' > /usr/share/zabbix/scripts/diagnostico/txt/wimcpu.txt
