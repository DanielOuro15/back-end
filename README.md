# Projeto Laravel Dockerizado

Este projeto é um sistema Laravel configurado para rodar em containers Docker, utilizando Docker Compose para gerenciar os serviços. O banco de dados utilizado é o SQLite. Este README fornece instruções detalhadas para configurar e executar o ambiente de desenvolvimento.

## Pré-requisitos

1 Certifique-se de ter o seguinte software instalado:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Passos para Configuração

1. **Clone o repositório**

   ```bash
   git clone https://github.com/seu-usuario/nome-do-repositorio.git
   cd nome-do-repositorio
2 Configure o arquivo .env

Crie o arquivo .env com as configurações do Laravel. Certifique-se de definir as seguintes variáveis para o SQLite:

DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
Nota: O arquivo .env pode ser baseado no .env.example disponível no repositório.

3 Estrutura de Arquivos Docker

O projeto inclui dois arquivos principais para configuração do Docker:

Dockerfile: Configura a imagem Docker para o aplicativo Laravel.
docker-compose.yml: Configura o Docker Compose para gerenciar o ambiente e rodar os containers necessários.

4 Inicie o ambiente Docker

Execute o seguinte comando para iniciar o ambiente:

docker-compose up --build
Esse comando:

Constrói a imagem Docker a partir do Dockerfile.
Instala as dependências do Laravel.
Cria o arquivo database.sqlite, roda as migrações e seeds.
Inicia o servidor Laravel.

5 Acessando a Aplicação

Após o comando "docker-compose up --build", a aplicação estará disponível em:

http://localhost:8000
Verifique se o servidor está funcionando e se as migrações e seeds foram executadas com sucesso.

Rotas Disponíveis
1 Registro de Usuário - POST http://127.0.0.1:8000/api/users

Body (JSON):
{
  "name": "Nome do Usuário",
  "email": "usuario@example.com",
  "password": "senha123",
  "password_confirmation": "senha123"
}

Authorization Barear {my_token}

2 Login de Admin - POST http://127.0.0.1:8000/api/login

Body (JSON):
{
  "email": "admin@example.com",
  "password": "admin"
}

Retorna um token JWT no campo token da resposta, que será usado para autenticação nas próximas requisições.
Obter Informações do Usuário Autenticado (Admin)

3 Login de Usuário - POST http://127.0.0.1:8000/api/login

Body (JSON):
{
  "email": "user5@teste.com",
  "password": "123"
}

4 Atualizar dados - POST http://127.0.0.1:8000/api/users/{id}

Requer autenticação como usuário admin.

Body (JSON):
{
  "name": "Nome do Usuário",
  "email": "usuario@example.com",
  "password": "senha123",
  "password_confirmation": "senha123"
  "profile_id": "2"
}

1 para admin
2 para user

5 Atualizar dados - POST http://127.0.0.1:8000/api/user

Body (JSON):
{
    "name": "user5",
    "email": "user5@teste.com",
    "password": "123456",
    "password_confirmation": "123456"
}

Requer autenticação como usuário comum.

Configurando o Authorization no Insomnia ou Postman
Após realizar o login e receber o token JWT, siga os passos abaixo para configurar o token no Insomnia ou Postman:

Copie o Token: Após a requisição de login, copie o valor do token retornado na resposta. O token tem o formato similar a 3|wbbYZzgSl81vcuvIMDhBSXwBh8iqCuDtfCPaIcgDa5f5f6b6.

Configuração no Insomnia ou Postman:

No Insomnia ou Postman, vá para a requisição que requer autenticação (ex: GET /api/user).

No cabeçalho da requisição, adicione o cabeçalho Authorization com o valor Bearer <seu_token_aqui>.

Nome do cabeçalho: Authorization
Valor: Bearer <seu_token_aqui>
Exemplo:

Authorization: Bearer 3|wbbYZzgSl81vcuvIMDhBSXwBh8iqCuDtfCPaIcgDa5f5f6b6
Envie a Requisição: Agora, ao enviar a requisição com o token de autorização, você deve receber a resposta autorizada conforme o perfil do usuário (admin ou comum).

Estrutura do Projeto
Dockerfile: Configura o ambiente PHP e instala as dependências do Laravel.
docker-compose.yml: Configura o ambiente de desenvolvimento com containers para o aplicativo Laravel e o banco de dados SQLite.

Comandos Úteis:

Startar o ambiênte: 

docker-compose up

Parar o ambiente:

docker-compose down
Acessar o container do app:

docker-compose exec app bash
Rodar migrações manualmente (dentro do container):

php artisan migrate
Rodar seeds manualmente (dentro do container):

php artisan db:seed
Observações
O banco de dados SQLite é criado automaticamente no diretório database.
Certifique-se de que o arquivo database.sqlite esteja corretamente configurado no .env para evitar erros de conexão.
Se precisar rodar comandos do Laravel diretamente, acesse o container app conforme mostrado acima.