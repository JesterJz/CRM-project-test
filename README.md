# CRM-project-test

## 1. DB Diagram

![Database Diagram](./crm-dbdiagram.png)

## 2. Installation Guide

### Step 1: Clone the Repository
First, clone the repository with its submodules:

```sh
git clone --recurse-submodules https://github.com/JesterJz/CRM-project-test.git
cd CRM-project-test
```
### Step 2: Configure Environment
Copy the environment configuration files to the appropriate locations:

```sh
cp .env.laradock ./laradock/.env
cp crm.conf ./laradock/nginx/sites/
```
### Step 3: Edit hosts:
Add the following line to your hosts file to set up the local domain:

- Windows: Open `C:\Windows\System32\drivers\etc\hosts` in a text editor with administrative privileges.
- macOS/Linux: Open `/etc/hosts` in a text editor with sudo privileges.
Add this line to the file:

```
127.0.0.1      crm.local
```
### Step 4: Build and run containers:

```sh
cd laradock
docker-compose up -d nginx mysql phpmyadmin elasticsearch workspace
```

### Step 5: Install composer and npm packages:
Access the workspace container and install the required packages:

```sh
docker-compose exec workspace bash
cd backend
composer install && npm install
```

---

### Step 6: Set Permissions for Laravel Storage
Ensure the Laravel storage directories have the correct permissions:

```sh
chown -R www-data:www-data /var/www && \
chown -R www-data:www-data /var/www/backend/storage /var/www/backend/bootstrap/cache && \
chmod -R 777 /var/www/backend/storage /var/www/backend/bootstrap/cache
```

### Step 7: Generate Application Key and Migrate Database
Generate the application key and run the database migrations with seed data:

```sh
php artisan key:generate
php artisan migrate --seed
```

### Step 8: Index dữ liệu vào Elasticsearch
```sh
php artisan import:contacts
```
## 3. Postman workspace api test:

Workspace link: https://www.postman.com/crm-test-api/crm-api-docs/overview
