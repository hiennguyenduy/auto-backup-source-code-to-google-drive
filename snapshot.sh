#!/bin/sh
# @author hien-tech (nickanhem@gmail.com)
# @since 2020-08-06

# đường dẫn chính
backupfolder="/home/gg_drive/backup"

# ngày tháng hiện tại
yearnow="$(date +'%Y')"
monthnow="$(date +'%m')"
daynow=$(date +'%Y-%m-%d')

# folder ngày backup
daydir="$backupfolder/$daynow"
# file logs
logfile="$backupfolder/"backup-log-"$(date +'%Y')".txt
# folder wp5
pj_wp5="/home/wp5"
# file backup wp5
db_wp5="$backupfolder/$daynow/wp5-db-$daynow".sql
code_wp5="$backupfolder/$daynow/wp5-code-$daynow".zip

# khởi tạo folder backup
mkdir -p "$daydir"

# bắt đầu ghi logs backup
echo "backup started at $(date +'%d-%m-%Y %H:%M:%S')" >> "$logfile"

# mysqldump db
echo "mysqldump wpbase started at $(date +'%d-%m-%Y %H:%M:%S')" >> "$logfile"
mysqldump --user=root --password=vertrigo wpbase > "$db_wp5"
echo "mysqldump wpbase finished at $(date +'%d-%m-%Y %H:%M:%S')" >> "$logfile"

# zip source code
echo "zip code_wp5 started at $(date +'%d-%m-%Y %H:%M:%S')" >> "$logfile"
zip -P hiennguyenduy -r "$code_wp5" "$pj_wp5/uploads/$yearnow/$monthnow/" "$pj_wp5/languages"
echo "zip code_wp5 finished at $(date +'%d-%m-%Y %H:%M:%S')" >> "$logfile"

# kết thúc ghi logs backup
echo "backup finished at $(date +'%d-%m-%Y %H:%M:%S')" >> "$logfile"

# kết thúc script
exit 0