# Setup Guide

1. Clone this repo
```bash
https://github.com/budhasanjeev/text-analyzer.git
```

2. Navigate inside the project directory
```bash
cd text-analyzer
```

3. Build the docker images
```bash
docker-compose build
```

4. Run the container
```bash
docker-compose up -d
```

5. Setup symbolic link
```bash
docker-compose exec php bash
ln -s .env.dev .env
```

6. Edit the host file
```bash
sudo vi /etc/hosts

127.0.0.1 local.text-analyzer.com
```

## DB
```bash
Open the docker and mysql container

mysql -utest -ppass!234

then create table

```sql
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