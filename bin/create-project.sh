#!/bin/bash



docker-compose exec backend composer self-update
docker-compose exec backend composer create-project --prefer-dist yiisoft/yii2-app-basic .

