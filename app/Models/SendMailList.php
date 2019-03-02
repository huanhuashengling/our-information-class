<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendMailList extends Model
{
    protected $fillable = ['server_provider', 'num_limit_one_day', 'username', 'mail_address', 'password', 'auth_code', 'is_useable', 'schools_id'];
}
/*
sudo docker run -e 'ACCEPT_EULA=Y' -e 'MSSQL_SA_PASSWORD=admin' --name 'sql1' -p 1401:1433 -v sql1data:/var/mssql -d mcr.microsoft.com/mssql/server:2017-latest

docker exec -it sql1 mkdir /var/mssql/backup

docker exec -it sql1 /opt/mssql-tools/bin/sqlcmd -S localhost -U SA -P 'admin' -Q 'RESTORE FILELISTONLY FROM DISK = "/var/mssql/backup/ShareStacks.bak"' | tr -s ' ' | cut -d ' ' -f 1-2

sudo docker cp Downloads/ShareStacks.bak MSSQL_1433:/var/opt/mssql/backup

docker exec -it MSSQL_1433 /opt/mssql-tools/bin/sqlcmd -S localhost -U SA -P 'yourStrong(!)Password' -Q 'RESTORE FILELISTONLY FROM DISK = "/var/opt/mssql/backup/ShareStacks.bak"' | tr -s ' ' | cut -d ' ' -f 1-2

docker exec -it MSSQL_1433 /opt/mssql-tools/bin/sqlcmd -S localhost -U SA -P 'yourStrong(!)Password' -Q 'RESTORE DATABASE ShareStacks FROM DISK = "/var/opt/mssql/backup/ShareStacks.bak" WITH MOVE "ShareStacks" TO "/var/opt/mssql/data/ShareStacks.mdf", MOVE "ShareStacks_log" TO "/var/opt/mssql/data/ShareStacks.ldf"'

codesign -f -s "Navicat Register" /Applications/Navicat\ Premium.app/Contents/MacOS/Navicat\ Premium

./navicat-keygen 2048key.pem

NAV9-NHRJ-VMR4-3EP9

codesign -f -s "foobar" /Applications/Navicat\ Premium.app/Contents/MacOS/Navicat\ Premium*/