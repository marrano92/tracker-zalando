start:
	./vendor/bin/sail up -d
stop:
	./vendor/bin/sail down
migrate:
	./vendor/bin/sail artisan migrate --force
refresh-seed:
	./vendor/bin/sail artisan migrate:refresh --seed
refresh:
	./vendor/bin/sail artisan migrate:refresh
reset:
	docker-compose down -v
clear-config-cache:
	./vendor/bin/sail artisan config:cache
build-dev:
	./vendor/bin/sail npm install && ./vendor/bin/sail npm run dev
