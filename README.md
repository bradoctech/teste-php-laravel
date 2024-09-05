# AI Solutions

## Ambiente Docker

Foi utlizado a arquitetura abaixo para concepção do projeto.


Estilo arquitetural: Hexagonal

Conceitos utilizados: Services, Repository, DI, IoC, Acl, Docker e outros padrões.

OBS: Portas 80, 8081, 3306 e 6379 precisam estar liberadas.

1. Clonar o repositório:
     ```
    git clone https://github.com/nilbertooliveira/teste-php-laravel-ai-solutions.git
     ```

2. Rodar o comando abaixo para fazer o build do projeto, pulling das images, criar rede externa e hosts:
   ```
   ./entrypoint.sh 
   docker-compose up -d
   ```
3. Instalar as dependências e permissões:
    ```
    docker exec app composer install
    docker exec app npm install
    docker exec app npm run build
    sudo chmod -R 777 storage/
    ```

4. Configurar a base de dados
    ```
    docker exec app php artisan migrate
    docker exec app php artisan db:seed
    ```
5. Executar testes  (Arquivo: data/test.json)
    ```
   docker exec app php artisan test
    ```
6. Executar jobs
    ```
   docker exec app php artisan horizon
    ```
   O titulo do documento está como único e  importando a segunda vez os erros vão para failed_jobs intencionalmente


7. Dados para teste:
    ```
    Host: 54.198.116.11
    Email: administrator@test.com.br
    Password: 123456
    ```


### Primeira Tarefa:

Crítica das Migrations e Seeders: Aponte problemas, se houver, e solucione; Implemente melhorias;

categories
1) Incluir índice único em name e um index do tipo HASH para acelerar a consulta de dados exatos(Manual statement)
2) Ordenar os tipos de colunas para melhor leitura e identificação dos campos e manutenção EX(Id, campos obrigatórios, campos opcionais, FKs)
3) O tamanho da coluna name com apenas 20 caracteres pode impedir a evolução da aplicação e exigir mudança depois em um grande volume de dados.

documents

1) O campo bigInteger  possui menos performance, pois armazena o sinal do dígito ( - ou +)
   Como estamos falando de volumes importados, isto trará impactos.
2) Podemos incluir um índice para as FKs para aumentar o desempenho em leitura, porem na escrita fica mais lento e ocupa mais espaço(Avaliar as regras do processo)
3) O tamanho da coluna name com title 60 caracteres pode impedir a evolução da aplicação e exigir mudança depois em um grande volume de dados.
4) Title caso seja único, deve ser criado o index unique e index de desepenh
5) Utilização de cascade pode ser um problema ao deletar uma categoria, apagando toda a árvore
6) Poderia ser usado um index do tipo FULLTEXT para content para agilizar a leitura, porem gravação perde desempenho.

Recomendado criar indexes separado para separação de responsabilidades e manutenção.

### Segunda Tarefa:

Crie a estrutura completa de uma tela que permita adicionar a importação do arquivo `storage/data/2023-03-28.json`, para a tabela `documents`. onde cada registro representado neste arquivo seja adicionado a uma fila para importação.

Feito isso crie uma tela com um botão simples que dispara o processamento desta fila.

Utilize os padrões que preferir para as tarefas.

### Terceira Tarefa:

Crie um test unitário que valide o tamanho máximo do campo conteúdo.

Crie um test unitário que valide a seguinte regra:

Se a categoria for "Remessa" o título do registro deve conter a palavra "semestre", caso contrário deve emitir um erro de registro inválido.
Se a caterogia for "Remessa Parcial", o titulo deve conter o nome de um mês(Janeiro, Fevereiro, etc), caso contrário deve emitir um erro de registro inválido.


Boa sorte!
