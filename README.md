# Test

cd /home/yosmanyga/Work/Projects/yosmy/currency/code

cd play

export UID
export GID
docker-compose \
-f docker/all.yml \
-p yosmy_currency \
up -d \
--remove-orphans --force-recreate

docker exec -it yosmy_currency_php sh

php play/bin/app.php /exchange-rates-api/convert-amount 10 MXN