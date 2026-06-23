# Padrões Reutilizáveis - MKT Presença Digital

## Breadcrumb Global

### Objetivo

Centralizar a geração de breadcrumbs em uma única função reutilizável para todos os projetos WordPress.

---

## Função padrão

```php
mktpd_breadcrumb();
```

---

## Estrutura prevista

Arquivo:

```text
inc/template-tags.php
```

ou

```text
inc/helpers/breadcrumb.php
```

---

## Benefícios

* Código centralizado;
* Reutilização em todos os projetos;
* Facilidade de manutenção;
* Padronização visual;
* SEO mais consistente;
* Menor duplicação de código.

---

## Estrutura esperada

Exemplos:

```
Home > Quem Somos

Home > Serviços

Home > Serviços > Criação de Sites

Home > Projetos > Projeto ABC

Home > Blog > Categoria > Post
```

---

## Compatibilidade desejada

### Páginas

* Home
* Páginas institucionais

### Blog

* Posts
* Categorias
* Arquivos

### CPTs

* Serviços
* Projetos
* Outros CPTs futuros

### Singles

* Página atual usando `the_title()`

---

## Evolução futura

Adicionar Schema.org:

```json
BreadcrumbList
```

Objetivo:

* melhorar SEO;
* permitir breadcrumbs nos resultados do Google.

---

## Prioridade

Baixa.

Implementar somente após conclusão completa do site.

---

## Aplicação

Este padrão deverá ser reutilizado em todos os temas desenvolvidos pela MKT Presença Digital.
