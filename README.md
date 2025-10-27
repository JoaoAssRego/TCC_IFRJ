# 📚 Acervo de TCCs - Ensino Médio Técnico em Informática

## ⚡ Descrição Rápida

**TCC Acervo Digital (Ensino Médio Técnico):** Plataforma web (uso local) desenvolvida para catalogar, armazenar e gerenciar o acervo de Trabalhos de Conclusão de Curso (TCCs) da instituição. O sistema atua como uma base de referência essencial para novos alunos.

## 🎓 Contexto do Projeto

Este repositório armazena o **Trabalho de Conclusão de Curso (TCC)** desenvolvido como requisito final para a obtenção do diploma de **Técnico em Informática Integrado ao Ensino Médio**.

O projeto foi inteiramente concebido e implementado durante o período do curso técnico, representando a aplicação prática e consolidada dos conhecimentos adquiridos em lógica de programação, desenvolvimento web (Frontend e Backend) e modelagem de banco de dados.

## 🎯 Objetivo

Criar uma plataforma digital de uso local para a administração do acervo de TCCs, permitindo:

1.  **Gerenciamento Completo (CRUD):** Inserção, Pesquisa, Alteração e Exclusão de informações sobre TCCs, Alunos, Avaliadores e Orientadores.
2.  **Base de Referência:** Oferecer aos estudantes uma ferramenta para consulta rápida de projetos anteriores.
3.  **Relatórios:** Gerar documentos em PDF para registro e auditoria dos dados.

## ✨ Funcionalidades Principais

O sistema é baseado em módulos de CRUD para as seguintes entidades:

* **TCCs:** Inserção de título, ano, resumo e o arquivo do trabalho.
* **Alunos:** Cadastro e gerenciamento dos autores dos projetos.
* **Orientadores:** Cadastro dos professores responsáveis pela orientação.
* **Avaliadores:** Cadastro dos membros da banca examinadora.
* **Avaliações:** Registro da data, situação e considerações da defesa.
* **Geração de Relatórios:** Exportação dos dados de todas as entidades para arquivos **PDF**.

## 🛠️ Tecnologias Utilizadas

| Categoria | Tecnologia | Detalhe |
| :--- | :--- | :--- |
| **Backend** | **PHP** | Lógica de negócio, manipulação de dados e conexão com o SGBD. |
| **Banco de Dados (SGBD)** | **MySQL / MariaDB** | Utilizado para persistência dos dados. Nome do BD: `colegio`. |
| **Geração de PDF** | **Dompdf** | Biblioteca utilizada para exportar relatórios em formato PDF. |
| **Frontend** | **HTML5, CSS3, JavaScript** | Estrutura e interatividade da interface. |
| **Framework CSS** | **Bootstrap v5+** | Utilizado para garantir o design responsivo e a estrutura de menus (Sidebar). |

## 📁 Estrutura do Repositório
```
├── php/ (Arquivos de backend PHP, CRUD e lógica de conexão)
  │ ├── aluno.php
  │ ├── avaliacao.php
  │ ├── avaliador.php
  │ ├── orientador.php (Arquivos confirmados pela estrutura do menu) 
  │ ├── tcc.php
  │ ├── conexao.php (Configuração de conexão com o banco de dados) 
  │ └── *_gerar_pdf.php (Arquivos para geração de relatórios em PDF) 

├── css/ (Arquivos de estilo, incluindo Bootstrap e estilos customizados) 

├── js/ (Arquivos de script JavaScript) 

├── images/ (Imagens do projeto, como logos) 

├── relatorio/ (Contém a estrutura da biblioteca Dompdf (vendor/autoload)) 
│ ├── index.html (Página inicial simples) ├── index_sidebar.html (Menu principal com sidebar Bootstrap) 
  
├── banco/ (Banco de dados MySQL)
│ ├── colegio.sql (Script de criação das tabelas e banco de dados)
```

## 🚀 Como Executar o Projeto

Este projeto é um sistema web local e requer um ambiente de servidor local para funcionar corretamente.

### Pré-requisitos
* Servidor Web Local (Ex: **XAMPP**, **WAMP**, **MAMP** ou similar).
* PHP (Recomendado PHP 7.x ou 8.x).
* MySQL/MariaDB.

### Passos de Instalação

1.  **Clone o Repositório:**
    ```bash
    git clone [URL_DO_SEU_REPOSITORIO]
    ```
2.  **Configurar Ambiente:**
    * Mova o projeto clonado para a pasta de documentos do seu servidor local (Ex: `htdocs` no XAMPP).
3.  **Configurar Banco de Dados:**
    * Abra o painel de administração do MySQL (Ex: phpMyAdmin).
    * Crie um novo banco de dados chamado **`colegio`**.
    * Importe o arquivo **`colegio.sql`** (localizado na raiz do projeto) para o banco de dados `colegio`.
4.  **Verificar Conexão:**
    * O arquivo `php/conexao.php` está configurado para:
        * **Host:** `localhost`
        * **User:** `root`
        * **Pass:** `` (Vazio)
    * **Observação:** O script `colegio.sql` cria o BD `colegio`, mas o `conexao.php` busca por `armazenamento_tcc`. Se o sistema não funcionar, ajuste o nome do BD no `conexao.php` para **`colegio`**.
5.  **Acessar:**
    * Abra seu navegador e acesse o projeto (Ex: `http://localhost/[NomeDaPastaDoProjeto]/index.html`).

## 👨‍💻 Autores

| Função | Nome | Contato |
| :--- | :--- | :--- |
| **Desenvolvedor(a) Principal** | [Seu Nome Completo] | [Link do LinkedIn ou GitHub] |
| **Orientador(a)** | [Nome do Professor Orientador] | |

---
*Este projeto foi desenvolvido com orgulho em [Ano do TCC], representando a conclusão do curso Técnico em Informática.*
