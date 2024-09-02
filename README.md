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

5. Create application key
```bash
docker-compose exec php bash
```
then execute this command
```bash
php artisan key:generate
```

6. Edit the host file
```bash
sudo vi /etc/hosts
```

then add this in the file
```bash
127.0.0.1 local.text-analyzer.com
```

7. DB setup
Connect mysql container and execute the command
```bash
mysql -utest -ppass!234
```

then create table
```bash
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
