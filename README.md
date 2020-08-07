# Auto backup source code to Google Drive

Chúng ta thiết lập crontab như sau, nó sẽ được thực hiện vào 8h sáng chủ nhật hàng tuần.

```sh
# created by hien-tech (2020-08-06)
0 8 * * 0 sh /home/gg_drive/snapshot.sh
5 8 * * 0 php /home/gg_drive/autobackup.php
```

## Reference links
- [Hướng dẫn cách sử dụng Google Drive API để backup code và database từ Server lên Google Drive (part 01)](https://www.linkedin.com/pulse/h%C6%B0%E1%BB%9Bng-d%E1%BA%ABn-c%C3%A1ch-s%E1%BB%AD-d%E1%BB%A5ng-google-drive-api-%C4%91%E1%BB%83-backup-code-nguy%E1%BB%85n-duy/)
- [Hướng dẫn cách sử dụng Google Drive API để backup code và database từ Server lên Google Drive (part 02)](https://www.linkedin.com/pulse/h%C6%B0%E1%BB%9Bng-d%E1%BA%ABn-c%C3%A1ch-s%E1%BB%AD-d%E1%BB%A5ng-google-drive-api-%C4%91%E1%BB%83-backup-code-nguy%E1%BB%85n-duy-1c/)
- [Hướng dẫn cách sử dụng Google Drive API để backup code và database từ Server lên Google Drive (part 03, end)](https://www.linkedin.com/pulse/h%C6%B0%E1%BB%9Bng-d%E1%BA%ABn-c%C3%A1ch-s%E1%BB%AD-d%E1%BB%A5ng-google-drive-api-%C4%91%E1%BB%83-backup-code-nguy%E1%BB%85n-duy-2c/)
