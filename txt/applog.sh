#!/bin/bash

su zabbix -c "ssh zabbix@$2 \"zabbix_get -s $1 -k 'system.run[\\\" powershell.exe -nologo -command \\\\\\\"Get-EventLog application -EntryType Error,Warning -newest 20 | Format-List \\\\\\\" \\\"]'\"" > /usr/share/zabbix/scripts/diagnostico/txt/applog.txt
