# MusgoFramework

MusgoFramework é um **mini framework** criado com o objetivo de estudo e entendimento da arquitetura interna de frameworks modernos, sem dependências pesadas e sem abstrações ocultas.

O projeto prioriza **clareza**, **controle total do fluxo** e **código explícito**.

## 📁 Estrutura do Projeto

```text
MusgoFramework/
├── app/
│   ├── Chore/
|   |    └── CLI/
│   |        └── Commands/
│   ├── Helpers/
│   ├── Http/
│       └── Controllers/
├── bootstrap/
│   └── app.php
├── public/
│   └── index.php
├── resources/
│   └── views/
├── routes/
├── README.md
```
## Sistema de Rotas

As rotas são registradas de forma estática e armazenadas internamente.

- Exemplo de definição de rotas no arquivo routes/web.php:

- Rotas GET, POST, PUT e DELETE

- Suporte a rotas resource

- Resolução por expressão regular

- Parâmetros dinâmicos via URI

## Enum de Métodos HTTP

Os métodos HTTP são representados usando Enum, garantindo padronização e segurança de tipos.

- GET

- POST

- PUT

- DELETE

## Bootstrap da Aplicação

Toda a aplicação é inicializada a partir de um único arquivo de bootstrap.

Responsabilidades do bootstrap:

- Carregar o autoload do Composer

- Carregar configurações globais

- Registrar as rotas da aplicação

## CLI em PHP

O projeto possui uma CLI própria executada diretamente pelo terminal.

Exemplo de comando:

    php musgo help

A CLI permite listar rotas registradas e visualizar informações diretamente no terminal.

## Requisitos

- PHP 8.1 ou superior

- Composer

- Terminal com suporte a ANSI (Linux, macOS, Windows Terminal)

## Próximas adições
- Middleware básico
- Criação de controllers e views via terminal
- Configuração da aplicação por meio do arquivo .env

## Motivação

Projeto criado como ferramenta de estudo, explorando como frameworks funcionam internamente, com foco em aprendizado, clareza e domínio dos conceitos fundamentais.

## Autor

- Desenvolvido por: Hugo Josue Lema das Neves
