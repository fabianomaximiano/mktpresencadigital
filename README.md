# MKT Presença Digital

Site institucional desenvolvido em WordPress com tema Astra + tema filho personalizado.

## Tecnologias

- WordPress
- PHP
- MySQL
- Docker
- Astra Theme
- Astra Child Theme

---

# Estrutura do projeto

```text
mktpresencadigital/
│
├── database/
│   └── fabia084_wp486.sql
│
├── wp-content/
│   ├── themes/
│   │   ├── astra/
│   │   └── astra-child/
│   │
│   ├── plugins/
│   └── uploads/
│
└── mktpresencadigital.yml
```

---

# Docker

Subir containers:

```bash
docker compose -f mktpresencadigital.yml up -d
```

Parar containers:

```bash
docker compose -f mktpresencadigital.yml down
```

---

# Portas

| Serviço | Porta |
|----------|-------|
| WordPress | 8090 |
| phpMyAdmin | 8091 |
| MySQL | interno |

---

# Importação do banco

⚠️ Não utilizar:

```powershell
Get-Content arquivo.sql | docker exec ...
```

Esse método pode corromper caracteres especiais.

Utilizar:

```powershell
cmd /c "docker exec -i mktpd-mysql mysql --default-character-set=utf8mb4 -u root -proot fabia084_wp486 < database\fabia084_wp486.sql"
```

---

# Ajustar URLs para localhost

```powershell
docker exec -it mktpd-mysql mysql -u root -proot -e "USE fabia084_wp486; UPDATE wpxf_options SET option_value='http://localhost:8090' WHERE option_name IN ('siteurl','home');"
```

---

# Charset

Banco:

- utf8mb4_unicode_ci
- utf8mb4_unicode_520_ci

Importação obrigatoriamente em:

```text
utf8mb4
```

---

# Tema ativo

Template:

```text
astra
```

Stylesheet:

```text
astra-child
```

---

# Observações

- O tema pai Astra deve existir junto com o tema filho.
- A pasta uploads deve ser mantida.
- Plugins devem ser preservados.
- O banco possui prefixo:

```text
wpxf_
```

---

# Backup recomendado

- database/fabia084_wp486.sql
- wp-content/themes
- wp-content/plugins
- wp-content/uploads

---

# URL local

http://localhost:8090

# phpMyAdmin

http://localhost:8091