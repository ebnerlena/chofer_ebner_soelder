#!/usr/bin/env bash
set -euo pipefail

DOCKER_MYSQL_ID="REPLACE_ME"
DB_NAME="REPLACE_ME"
DB_USER="REPLACE_ME"
DB_PASSWORD="REPLACE_ME"

# sql dump on server
ssh -t -p 5412 admin@193.170.119.171 "sudo mysqldump --add-drop-table --no-tablespaces wp_chris > ~/chris_dump.sql" 

# get dump with scp
scp -P 5412 admin@193.170.119.171:~/chris_dump.sql .

# import dump
docker exec -i ${DOCKER_MYSQL_ID} mysql -u${DB_USER} -p${DB_PASSWORD} ${DB_NAME} < ./chris_dump.sql

# update url references
docker exec ${DOCKER_MYSQL_ID} mysql -u${DB_USER} -p${DB_PASSWORD} ${DB_NAME} -e "
UPDATE wp_options SET option_value = replace(option_value, 'https://chris.vm-aqua.soelder.net', 'http://localhost:8080') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET guid = replace(guid, 'https://chris.vm-aqua.soelder.net','http://localhost:8080');
UPDATE wp_posts SET post_content = replace(post_content, 'https://chris.vm-aqua.soelder.net','http://localhost:8080');
UPDATE wp_postmeta SET meta_value = replace(meta_value, 'https://chris.vm-qua.soelder.net','http://localhost:8080');"

# remove local dump file
rm -f ./chris_dump.sql
