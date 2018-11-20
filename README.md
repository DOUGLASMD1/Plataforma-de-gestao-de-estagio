# Plataforma-de-gestao-de-estagio
Esta aplicação é um projeto final da matéria de Programação web do curso de sistemas de informação - CPAN-UFMS. A aplicação tem como objetivo gerenciar todo o processo de estágio.


Backend:<br />
1 - Importe o banco de dados da pasta BancodeDados <br />
2 - Execute o comando a seguir para gerar a pasta vendor: composer update <br />
3 - Renomeie o arquivo .env.example para: .env<br />
4 - Adicione as configurações da conexão com o banco no arquivo .env. Vale lembrar que você deve usar o nome do banco importado na etapa 1.<br />
5 - Gere a chave do projeto com o comando: php artisan key:generate<br />
6 - Gere um cliente passport para sua aplicação: php artisan passport:client --personal <br />
7 - Rode o servidor: php artisan serve <br />

FrontEnd:<br />
1 - npm i<br />
2 - npm i -g webpack-dev-server@1<br />
3 - npm rum dev<br />