# SGTA - Sistema de Gerenciamento de Trabalhos e Avaliações

Sistema web para gerenciar trabalhos acadêmicos submetidos a eventos, permitindo que **alunos** inscrevam seus trabalhos e que **professores** possam avaliá-los. Após a avaliação, é possível gerar relatórios com os trabalhos e é realizado o envio de um email para notificação ao aluno. Além disso, **administradores** têm controle sobre os eventos e sobre as permissões de avaliação dos professores.

Este projeto foi desenvolvido como parte do Trabalho Final do segundo semestre da disciplina **Desenvolvimento Web II** do curso de Tecnólogo em Análise e Desenvolvimento de Sistemas — TADS — no Instituto Federal do Paraná — IFPR — Campus Paranaguá.


## Funcionalidades

- Cadastro e login de usuários (alunos e professores).
- Submissão de trabalhos pelos alunos.
- Avaliação de trabalhos pelos professores.
- Notificação por e-mail sobre o status da avaliação.
- Visualização de eventos, trabalhos e relatórios.
- Gerenciamento de eventos pelos administradores.

## Casos de Uso

![Casos de Uso](/docs/diagrama-casos-de-uso.png)

## Modelo Entidade-Relacionamento (ER)

![Modelo Entidade Relacionamento](/docs/diagrama-entidade-relacionamento.png)

## Tecnologias Utilizadas

- **Laravel 10**
- **PHP 8.1+**
- **Laravel Breeze**
- **Blade**
- **DOMPDF** (geração de relatórios em PDF)
- **Mailtrap** (para envio de emails em ambiente de desenvolvimento)
- **MySQL 8.0 (via Docker)**

## Execução do Projeto (Ambiente Local)

### Pré-requisitos

- PHP 8.1+
- Composer
- Node.js e npm
- Docker + Docker Compose

### Passos para execução

1. Clone o repositório:
```bash
git clone https://github.com/mitugui/gerenciamento-trabalhos-avaliacoes.git
cd gerenciamento-trabalhos-avaliacoes
```

2. Copie o `.env`:
```bash
cp .env.example .env
```

3. Edite o `.env` com suas credenciais de banco:
```env
DB_DATABASE=sgta
DB_USERNAME=root
DB_PASSWORD=suasenha
```

4.  Configure o Mailtrap para Teste de E-mails:

    Este projeto utiliza o **Mailtrap** para simular o envio de e-mails em ambiente de desenvolvimento, permitindo que você visualize e valide mensagens sem enviá-las para destinatários reais.

    Para configurá-lo, siga os passos abaixo:

    4.1. Crie uma conta gratuita em [mailtrap.io](https://mailtrap.io).
    
    4.2. No painel do Mailtrap, crie uma nova **"inbox"**.
    
    4.3. Na aba **"Integrations"**, selecione **"Laravel"** e copie as credenciais **SMTP**.
    
    4.4. Cole as informações da sua conta no arquivo `.env` do projeto, substituindo os valores `seu_user_mailtrap` e `sua_senha_mailtrap` pelas suas credenciais:

    ```env
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=seu_user_mailtrap
    MAIL_PASSWORD=sua_senha_mailtrap
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="no-reply@sgta.com"
    MAIL_FROM_NAME="${APP_NAME}"
    ```

5. Suba o container MySQL:
```bash
docker-compose up -d
```

6. Instale as dependências:
```bash
composer install
npm install
```

7. Gere a chave da aplicação:
```bash
php artisan key:generate
```

8. Rode as migrations e seeders:
```bash
php artisan migrate --seed
```

9. Inicie o servidor de desenvolvimento:
```bash
npm run dev
php artisan serve
```

10. Acesse o sistema em: [http://localhost:8080](http://localhost:8080)

## Contato

Caso queira contribuir ou reportar algum bug, fique à vontade para abrir uma issue ou pull request.