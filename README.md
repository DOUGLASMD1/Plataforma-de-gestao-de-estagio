# Plataforma-de-gestao-de-estagio
Esta aplicação é um projeto final da matéria de Programação web do curso de sistemas de informação - CPAN-UFMS. A aplicação tem como objetivo gerenciar todo o processo de estágio.


WebService:<br />
1 - Crie um banco com o nome "estagio_ufms" e formato "utf8mb4_unicode_ci" <br />
2 - Apos criar o banco importe o banco de dados da pasta BancodeDados <br />
3 - Execute o comando a seguir para gerar a pasta vendor: composer update <br />
4 - Renomeie o arquivo .env.example para: .env<br />
5 - Adicione as configurações da conexão com o banco no arquivo .env. Vale lembrar que você deve usar o nome do banco declarado na etapa 1.<br />
6 - Gere a chave do projeto com o comando: php artisan key:generate<br />
7 - Instale o passport: php artisan passport:install<br />
8 - Gere um cliente passport para sua aplicação: php artisan passport:client --personal <br />
9 - Rode o servidor: php artisan serve <br />

FrontEnd:<br />
1 - npm i<br />
2 - npm i -g webpack-dev-server@1<br />
3 - npm rum dev<br />

Operações:<br />

Você pode utilizar o postman para testar a api do WebService. <br />
O banco que você importou ja vem com algumas informações inseridas, são elas: cursos, campus, instituição e roles. Para saber quais informações são necessarias para registrar seus dados, consulte os metodos dos models, neles que conterão os dados necessarios para realizar os registros. Antes de testar o FrotEnd lembre-se de criar um usuario primeiro. <br />
<br />

Caso tenha alguma duvida você pode entrar em contato com os desenvolvedores a partir do email: michaeldouglass.ferreira@gmail.com<br />