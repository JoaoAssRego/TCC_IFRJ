<?php

// Carregar o Composer
require '../relatorio/vendor/autoload.php';

// Incluir conexao com BD
include_once './conexao.php';

// QUERY para recuperar os registros do banco de dados
$query_avaliador = "SELECT id_avaliador, nome, email, telefone, funcao, instituicao FROM avaliador";

// Prepara a QUERY
$result_avaliador = $conn->prepare($query_avaliador);

// Executar a QUERY
$result_avaliador->execute();

// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='http://localhost/atividade_colegio/relatorio/css/custom.css'>";
$dados .= "<title>Avaliador - Gerar PDF</title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<h1>Listagem dos Avaliadores</h1>";

// Ler os registros retornado do BD
while($row_avaliador = $result_avaliador->fetch(PDO::FETCH_ASSOC)){
    //var_dump($row_usuario);
    extract($row_avaliador);
    $dados .= "Id_avaliador: $id_avaliador <br>";
    $dados .= "Nome: $nome <br>";
    $dados .= "Email: $email <br>";
    $dados .= "Telefone: $telefone <br>";
    $dados .= "Função: $funcao <br>";
    $dados .= "Instituição: $instituicao <br>";
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
