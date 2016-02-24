#Скрипт для бекапа базы данных

BACKUP_DIR=/home/web/server/yii-local/db-backup
DIR=`date +%F`

mkdir $BACKUP_DIR/$DIR 
mysqldump -uroot -proot blog > $BACKUP_DIR/$DIR/blog.sql 2>$BACKUP_DIR/$DIR/blog-error.log
