## Sobre
API feita em PHP.  <br>veja uma demonstração (https://api-mercadinho-mts.herokuapp.com/)<br>
Rotas (https://github.com//deigonPrates/api-mercadinho/blob/main/.files/Insomnia.json)<br>
Dump da base de dados (https://github.com//deigonPrates/api-mercadinho/blob/main/.files/database.sql)


## Requisitos⚠️

- PHP 7.4 ou superior (https://www.php.net/)
- Composer (https://getcomposer.org/)
- Dlls do PostgreSQL habilitadas (https://www.phptutorial.net/php-pdo/pdo-connecting-to-postgresql/)


## Recomendação🚀
- Insomnia (https://insomnia.rest/download) 
- Phpstorm (https://www.jetbrains.com/phpstorm)

## Instalação 👨‍💻
1) Intalando as dependências<br>
   ```
   composer install
   ```
2) Baixe o dump e restaure o banco
   ```
   https://github.com//deigonPrates/api-mercadinho/blob/main/.files/database.sql
   ```
3) Acesse o arquivo Conexao.php <br>
   ```
    App/config
   ```
4) Altere as variaveis de conexão ao banco<br>
   ```
    DB_HOST'     , "localhost";
    DB_USER'     , "user";
    DB_PASSWORD' , "123456789";
    DB_NAME'     , "mercado";
   ```
   
5) Inicie a aplicação<br>
   ```
    php -S localhost:8080
   ```
