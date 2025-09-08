# bookverse

Olá! Meu nome e Vitor Alexandre eu e meu grupo somos a BookVerse uma empresa de e-commerce de venda de livros, o grupo e composto por 3 pessoas: Vitor alexandre, leonardo dos anjos e rodrigo soares, junto fizemos o site de vendas e essas sao as etapas do nosso site

1. Fundamentos do PHP
Nesta etapa, o foco foi no básico, como a sintaxe fundamental da linguagem. Foram explorados conceitos como a tag de abertura e fechamento <?php ... ?>, a forma de exibir conteúdo na tela com o comando echo e a criação de comentários para documentar o código. A compreensão desses pilares é crucial para qualquer projeto em PHP, pois eles formam a base sobre a qual todo o resto é construído.
2. Variáveis e Tipos de Dados
Com os fundamentos estabelecidos, o passo seguinte foi dominar a manipulação de dados. Aqui,  declaramos variáveis usando o símbolo $ e a atribuir diferentes tipos de dados a elas, como strings (texto), integers (números inteiros), floats (números com casas decimais) e booleans (verdadeiro ou falso). O conhecimento sobre a conversão de tipos de dados (type casting) também foi essencial para garantir que as operações fossem realizadas corretamente.
3. Estruturas de Controle
A terceira etapa introduziu a lógica de programação para criar fluxos de código dinâmicos., como if, else if e else, para executar blocos de código com base em condições específicas. Além disso, as estruturas de repetição, como for, while e do-while, permitiram automatizar tarefas repetitivas, otimizando o código e tornando-o mais eficiente.
4. Arrays
Nesta fase conhecimentos em como organizar e armazenar múltiplos valores de forma estruturada. Foi explorado o uso de arrays, tanto os numéricos (com índices inteiros) quanto os associativos (com chaves nomeadas). Aprender a percorrer esses arrays com laços de repetição (como foreach) e a manipular seus elementos foi fundamental para lidar com conjuntos de dados mais complexos.
5. GET/POST e Includes
O foco aqui foi na interação entre páginas web. Métodos de requisição GET e POST para enviar dados de um formulário para o servidor, permitindo a criação de páginas dinâmicas. O uso de include e require foi uma técnica importante para organizar o código, dividindo-o em arquivos menores (como cabeçalhos e rodapés) e reutilizando-os em várias páginas, o que melhora a manutenção e a legibilidade do projeto.
6. Funções
A sexta etapa foi sobre a criação de blocos de código reutilizáveis. Definir e a chamar funções para encapsular lógicas específicas. A capacidade de passar argumentos para essas funções e de retornar valores (com a palavra-chave return) tornou seu código mais modular e organizado. As funções são essenciais para evitar a repetição de código e para criar programas mais eficientes e fáceis de depurar.
7. Cookies e Sessões
Finalmente, esta fase se concentrou na persistência de dados do usuário entre diferentes requisições. O uso de cookies para armazenar informações no navegador do cliente por um período determinado. Em seguida sessões, que são uma forma mais segura de armazenar dados do usuário no servidor, criando um identificador único para cada visitante e permitindo a criação de sistemas de login e carrinhos de compra.
Minhas Anotações sobre Decisões Técnicas em PHP
GET vs. POST

Ao escolher entre os métodos GET e POST, a principal diferença é a segurança e a forma como os dados são enviados.
GET envia dados na URL. É ideal para buscas ou links que podem ser compartilhados, mas não é seguro para informações sensíveis, como senhas, e tem um limite de tamanho.
POST envia os dados de forma oculta, no corpo da requisição. É a forma segura de enviar dados confidenciais e permite o envio de grandes volumes de informação.

Cookies vs. Sessões
Para manter informações de um usuário entre as páginas, a escolha entre cookies e sessões depende de onde os dados serão guardados.
Cookies guardam dados no navegador do usuário. São úteis para preferências do site, mas não são seguros para dados importantes, pois o usuário pode apagá-los.
Sessões guardam dados de forma segura no servidor. São ideais para informações sensíveis, como o status de login, e os dados são perdidos quando o navegador é fechado.

Funções Próprias
Usar funções é essencial para evitar a repetição de código. Elas trazem três benefícios principais:
Reutilização: Permite que você escreva um código uma única vez e o use em vários lugares.
Manutenção: Se precisar fazer uma mudança, você só a faz em um lugar.
Organização: Deixa o código mais limpo e fácil de ler.
Em essência, funções ajudam a construir um projeto mais organizado, eficiente e fácil de manter.


<img width="768" height="185" alt="site_navigation" src="https://github.com/user-attachments/assets/ce60f687-69ad-4f2f-b9a6-32c800bf2bc5" />
este e o diagrama de todas as areas do nosso site
