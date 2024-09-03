# Setup Guide

1. Clone repository
```bash
git clone https://github.com/budhasanjeev/text-analyzer.git
```

2. Navigate to the project directory
```bash
cd text-analyzer
```

3. Build the docker images
```bash
docker-compose build
```

4. Run the containers
```bash
docker-compose up -d
```

5. Install composer, symbolic link and generate application key
```bash
docker-compose exec php bash
composer install

ln -snf .env.dev .env

php artisan key:generate
```

6. Edit the host file
```bash
sudo vi /etc/hosts

Copy below content and paste

127.0.0.1 local.text-analyzer.com
```

7. DB setup
Connect mysql container and execute the command
```bash
mysql -utestuser -ppass1234 text_analyzer

Then create table

DROP TABLE IF EXISTS dictionary_tbl;

CREATE TABLE dictionary_tbl (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    jp_word VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    en_translation VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    deleted_flag char(1) DEFAULT '0',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_jp_word (jp_word),
    INDEX idx_en_translation (en_translation)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

8. Install node modules
```bash
docker-compose run --rm node

docker-compose run --rm node npm run dev
```

### Finally

[Click here to open app](local.text-analyzer.com)