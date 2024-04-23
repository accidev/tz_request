# Запуск и построение контейнеров
up:
	@echo "Запуск и сборка Docker контейнеров..."
	sudo docker compose up -d --build

# Остановка и удаление контейнеров
down:
	@echo "Остановка и удаление Docker контейнеров..."
	sudo docker compose down

# Вход в контейнер приложения
bash:
	@echo "Вход в контейнер приложения..."
	sudo docker exec -it app bash

# Установка зависимостей Composer
composer-install:
	@echo "Установка зависимостей Composer..."
	sudo docker exec -it app composer install

# migration
migrate:
	@echo "Migration..."
	sudo docker exec -it app php artisan migrate

# Generate app key
key-generate:
	@echo "app key generate"
	sudo docker exec -it app php artisan key:generate

# Создание символической ссылки для хранилища
storage-link:
	@echo "Создание символической ссылки для хранилища..."
	sudo docker exec -it app php artisan storage:link

# Сборка проекта
build-project: up composer-install key-generate migrate storage-link

.PHONY: up down bash composer-install migrate key-generate storage-link build-project
