#!/bin/bash
php artisan migrate:refresh --seed
mysqldump --opt --user="root" --password="whatever123" rasla > app/tests/_data/dump.sql
