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


# README.md

# MKT Presença Digital

Tema WordPress próprio desenvolvido para o projeto **MKT Presença Digital**, com foco em SEO Local, performance, conversão e gerenciamento simplificado pelo painel administrativo do WordPress.

---

# Objetivo do Projeto

Criar um tema próprio para substituir o Astra, mantendo o visual atual do site, porém com:

* Maior performance (PageSpeed).
* Melhor SEO técnico.
* Melhor experiência de administração.
* Estrutura preparada para crescimento.
* Maior independência de plugins.

---

# Objetivos Principais

## Performance

* Buscar PageSpeed acima de 90.
* Reduzir dependência de plugins.
* Otimizar imagens.
* Carregar somente os recursos necessários.

## SEO Local

Posicionar o projeto para:

* São Paulo
* Osasco
* Guarulhos

Principais palavras-chave:

* Sites profissionais
* SEO Local
* Google Meu Negócio
* Performance Web

## Conversão

Transformar o site em um gerador de oportunidades através de:

* Formulários.
* CTA estratégicos.
* Cases.
* Conteúdo do Blog.
* Autoridade profissional.

## Facilidade de gerenciamento

Permitir que praticamente todo o conteúdo possa ser alterado pelo painel do WordPress.

---

# Arquitetura do Tema

Estrutura principal:

```text
wp-content/themes/mktpresenca-digital/

assets/
├── css/
├── js/

docs/

inc/
├── customizer.php
├── enqueue.php
├── helpers.php
├── post-types.php
├── theme-setup.php
├── meta-boxes/

template-parts/

front-page.php
header.php
footer.php
functions.php
style.css
```

---

# Filosofia do Projeto

O projeto vende:

**Soluções digitais.**

Não vende:

* Sites.
* Landing Pages.
* Programação.

O foco é:

* Presença Digital.
* SEO Local.
* Autoridade.
* Conversão.

---

# Convenções do Projeto

## CSS

* Não utilizar CSS inline.
* CSS sempre em arquivos próprios.
* Não misturar CSS dentro de PHP.

## PHP

* Escapar saídas.
* Código organizado.
* Evitar duplicação.

## WordPress

Priorizar:

* Customizer.
* CPT.
* Meta Boxes.

Evitar:

* Plugins desnecessários.

---

# Fluxo de Trabalho

## Regra principal

Se uma funcionalidade já está funcionando:

### NÃO ALTERAR.

Melhorias devem ser:

* Incrementais.
* Isoladas.
* Seguras.

---

# Regra do Escopo

Somente alterar os arquivos explicitamente autorizados.

Exemplo:

Feature:

Adicionar descrição das imagens.

Arquivos autorizados:

* inc/customizer.php

Arquivos proibidos:

* front-page.php
* front-end.css
* functions.php
* header.php
* footer.php

---

# Processo Obrigatório

1. Definir a feature.
2. Informar quais arquivos serão alterados.
3. Alterar somente os arquivos autorizados.
4. Validar.
5. Commit.

---

# Regra de Commit

Um commit por feature.

Nunca acumular várias alterações.

---

# Padrões de Commit

### Feature

```bash
feat(area): descrição
```

Exemplo:

```bash
feat(customizer): adiciona recomendações de imagens da home
```

---

### Correção

```bash
fix(area): descrição
```

Exemplo:

```bash
fix(hero): restaura configurações dinâmicas
```

---

### Refatoração

```bash
refactor(area): descrição
```

---

### Documentação

```bash
docs(area): descrição
```

Exemplo:

```bash
docs(checklist): atualiza checklist do projeto
```

---

### Limpeza

```bash
chore(area): descrição
```

Exemplo:

```bash
chore(plugins): remove plugins não utilizados
```

---

# Processo de Validação

Antes do commit:

### Código

Validar:

```powershell
git status
```

### Conferir alterações:

```powershell
git diff
```

### Pesquisar conteúdo:

```powershell
Select-String -Path .\arquivo.php -Pattern "texto"
```

### Validar sintaxe:

```powershell
php -l arquivo.php
```

---

# O que já está pronto

## Home

* Hero dinâmica.
* Botões dinâmicos.
* Imagem dinâmica.
* Footer ajustado.
* Logo do rodapé usando a mesma identidade do topo.
* Newsletter funcionando.
* Indicadores funcionando.

## Customizer

* Painel Home restaurado.
* Configurações recuperadas.
* Recomendações de imagens implementadas.

## Layout

* Hero estabilizada.
* Espaçamentos corrigidos.
* Gradiente inferior corrigido.

## Estrutura

* Tema próprio criado.
* Bootstrap local.
* Arquitetura organizada.

## Plugins

Plugins desnecessários removidos.

---

# O que ainda será desenvolvido

## Quem Somos

Transformar em conteúdo dinâmico.

Criar:

CPT:

* Quem Somos

Resumo da página deverá aparecer automaticamente na Home.

---

## Projetos

Criar:

CPT Projetos.

Cada projeto terá:

* Imagem.
* Descrição.
* Segmento.
* Link.
* Resultado.

---

## Blog

Fortalecer SEO e autoridade.

---

## CTA

Permitir:

* alterar texto;
* alterar link;
* ativar;
* desativar.

---

# O que NÃO pode ser mexido sem autorização

## Hero

Já validada.

Não alterar:

* espaçamentos;
* gradientes;
* tamanhos;
* layout.

---

## front-end.css

Somente alterar quando solicitado.

---

## front-page.php

Somente alterar quando solicitado.

---

## functions.php

Adicionar apenas novos includes.

Nunca remover os existentes.

---

# Regra de Segurança

Se houver dúvida:

PARAR.

Perguntar antes de alterar.

---

# Estratégia de Continuidade

Caso seja necessário abrir um novo chat:

Enviar:

* README.md
* functions.php
* front-page.php
* customizer.php

Assim o projeto pode continuar sem perda de contexto.

---

Projeto desenvolvido por:

**Fabiano Maximiano**
Especialista em Presença Digital, SEO Local e Soluções Web.
