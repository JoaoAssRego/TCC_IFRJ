<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="https://portal.ifrj.edu.br/sites/all/themes/ifrj/favicon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" type="text/css" href="../style.css">

    <title>Sistema - TCC | IFRJ</title>
</head>
<body>
    <div id="cabecalho">
        <a href="../index.html" title="Logo IFRJ">
            <img src="../images/logo-ifrj.png" alt="Logo IFRJ">
        </a>
    </div>

    <div id="container-1">
        <div id="titulo-1">
            <h1 style="font-size: 18px;">Sistema de administração de cursos</h1>

            <a href="../index.html" id="botao-menu">Menu principal</a>

            <a href="./tcc.php" id="botao-menu">Voltar para opções</a>
        </div>
    </div>

    <div id="container-2">
        <?php
            //mudar para a base de banco de dados do nosso trabalho
            $connect = mysqli_connect('127.0.0.1', 'root', '', 'armazenamento_tcc');

            if (!isset($_POST['opcao'])) {
                echo"
                <div id='formulario-escolha'>
                    <h2 class='msg-erro'>Retorne e selecione uma opção!</h2><br>
    
                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                </div>
                ";
            } else {
                $opcao = $_POST['opcao'];
                $operacao = $_POST['operacao'];

                if ($operacao == 1) {
                    switch ($opcao) {
                        case 1:
                            echo"
                                <div style='padding-bottom: 30px;'>
                                    <form action='tcc2.php' method='POST' id='formulario-escolha'>
                                        <h2 id='titulo-2'>Insira as informações do tcc</h2><br>
            
                                        <div class='div-form'>
                                            <label for='id_tcc'>Id do Tcc</label>
                                        
                                            <input type='text' name='id_tcc' id='id_tcc'><br><br>
            
                                            <label for='titulo'>Titulo do Tcc:</label>
            
                                            <input type='text' name='titulo' id='titulo' required><br><br>
            
                                            <label for='ano'> Ano: (xxxx-xx-xx)</label>
            
                                            <input type='text' name='ano' id='ano' ><br><br>
            
                                            <label for='resumo'> Resumo:</label>
            
                                            <input type='text' name='resumo' id='resumo' required><br><br>
            
                                            <label for='id_orientador'>Id do orientador: </label>
            
                                            <input type='text' name='id_orientador' id='id_orientador' required><br><br>
            
                                        </div><br>
            
                                        <input type='hidden' name='operacao' value='2'>
        
                                        <input type='hidden' name='opcao' value='1'>
        
            
                                        <div>
                                            <button type='submit'>Inserir Tcc</button>
            
                                            <button type='reset'>Limpar formulário</button>
                                        </div>
                                    </form>
                                </div>
                                ";
                                break;
                        
                        case 2:
                            echo"
                            <form action='tcc2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira o Id do Tcc para efetuar a pesquisa</h2><br>
        
                                <div>
                                    <label for='id_tcc'>Id do Tcc:</label>
                                            
                                    <input type='text' name='id_tcc' id='id_tcc' required maxlength='11'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='2'>
        
                                <div>
                                    <button type='submit'>Pesquisar Tcc</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;
                        
                        case 3:
                            $sql = "select * from tcc;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum Tcc cadastrado.</h2><br>
    
                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 id='titulo-2'>Veja abaixo todos os Tccs cadastrados</h2><br>

                                    <table id='tabela-mostrar'>
                                        <tr>
                                            <th>Id do Tcc</th>
                                            <th>Titulo</th>
                                            <th>Ano</th>
                                            <th>Resumo</th>
                                            <th>Id do orientador</th>
                                        </tr>
                                ";

                                $campos = mysqli_fetch_array($requisicao);
                                
                                for ($i=0; $i < $campos; $i++) { 
                                    $id_tcc = $campos['id_tcc'];
                                    $titulo = $campos['titulo'];
                                    $ano = $campos['ano'];
                                    $resumo = $campos['resumo'];
                                    $id_orientador = $campos['id_orientador'];


                                    echo"
                                        <tr>
                                            <td>$id_tcc</td>
                                            <td>$titulo</td>
                                            <td>$ano</td>
                                            <td>$resumo</td>
                                            <td>$id_orientador</td>
                                        </tr>
                                    ";

                                    $campos = mysqli_fetch_assoc($requisicao);
                                }

                                echo"
                                    </table><br>
                                
                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a><br>
                                    <a href='./tcc_gerar_pdf.php'><button name='botao-retornar'>Gerar em Pdf</button></a>
                                    </div>
                                ";
                            }
                            break;

                        case 4:
                            echo"
                            <form action='tcc2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira o Id do tcc que você deseja alterar</h2><br>
        
                                <div>
                                    <label for='id_tcc'>Id do Tcc:</label>
                                            
                                    <input type='text' name='id_tcc' id='id_tcc'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='3'>
        
                                <div>
                                    <button type='submit'>Alterar Tcc</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;

                        case 5:
                            echo"
                            <form action='tcc2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira o Id do Tcc que você deseja excluir</h2><br>
        
                                <div>
                                    <label for='id_tcc'>Id do Tcc:</label>
                                            
                                    <input type='text' name='id_tcc' id='id_tcc'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='4'>
        
                                <div>
                                    <button type='submit'>Excluir Tcc</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;
                    } 
                }     
                
                if ($operacao == 2) {
                    switch ($opcao) {
                        case 1:
                            $id_tcc = $_POST['id_tcc'];
                            $titulo = $_POST['titulo'];
                            $ano = $_POST['ano'];
                            $resumo = $_POST['resumo'];
                            $id_orientador = $_POST['id_orientador'];
    
                            $sql = "insert into tcc values ('$id_tcc', '$titulo', '$ano', '$resumo', '$id_orientador');";  
    
                            $requisicao = mysqli_query($connect, $sql);
    
                            if ($requisicao == true) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Tcc criado com sucesso!</h2><br>
    
                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Houve um erro na criação do Tcc, tente novamente.</h2><br>
    
                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;

                        case 2:
                            $id_tcc = $_POST['id_tcc'];

                            $sql = "select * from tcc where id_tcc  = $id_tcc;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum Tcc com esse Id.</h2><br>
    
                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                $campos = mysqli_fetch_array($requisicao);

                                $id_tcc = $campos['id_tcc'];
                                    $titulo = $campos['titulo'];
                                    $ano = $campos['ano'];
                                    $resumo = $campos['resumo'];
                                    $id_orientador = $campos['id_orientador'];

                                echo"
                                <div id='formulario-escolha'>
                                    <h2 id='titulo-2'>Veja abaixo o resultado da pesquisa</h2><br>

                                    <p id='pesquisa'><span>Id do Tcc:</span> $id_tcc<br><br>
                                    <span>Titulo:</span> $titulo<br><br>
                                    <span>Ano:</span> $ano<br><br>
                                    <span>Resumo:</span> $resumo<br><br>
                                    <span>Id do orientador:</span> $id_orientador<br><br>                                   

                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                        
                        case 3:
                            $id_tcc = $_POST['id_tcc'];

                            $sql = "select * from tcc where id_tcc = $id_tcc;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum Tcc com esse Id.</h2><br>
    
                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else { 
                                $campos = mysqli_fetch_array($requisicao);

                                $id_tcc = $campos['id_tcc'];
                                $titulo = $campos['titulo'];
                                $ano = $campos['ano'];
                                $resumo = $campos['resumo'];
                                $id_orientador = $campos['id_orientador'];

                                echo"
                                <div style='padding-bottom: 30px;'>
                                    <form action='tcc2.php' method='POST' id='formulario-escolha'>
                                        <h2 id='titulo-2'>Altere as informações do Tcc</h2><br>

                                        <p style='color: #000000;'><strong>Id do Tcc:</strong> $id_tcc<p>

                                        <div class='div-form'>
                                            <label for='titulo'>Titulo:</label>
            
                                            <input type='text' name='titulo' id='titulo' value='$titulo'><br><br>
            
                                            <label for='ano'>Ano: </label>
            
                                            <input type='text' name='ano' id='ano' value='$ano'><br><br>
            
                                            <label for='resumo'>Resumo:</label>
            
                                            <input type='text' name='resumo' id='resumo' value='$resumo'><br><br>
            
                                            <label for='id_orientador'>id_orientador: </label>
            
                                            <input type='text' name='id_orientador' id='id_orientador' value='$id_orientador'><br><br>
            
                                        </div><br>
            
                                        <input type='hidden' name='operacao' value='3'>
        
                                        <input type='hidden' name='opcao' value='1'>

                                        <input type='hidden' name='id_tcc' value='$id_tcc'>

                                        <div>
                                            <button type='submit'>Alterar Tcc</button>
                                        </div>
                                    </form>
                                </div>
                                ";
                            }
                            break;

                        case 4:
                            $id_tcc = $_POST['id_tcc'];

                            $sql = "select * from tcc where id_tcc = $id_tcc;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum tcc com esse Id.</h2><br>
    
                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                $campos = mysqli_fetch_array($requisicao);

                                $id_tcc = $campos['id_tcc'];
                                $titulo = $campos['titulo'];
                                $ano = $campos['ano'];
                                $resumo = $campos['resumo'];
                                $id_orientador = $campos['id_orientador'];
                                echo"
                                <form action='tcc2.php' method='POST' id='formulario-escolha'>
                                    <h2 id='titulo-2'>Deseja realmente excluir este Tcc?</h2><br>

                                    <p id='pesquisa'><span>Id do Tcc:</span> $id_tcc<br><br>
                                    <span>Titulo:</span> $titulo<br><br>
                                    <span>Ano:</span> $ano<br><br>
                                    <span>Resumo:</span> $resumo<br><br>
                                    <span>Id do orientador:</span> $id_orientador<br><br>       
                                   

                                    <div>
                                        <input type='radio' name='excluir' id='excluirs' value='sim'><label for='excluirs'> Sim</label>

                                        <input type='radio' name='excluir' id='excluirn' value='nao'><label for='excluirn'> Não</label>
                                    </div><br>
                                    
                                    <input type='hidden' name='operacao' value='3'>
        
                                    <input type='hidden' name='opcao' value='2'>

                                    <input type='hidden' name='id_tcc' value='$id_tcc'>

                                    <button type='submit'>Excluir Tcc</button>
                                </form>
                                ";
                            }
                            break;
                        }
                }
                
                if ($operacao == 3) {
                    switch ($opcao) {
                        case 1:
                            $id_tcc = $_POST['id_tcc'];
                            $titulo = $_POST['titulo'];
                            $ano = $_POST['ano'];
                            $resumo = $_POST['resumo'];
                            $id_orientador = $_POST['id_orientador'];
    
                            $sql = "update tcc set titulo = '$titulo', ano = '$ano', resumo = '$resumo', id_orientador = '$id_orientador' where id_tcc = $id_tcc;";

                            $requisicao = mysqli_query($connect, $sql);

                            if ($requisicao == true) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Tcc alterado com sucesso!</h2><br>
    
                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Houve um erro na alteração do Tcc, tente novamente.</h2><br>
    
                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                        
                        case 2:
                            if (!isset($_POST['excluir'])) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Detectamos um erro.</h2><br>
    
                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";

                                exit(0);
                            }

                            if ($_POST['excluir'] == 'sim') {
                                $id_tcc = $_POST['id_tcc'];
                                
                                $sql = "delete from tcc where id_tcc = $id_tcc;";

                                $requisicao = mysqli_query($connect, $sql);

                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Tcc excluído com sucesso!</h2><br>
    
                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Operação cancelada!</h2><br>
    
                                    <a href='./tcc.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                    }
                }
            }
        ?>   
    </div>
</body>
</html>