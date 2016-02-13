# Demonstrativo de utilização do pacote [resultsystems/laravel-paypal](https://github.com/resultsystems/laravel-paypal)

Todos os comandos mostrados abaixo devem ser executados no terminal

## Instalação

### Clone/Copie o repositório emtudo/laravel-paypal
```
git clone https://github.com/emtudo/laravel-paypal
```
### Entre na pasta do projeto
```
cd laravel-paypal
```

### Instale as dependências
```
composer install
npm install
```

## Configurações
### Faça uma cópia do arquivo .env.example com o nome de .env
```
cp .env.example .env
```

### Configure as variáveis dentro do .env de acordo com seus dados de email conta de paypal, banco de dados etc
```
vi .env
```

### Gere a key utilizada para encriptografar dados
```
php artisan key:generate
```

## Rode as migrates
```
php artisan migrate
```

## Rodando a aplicação
```
php artisan server
```
