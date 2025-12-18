## Setup (Docker)

```bash
git clone https://github.com/username/project.git
cd project

cp .env.example .env
docker compose up -d --build

docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate:fresh --seed
