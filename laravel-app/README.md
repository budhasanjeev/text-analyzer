## DB
```bash
text_analyzer
```

## Dictionary Table

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