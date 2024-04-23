# Makefile для проекта Laravel с использованием Docker

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

#migration
migrate:
	@echo "Migration..."
	sudo docker exec -it app php artisan migrate
# Создание символической ссылки для хранилища
storage-link:
	@echo "Создание символической ссылки для хранилища..."
	sudo docker exec -it app php artisan storage:link

# Сборка проекта: сборка контейнеров, установка зависимостей и создание ссылки на хранилище
build-project: up composer-install migrate storage-link

.PHONY: up down bash composer-install migrate storage-link build-project
