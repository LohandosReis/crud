# crud

INSTITUTO FEDERAL DO TOCANTINS - CAMPUS PARAÍSO DO TOCANTINS
CURSO SUPERIOR SISTEMAS DE INFORMAÇÃO

Relatório Técnico: Desenvolvimento de Sistema CRUD de Contatos com PHP, MySQL e CSS

PARAÍSO DO TOCANTINS
2025
Componente: Linguagens e Técnicas de Programação III.
Professor: Marcos Raimundo Mendes Ramos.
Discentes:Lohan Pereira dos Reis e Gabriel Cunha Maximiano.
Data: 10/10/2025.
Período: 4º.

Relatório Técnico: Desenvolvimento de Sistema CRUD de Contatos com PHP, MySQL e CSS

1. Introdução
   Este relatório técnico documenta o desenvolvimento de um sistema para gerenciamento de contatos, projetado para executar as quatro operações fundamentais de manipulação de dados: Criar, Ler, Atualizar e Excluir (CRUD). O objetivo principal do projeto foi construir uma aplicação web funcional e didática que demonstrasse um fluxo completo de interação com um banco de dados. As tecnologias centrais empregadas foram PHP para toda a lógica de processamento no lado do servidor, MySQL para o armazenamento persistente dos dados e CSS para a estilização da interface do usuário, garantindo uma experiência visual coesa e moderna. Ao longo deste documento, serão detalhadas a arquitetura do sistema, o fluxo operacional das funcionalidades CRUD e as soluções técnicas implementadas para garantir a robustez e a manutenibilidade da aplicação.
2. Processo de desenvolvimento e arquitetura Geral do Sistema
   Uma arquitetura de sistema bem definida é crucial para a clareza, a escalabilidade e a manutenibilidade de qualquer projeto de software. Ao separar as responsabilidades em diferentes componentes, simplificamos o desenvolvimento e a depuração. Esta seção detalha a estrutura de arquivos que compõe a aplicação e o modelo de dados subjacente que suporta a funcionalidade de gerenciamento de contatos, fornecendo uma visão clara da organização do projeto.
   2.1. Estrutura de Arquivos e Componentes
   A aplicação é modularizada em um conjunto de arquivos PHP e CSS, cada um com uma responsabilidade específica, desde a exibição de dados até o processamento de formulários e a conexão com o banco de dados. A tabela abaixo descreve a função de cada componente principal.
   Arquivo
   Função
   index.php
   Página inicial que exibe a lista de todos os contatos cadastrados no banco de dados. Inclui botões de ação para edição e exclusão de cada registro.
   novo-usuario.php
   Apresenta o formulário HTML para o cadastro de um novo contato.
   criar.php
   Script PHP que processa os dados enviados pelo formulário de cadastro e insere no banco de dados.
   editar.php
   Página que exibe um formulário pré-preenchido com os dados atuais de um contato existente, permitindo sua modificação.
   atualizar.php
   Script PHP que recebe os dados modificados do formulário de edição e executa a atualização no banco de dados.
   excluir.php
   Script PHP responsável por receber o identificador de um contato e removê-lo permanentemente do banco de dados.
   conexao.php
   Arquivo central que estabelece e gerencia a conexão com o banco de dados MySQL. É incluído em todos os scripts que necessitam de acesso aos dados.
   style.css
   Estiliza a página principal (index.php), definindo um layout centralizado e moderno. É responsável pela aparência da tabela de contatos e pelos botões de ação, que incluem ícones visuais (e.g., ✎ para editar, 🗑 para excluir).
   style-editar.css
   Estiliza o formulário de edição (editar.php), com um layout limpo e botões de confirmação específicos como "✔ atualizar" e "↩ voltar".
   style-novo-usuario.css
   Estiliza o formulário de cadastro (novo-usuario.php), definindo a aparência de botões como "✔ salvar" para manter a consistência visual.

2.2. Modelo de Dados e Conexão
A persistência dos dados é gerenciada por um banco de dados MySQL denominado crud_contatos. Este banco contém uma única tabela, contatos, cuja estrutura foi projetada para armazenar as informações essenciais de cada registro de forma simples e eficiente.
Estrutura da Tabela contatos
Campo
Tipo
Descrição
id
INT (auto_increment, chave primária)
Identificador numérico único para cada contato, gerado automaticamente.
nome
VARCHAR(100)
Armazena o nome completo do contato.
email
VARCHAR(100)
Armazena o endereço de e-mail do contato.

O acesso a este banco de dados é centralizado no arquivo conexao.php. Este script utiliza a função mysqli_connect para estabelecer uma conexão com o servidor MySQL. Crucialmente, a implementação inclui uma verificação de falha na conexão que utiliza mysqli_connect_error() para exibir uma mensagem de erro clara e die() para interromper a execução, prevenindo que a aplicação tente operar sobre um banco de dados indisponível. Para garantir um acesso unificado e evitar a repetição de código, todos os outros scripts que necessitam interagir com o banco de dados incluem este arquivo através do comando include 'conexao.php';. Essa abordagem não apenas simplifica a manutenção, como também assegura que qualquer alteração nas credenciais de conexão precise ser feita em um único local. 3. Análise Detalhada da Implementação CRUD
As operações CRUD (Create, Read, Update, Delete) formam o núcleo funcional de qualquer sistema de gerenciamento de dados. Elas representam as ações fundamentais que um usuário pode realizar sobre os registros. Esta seção irá dissecar cada uma das quatro operações implementadas no sistema de contatos, detalhando o fluxo de interação do usuário, os scripts PHP envolvidos, as instruções SQL executadas e as funções PHP essenciais que viabilizam cada etapa do processo.
3.1. Operação de Criação (Create)
O processo de adição de um novo contato é iniciado pelo usuário na página novo-usuario.php. Nesta página, é apresentado um formulário HTML para a inserção de nome, e-mail e telefone. Ao submeter o formulário, os dados são enviados através do método POST para o script criar.php. Este script, por sua vez, acessa os dados enviados através da superglobal $_POST, que é o array padrão do PHP para coletar dados de formulários submetidos com o método POST, garantindo que os dados não fiquem visíveis na URL. Em seguida, ele constrói uma instrução SQL INSERT e a executa utilizando a função mysqli_query para registrar o novo contato na tabela contatos. Após a inserção bem-sucedida, o script utiliza a função header() para redirecionar o usuário de volta à página principal (index.php), onde a lista de contatos já reflete o novo registro.
3.2. Operação de Leitura (Read)
A exibição dos contatos cadastrados ocorre na página index.php. Ao ser carregada, a página executa uma consulta SQL SELECT para buscar todos os registros presentes na tabela contatos. O resultado desta consulta é então processado em um laço, onde a função mysqli_fetch_assoc() é utilizada para extrair cada linha de dados como um array associativo. Essa abordagem é preferível por utilizar os nomes das colunas como chaves, o que torna o código mais legível e manutenível (e.g., $linha['nome'] em vez de $linha[0]). Esses dados são dinamicamente renderizados dentro de uma tabela HTML. O script também utiliza a função mysqli_num_rows para verificar se existem registros no banco de dados; caso contrário, uma mensagem informativa é exibida. Em cada linha da tabela, são incluídos os botões de "Editar" e "Excluir", permitindo que o usuário inicie as operações de atualização ou exclusão para aquele registro específico.
3.3. Operação de Atualização (Update)
O fluxo de atualização começa quando o usuário clica no botão "Editar" na lista de contatos. Esta ação direciona o usuário para a página editar.php, passando o id do contato a ser modificado como um parâmetro na URL (ex: editar.php?id=5). A página editar.php captura este id através da superglobal $_GET, apropriada para receber parâmetros visíveis na URL, como identificadores de registro. Em seguida, realiza uma consulta ao banco para obter os dados atuais do contato e os utiliza para pré-preencher os campos do formulário de edição. Após o usuário realizar as alterações e submeter o formulário, os dados são enviados via POST para o script atualizar.php. Este script recebe as informações modificadas, constrói uma instrução SQL UPDATE com a cláusula WHERE para especificar o id do contato, e executa a atualização. Finalmente, o usuário é redirecionado de volta para index.php para visualizar a lista com os dados atualizados.
3.4. Operação de Exclusão (Delete)
A funcionalidade de exclusão é acionada pelo botão "Excluir" associado a cada contato na página index.php. Clicar neste botão envia o id do respectivo contato para o script excluir.php. Este script recebe o identificador e executa um comando SQL DELETE FROM contatos WHERE id = ?, utilizando mysqli_query para remover permanentemente o registro correspondente do banco de dados. Assim que a operação de exclusão é concluída, o script redireciona o usuário para a página inicial index.php, que exibe a lista de contatos agora sem o registro removido.
4. Interface do Usuário (UI) e Estilização
A separação clara entre a lógica de programação (backend) e a camada de apresentação (frontend) é uma prática fundamental para a organização e manutenibilidade de projetos web. No desenvolvimento deste sistema, foi dada atenção especial à criação de uma interface de usuário limpa, intuitiva e visualmente agradável. Esta seção aborda como a estilização foi implementada utilizando CSS para criar uma experiência de usuário coesa e moderna em todas as telas da aplicação.
4.1. Arquitetura de Estilos CSS
A abordagem de estilização adotada foi a de modularização, utilizando três folhas de estilo (CSS) independentes, cada uma com um escopo bem definido. Esta separação permite que o design de cada página seja gerenciado de forma otimizada, sem interferências indesejadas.
style.css: Responsável pela estilização da página principal (index.php), definindo o layout da tabela de contatos, os botões de ação e a aparência geral da listagem.
style-editar.css: Dedicada exclusivamente ao formulário da página de edição (editar.php), garantindo uma apresentação limpa e focada na tarefa de atualização de dados.
style-novo-usuario.css: Estiliza o formulário de cadastro de novos contatos (novo-usuario.php), mantendo a consistência visual com o restante da aplicação.
4.2. Identidade Visual e Experiência do Usuário
A identidade visual do sistema foi projetada para ser moderna e acessível, utilizando um conjunto de elementos de design consistentes em todas as páginas. Os principais componentes que definem esta identidade incluem:
Paleta de Cores: Uso de cores suaves, com destaque para a cor primária #6c63ff, que confere um toque moderno e profissional à interface.
Elementos Visuais: Aplicação de sombras leves e cantos arredondados em elementos como botões e contêineres, criando uma sensação de profundidade e um visual mais polido.
Responsividade: O layout foi construído para ser responsivo, garantindo que a aplicação se adapte adequadamente a diferentes tamanhos de tela, desde desktops até dispositivos móveis.
5. Análise Técnica de Desafios e Soluções
Durante qualquer ciclo de desenvolvimento, a identificação e a resolução de desafios técnicos são etapas inevitáveis que moldam a qualidade do produto final. A capacidade de antecipar problemas e implementar soluções robustas é um indicador de maturidade técnica. Esta seção apresenta, de forma estruturada, os principais obstáculos encontrados durante a construção do sistema CRUD e as soluções implementadas, justificando as escolhas técnicas que garantiram a eficiência e a estabilidade da aplicação.
Desafio Técnico
Solução Implementada e Justificativa
Garantir a disponibilidade do banco de dados
Foi implementado um sistema de checagem de erros logo após a tentativa de conexão em conexao.php. Se a conexão falhar, o script é interrompido imediatamente com die() e exibe uma mensagem clara usando mysqli_connect_error(). Isso garante que nenhuma operação no banco seja tentada sem uma conexão válida.
Manter a integridade da lista após operações
Após a execução de INSERT (criar.php), UPDATE (atualizar.php) ou DELETE (excluir.php), o usuário precisava ser direcionado de volta à lista atualizada. A solução foi utilizar a função header("Location: index.php"). Justificativa: Esta função garante que o navegador seja instruído a fazer um novo pedido para a página inicial, exibindo o estado atualizado da tabela.
Garantir acesso unificado ao Banco de Dados (DB)
Evitar a repetição de código de conexão em todos os arquivos. A solução foi centralizar a conexão em conexao.php e usar a instrução include 'conexao.php'; em todos os outros scripts PHP. Justificativa: Isso assegura que todos os arquivos PHP compartilhem a mesma variável de conexão ($conn), garantindo acesso unificado e facilitando a manutenção.
Separar lógica de apresentação (Design)
O desafio era criar uma identidade visual consistente e moderna. A solução foi criar três folhas de estilo CSS independentes (style.css, style-editar.css, style-novo-usuario.css). Justificativa: Essa separação permite gerenciar o layout da página principal, do formulário de edição e do formulário de cadastro de forma otimizada, mantendo um visual consistente (cores suaves, cantos arredondados, responsividade).

6. Fluxo de Integração do Sistema
   Para visualizar o processo completo e a navegação do usuário de forma clara, é essencial mapear a interação entre os diferentes arquivos que compõem a aplicação. A integração coesa desses componentes garante uma experiência de usuário fluida e previsível. A descrição a seguir representa o mapa de processos do sistema, ilustrando o fluxo de interação a partir da página principal para cada uma das ações CRUD.
   Página de Origem: index.php (Exibe a lista de contatos)
   Ação do Usuário: Clica em "Adicionar Contato"
   Página/Script de Destino: novo-usuario.php (Exibe o formulário de cadastro) -> criar.php (Processa e insere os dados)
   Retorno: Redirecionado para index.php
   Página de Origem: index.php (Exibe a lista de contatos)
   Ação do Usuário: Clica em "Editar"
   Página/Script de Destino: editar.php (Exibe formulário com dados existentes) -> atualizar.php (Processa e atualiza os dados)
   Retorno: Redirecionado para index.php
   Página de Origem: index.php (Exibe a lista de contatos)
   Ação do Usuário: Clica em "Excluir"
   Página/Script de Destino: excluir.php (Processa a exclusão do registro)
   Retorno: Redirecionado para index.php
   Todos os arquivos PHP que interagem com o banco de dados compartilham a conexão estabelecida em conexao.php, garantindo um ponto de acesso centralizado e consistente aos dados.
   O desenvolvimento da aplicação web de gerenciamento de contatos utilizou um conjunto específico de tecnologias, recursos de linguagem (PHP) e ferramentas de estilização (CSS).
7. Recursos, ferramentas e tecnologias centrais
   As tecnologias centrais empregadas no projeto, responsáveis pela lógica de backend, persistência de dados e apresentação, foram:
   PHP: Utilizado para toda a lógica de processamento no lado do servidor. O PHP foi fundamental para o controle do fluxo da aplicação, o processamento de formulários e a interação com o banco de dados.
   MySQL: Utilizado para o armazenamento persistente dos dados. O banco de dados foi denominado crud_contatos e contém a tabela principal contatos, que armazena o id, nome e email dos contatos.
   CSS: Utilizado para a estilização da interface do usuário, garantindo uma experiência visual coesa e moderna.
   7.1. Recursos de Programação PHP e Acesso a Dados (MySQLi)
   Diversos recursos e funções nativas do PHP e da extensão MySQLi foram essenciais para viabilizar as operações CRUD:
   Recurso/Função
   Função no Projeto e Potencialização
   conexao.php
   Arquivo central que estabelece e gerencia a conexão com o banco de dados MySQL. Sua inclusão (include 'conexao.php';) em todos os scripts garante acesso unificado e facilita a manutenção.
   mysqli_connect()
   Função utilizada dentro do conexao.php para estabelecer a conexão com o servidor MySQL.
   mysqli_connect_error() e die()
   Utilizados para implementar a checagem de erros na conexão. Se houver falha, o script é interrompido (die()), exibindo uma mensagem de erro clara.
   mysqli_query()
   Função essencial para executar todas as instruções SQL (INSERT, SELECT, UPDATE, DELETE) no banco de dados.
   mysqli_fetch_assoc()
   Utilizada na operação de Leitura (index.php) para extrair cada linha de dados como um array associativo, o que torna o código mais legível ao usar nomes de colunas como chaves (e.g., $linha['nome']).
   Superglobal $\_POST
   Array padrão do PHP usado para coletar dados de formulários submetidos (nas operações de Criação e Atualização), garantindo que os dados não fiquem visíveis na URL.
   Superglobal $\_GET
   Usada para capturar parâmetros visíveis na URL, como o id do contato a ser editado ou excluído, que é essencial para as operações de Atualização e Exclusão.
   Função header("Location:...")
   Utilizada para redirecionar o usuário de volta à página principal (index.php) após operações de Criação, Atualização e Exclusão, garantindo que a lista de contatos seja exibida com o estado atualizado da tabela.

7.2. Recursos de Estilização (CSS)
A arquitetura de estilos foi modularizada, usando folhas de estilo independentes para otimizar o design e garantir a consistência visual:
style.css: Estiliza a página principal (index.php) e define o layout da tabela de contatos.
style-editar.css: Dedicada ao formulário de edição (editar.php), garantindo uma apresentação limpa e focada.
style-novo-usuario.css: Estiliza o formulário de cadastro (novo-usuario.php), mantendo a consistência visual com o restante da aplicação.
A estilização utilizou uma paleta de cores suaves (com destaque para a cor primária #6c63ff), sombras leves e cantos arredondados para criar uma interface moderna e acessível. O layout foi construído para ser responsivo, adaptando-se a diferentes tamanhos de tela.

8. Conclusão
   O projeto de desenvolvimento do sistema CRUD de contatos foi concluído com sucesso, cumprindo todos os requisitos funcionais estabelecidos. A aplicação demonstra de forma eficaz a implementação das operações de criação, leitura, atualização e exclusão de registros, utilizando uma arquitetura simples e organizada. Os pontos fortes do projeto incluem a clareza do código PHP, a interação eficiente com o banco de dados MySQL, o layout moderno e responsivo proporcionado pelo CSS e a separação adequada entre a lógica de negócio e a camada de apresentação. Este sistema serve como uma base sólida e pode ser expandido futuramente com funcionalidades adicionais, como a implementação de autenticação de usuários, a adição de filtros de busca e a introdução de paginação para gerenciar grandes volumes de dados.
