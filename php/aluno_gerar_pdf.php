<?php

// Carregar o Composer
require '../relatorio/vendor/autoload.php';

// Incluir conexao com BD
include_once './conexao.php';

// QUERY para recuperar os registros do banco de dados
$query_aluno = "SELECT matricula, nome, curso, email, telefone, id_tcc FROM aluno";

// Prepara a QUERY
$result_aluno = $conn->prepare($query_aluno);

// Executar a QUERY
$result_aluno->execute();

// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='http://localhost/atividade_colegio/relatorio/css/custom.css'>";
$dados .= "<title>Alunos - Gerar PDF</title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<h1>Listar os Alunos</h1>";

// Ler os registros retornado do BD
while($row_aluno = $result_aluno->fetch(PDO::FETCH_ASSOC)){
    //var_dump($row_usuario);
    extract($row_aluno);
    $dados .= "Matricula: $matricula <br>";
    $dados .= "Nome: $nome <br>";
    $dados .= "Curso: $curso <br>";
    $dados .= "Email: $email <br>";
    $dados .= "Telefone: $telefone <br>";
    $dados .= "Id_tcc: $id_tcc <br>";
    $dados .= "<hr>";
}

$dados .= "<img src='http://localhost/atividade_colegio/images/ifrj_logo (1).jpg'>";




// Referenciar o namespace Dompdf
use Dompdf\Dompdf;

// Instanciar e usar a classe dompdf
$dompdf = new Dompdf(['enable_remote' => true]);

// Instanciar o metodo loadHtml e enviar o conteudo do PDF
$dompdf->loadHtml($dados);

// Configurar o tamanho e a orientacao do papel
// landscape - Imprimir no formato paisagem
//$dompdf->setPaper('A4', 'landscape');
// portrait - Imprimir no formato retrato
$dompdf->setPaper('A4', 'portrait');

// Renderizar o HTML como PDF
$dompdf->render();

// Gerar o PDF
$dompdf->stream();
