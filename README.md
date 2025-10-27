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
