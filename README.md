<p align="center"><a href="http://takeout.firsteducation.edu.mz/" target="_blank"><img src="https://github.com/Edmetrio/Pepa/blob/main/public/assets/images/logo/icons.png" width="200"></a></p>

<p align="center">
<a href="http://pepa.co.mz/">Plataforma de Agronegócio</a>  |
<a href="http://firsteducation.edu.mz/">Agênica Acadêmica</a>  |
<a href="http://www.simaratours.co.mz/">Agência de Viagem</a>
</p>

## 1.   Introdução

A plataforma desenvolvida tem como objectivo principal disponibilizar aos seus utilizadores finais (clientes), meios para a compra de material agrícola num modelo B2C (Business to Customer – Empresa para cliente) que significa que todos os utilizadores podem são compradores e que a Empresa dispobiliza material agrícola. A materialização da plataforma consistiu na criação e combinação de 3 aplicações, uma aplicação móvel (Android), uma aplicação backend para a gestão da base de dados (API) e serviços no servidor remoto e uma aplicação (Web) que servirá de painel de administrador da plataforma e venda de dos produtos agrícolas.:



## 2.	Funcionalidades gerais do sistema

- Publicação, listagem, pesquisa e visualização de material em diferentes categorias;
- Cadastro, autenticação e gestão de utilizadores;).
- Venda do material publicado;
- Pagamentos via cartões de débito e crédito e serviços móveis (m-pesa, e-mola, mkesh) *
- Administração e gestão de utilizadores;
- Gestão de estoques.

## 3.   Funcionalidades por cada aplicação
### a)  Aplicativo Móvel

A aplicação móvel a ser desenvolvida estará disponível para os utilizadores finais (potenciais clientes e fornecedores) na versão Android e publicada na Google Play Store. Através dela os utilizadores terão acesso aos serviços e funcionalidades da plataforma que permitem

### Ao Cliente

- Pesquisar, listar e visualizar todo o material disponível, organizado em categorias
- Adicionar material à lista de favoritos e/ou carrinho de compras
- Efectuar pagamentos na compra de qualquer produto;
- Receber notificações de confirmação de pagamentos;
- Receber notificações sobre o estado da compra
- Ver o histórico de compras;
- Gerir o perfil.

### b) Aplicação backend

Esta é a peça mais importante de toda a plataforma, pois só através dela funciona as outras duas aplicações. Todos os pedidos e dados fornecidos e visualizados nos outros aplicativos são processados por esta aplicação que está hospedada no nosso servidor. As principais tarefas da aplicação incluem:
- Armazenar toda a informação dos utilizadores cadastrados
- Fornecer serviços de autenticação para o administrador e todos os outros utilizadores
- Integrar e processar todos os serviços externos da plataforma (autenticação, notificações via firebase e pagamentos)
- Armazenar e fornecer toda a informação relacionada ao material publicado incluindo os pagamentos e históricos numa base de dados e as imagens no servidor.

### c)	Painel de administrador

Esta aplicação está disponível apenas para o administrador/dono da plataforma e através dela será possível ter uma visão geral de toda a plataforma. Através dela o administrador poderá: 
- Gerir os utilizadores
- Definir as categorias do material publicado 
- Enviar notificações para os utilizadores (todos ou individualmente)
- Extrair relatórios das publicações e dos pagamentos
- Acompanhar o estado de todas as compras


## 4. Metodologia de Desenvolvimento RUP

RUP é uma metodologia de análise e desenvolvimento de sistemas orientados a objecto baseado na notação UML. RUP atende as necessidades dos utilizadores garantido uma produção de software de alta qualidade que cumpra um cronograma e um orçamento previsíveis.

### Fases do RUP
- Concepção;
- Elaboração;
- Construção;
- Transição.


## 5. Esquema de Base de dados
Modelo de domínio, ou seja, relação entre as tabelas da base de dados é a representação visual do projecto da base de dados ou objectos do mundo real que devem ser representadas no sistema.

## 6. Ferramentas do processo de desenvolvimento do Software
O processo de escolha das ferramentas deve ter em conta as tecnologias utiizadas no ambiente da implementação, assim como as vantagens e desvantagens desta ferramenta em relação a outras existentes. Para desenvolver o software utilizou-se as seguintes ferramentas: linguagem de modelação UML, linguagem de programação PHP, framework laravel, sistema de gestão de base de dados MySQL, PostMan para testagem de API e ambiente de desenvolvimento Visual Studio.

## 7. Anexos de Telas
Telas: são apresentadas as telas que compõem o sistema.
