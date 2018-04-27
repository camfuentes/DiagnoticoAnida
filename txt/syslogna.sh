#!/bin/bash

zabbix_get -s $1 -k 'system.run[" powershell.exe -nologo -command \\\"Get-EventLog system -EntryType Error,Warning,FailureAudit,SuccessAudit -newest 20 | Format-List\\\""]' > /usr/share/zabbix/scripts/diagnostico/txt/syslog.txt
