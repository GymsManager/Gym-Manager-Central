# Gym-app – Laravel Gym Management System

A full-featured **Gym Management System** built with [Laravel](https://laravel.com/) and containerized using **Docker** for easy setup and deployment.

---

##  Dockerized Setup

This project uses Docker and Docker Compose to streamline local development.

---

##  Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/GymsManager/Gym-Manager-Central.git
cd Gym-app
```

### 2. Create Environment File

```bash
cp .env.example .env
```

Update `.env` variables if needed, especially database credentials to match `docker-compose.yml`.

### 3. Build and Start Docker Containers

```bash
docker-compose up -d --build
```

### 4. Install Dependencies & Set Up Laravel

```bash
# Access the Laravel container
docker exec -it gym-app bash

# Inside container
composer install
php artisan key:generate
php artisan migrate
exit
```

---

## Access the Application

Once everything is running, access the app via:

```
http://localhost:8000
```

> If you use a custom port or virtual host, update accordingly.

---

## 📁 Project Structure

```
Gym-app/
├── app/                  # Laravel application code
├── bootstrap/
├── config/
├── database/
├── apache/
│   └── laravel.conf/
├── public/               # Document root
├── resources/
├── routes/
├── storage/
├── tests/
├── .env
├── docker-compose.yml
├── Dockerfile
└── README.md
```

---

## Environment Variables

Key variables in the `.env` file:

| Variable            | Description               |
|---------------------|---------------------------|
| `APP_NAME`          | Application name          |
| `APP_ENV`           | Environment (local, prod) |
| `APP_KEY`           | Laravel encryption key    |
| `DB_HOST`           | DB host (e.g., `mysql`)   |
| `DB_DATABASE`       | Database name             |
| `DB_USERNAME`       | DB user                   |
| `DB_PASSWORD`       | DB password               |

---

## Deployment
- This Repo deployes automatically to mo3az014/gym-manager-central image when PR merged to release branch.