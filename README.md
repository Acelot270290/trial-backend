
# Projeto Laravel com Docker

Este é um projeto Laravel rodando em containers Docker com suporte para MySQL, Redis e Nginx.

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes itens instalados no seu ambiente:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Passos para Configuração

### 1. Clonar o Repositório

Clone o repositório em seu ambiente local:

```bash
git clone https://github.com/seu-repositorio/trial-backend.git
cd trial-backend
```

### 2. Copiar o Arquivo `.env.example`

Copie o arquivo `.env.example` para `.env`:

```bash
cp .env.example .env
```

### 3. Configurar o Arquivo `.env`

Certifique-se de que as variáveis de ambiente estão configuradas corretamente no arquivo `.env`. Aqui está uma configuração de exemplo:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=trial_db
DB_USERNAME=trial-user
DB_PASSWORD=secret

QUEUE_CONNECTION=redis
REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

JWT_SECRET=
```

### 4. Gerar a Chave de Criptografia do Laravel

Após configurar o arquivo `.env`, execute o seguinte comando para gerar a chave de criptografia do Laravel:

```bash
docker exec -it trial_app php artisan key:generate
```

### 5. Gerar a Chave JWT

Para o JWT funcionar corretamente, você também precisa gerar a chave JWT:

```bash
docker exec -it trial_app php artisan jwt:secret
```

Isso gerará uma chave e preencherá automaticamente o campo `JWT_SECRET` no arquivo `.env`.

### 6. Subir os Containers com Docker

Agora que todas as configurações estão prontas, você pode iniciar os containers Docker:

```bash
docker-compose up --build -d
```

Isso fará o build da imagem e subirá os serviços em segundo plano.

### 7. Acessar a Aplicação

A aplicação estará acessível no navegador em:

```
http://localhost:0419
```

### 8. Acessar o Horizon

Se o Laravel Horizon estiver configurado no projeto, você poderá acessar o painel do Horizon em:

```
http://localhost:0419/horizon
```

## Serviços Docker

- **app**: Container PHP-FPM rodando o Laravel.
- **webserver**: Container Nginx para servir a aplicação.
- **db**: Container MySQL para o banco de dados.
- **redis**: Container Redis para filas e cache.

### 9. Executar Migrations (Opcional)

Se for necessário rodar as migrations para criar as tabelas no banco de dados, execute o seguinte comando:

```bash
docker exec -it trial_app php artisan migrate
```

### 10. Rodar Jobs

Para rodar os jobs na fila usando Redis, você pode iniciar o Horizon ou o worker de fila:

- **Horizon**:
  
  ```bash
  docker exec -it trial_app php artisan horizon
  ```

- **Worker de Fila**:
  
  ```bash
  docker exec -it trial_app php artisan queue:work
  ```

## Parar os Containers

Para parar todos os containers rodando:

```bash
docker-compose down
```

## Limpar o Cache de Configurações

Se você precisar limpar o cache de configurações do Laravel, execute o seguinte comando dentro do container:

```bash
docker exec -it trial_app php artisan config:cache
```

---

## Contato

Se você tiver qualquer dúvida ou problema, sinta-se à vontade para abrir uma issue ou entrar em contato com o mantenedor do projeto.
