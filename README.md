Instruções para execução do código:

#ambiente
PHP 7.3 ou superior
MySQL 8.0 ou superior

#instruções
Efetuar o clone do repositório
Criar um database no MySQL
Ajustar o arquivo .env com o nome do banco, usuário e senha local.

Executar os seguintes comandos:
$ composer install
$ php artisan migrate
$ php -S localhost:8000 -t public
O sistema estará disponível em http://localhost:8000

Para acessar os endpoints (exceto a raíz) o cabeçalho de autenticação Bearer deverá estar presente com o token: 'avaliacao369'

Abaixo um exemplo do CURL (linux)
curl --location --request GET 'http://localhost:8000/movements_records/1' --header 'Authorization: Bearer avaliacao369'

##Testes PHPUnit
Versão 9.5
Para executar os testes:
$ ./vendor/bin/phpunit

Os testes estão disponíveis na classe ExampleTest dentro do diretório /tests

#Acesso
Para facilitar a avaliação, deixei o endpoint funcionando em um servidor no endereço:

https://tecno.webmond.com.br

curl --location --request GET 'https://tecno.webmond.com.br//movements_records/1' --header 'Authorization: Bearer avaliacao369'
