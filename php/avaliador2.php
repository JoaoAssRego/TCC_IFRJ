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

            <a href="./avaliador.php" id="botao-menu">Voltar para opções</a>
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
    
                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
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
                                    <form action='avaliador2.php' method='POST' id='formulario-escolha'>
                                        <h2 id='titulo-2'>Insira as informações do avaliador</h2><br>
            
                                        <div class='div-form'>
                                            <label for='id_avaliador'>Id do Avaliador: (Apenas números inteiros)</label>
                                        
                                            <input type='text' name='id_avaliador' id='id_avaliador' ><br><br>
            
                                            <label for='nome'>Nome:</label>
            
                                            <input type='text' name='nome' id='nome' required><br><br>
            
                                            <label for='email'> Email: (xxxx-xx-xx)</label>
            
                                            <input type='text' name='email' id='email' ><br><br>
            
                                            <label for='telefone'> Telefone: (X meses)</label>
            
                                            <input type='text' name='telefone' id='telefone' required><br><br>
            
                                            <label for='funcao'>Função: </label>
            
                                            <input type='text' name='funcao' id='funcao' required><br><br>
            
                                            <label for='instituicao'> Instituição do Avaliador</label>
            
                                            <input type='text' name='instituicao' id='instituicao' required>
                                        </div><br>
            
                                        <input type='hidden' name='operacao' value='2'>
        
                                        <input type='hidden' name='opcao' value='1'>
        
            
                                        <div>
                                            <button type='submit'>Inserir Avaliador</button>
            
                                            <button type='reset'>Limpar formulário</button>
                                        </div>
                                    </form>
                                </div>
                                ";
                                break;
                        
                        case 2:
                            echo"
                            <form action='avaliador2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira o Id do Avaliador para efetuar a pesquisa</h2><br>
        
                                <div>
                                    <label for='id_avaliador'>Id do Avaliador:</label>
                                            
                                    <input type='text' name='id_avaliador' id='id_avaliador' >
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='2'>
        
                                <div>
                                    <button type='submit'>Pesquisar Avaliador</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;
                        
                        case 3:
                            $sql = "select * from avaliador;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum avaliador cadastrado.</h2><br>
    
                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 id='titulo-2'>Veja abaixo todos os avaliadores cadastrados</h2><br>

                                    <table id='tabela-mostrar'>
                                        <tr>
                                            <th>id_avaliador</th>
                                            <th>nome</th>
                                            <th>email</th>
                                            <th>telefone</th>
                                            <th>funcao</th>
                                            <th>instituicao</th>
                                        </tr>
                                ";

                                $campos = mysqli_fetch_array($requisicao);
                                
                                for ($i=0; $i < $campos; $i++) { 
                                    $id_avaliador = $campos['id_avaliador'];
                                    $nome = $campos['nome'];
                                    $email = $campos['email'];
                                    $telefone = $campos['telefone'];
                                    $funcao = $campos['funcao'];
                                    $instituicao = $campos['instituicao'];


                                    echo"
                                        <tr>
                                            <td>$id_avaliador</td>
                                            <td>$nome</td>
                                            <td>$email</td>
                                            <td>$telefone</td>
                                            <td>$funcao</td>
                                            <td>$instituicao</td>
                                        </tr>
                                    ";

                                    $campos = mysqli_fetch_assoc($requisicao);
                                }

                                echo"
                                    </table><br>
                                
                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a><br>
                                    <a href='./avaliador_gerar_pdf.php'><button name='botao-retornar'>Gerar em Pdf</button></a>
                                    </div>
                                ";
                            }
                            break;

                        case 4:
                            echo"
                            <form action='avaliador2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira o Id do Avaliador que você deseja alterar</h2><br>
        
                                <div>
                                    <label for='id_avaliador'>Id do Avaliador:</label>
                                            
                                    <input type='text' name='id_avaliador' id='id_avaliador' >
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='3'>
        
                                <div>
                                    <button type='submit'>Alterar avaliador</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;

                        case 5:
                            echo"
                            <form action='avaliador2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira o Id do Avaliador que você deseja excluir</h2><br>
        
                                <div>
                                    <label for='id_avaliador'>Id do avaliador:</label>
                                            
                                    <input type='text' name='id_avaliador' id='id_avaliador' >
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='4'>
        
                                <div>
                                    <button type='submit'>Excluir avaliador</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;
                    } 
                }     
                
                if ($operacao == 2) {
                    switch ($opcao) {
                        case 1:
                            $id_avaliador = $_POST['id_avaliador'];
                            $nome = $_POST['nome'];
                            $email = $_POST['email'];
                            $telefone = $_POST['telefone'];
                            $funcao = $_POST['funcao'];
                            $instituicao = $_POST['instituicao'];
    
                            $sql = "insert into avaliador values ('$id_avaliador', '$nome', '$email', '$telefone', '$funcao', '$instituicao');";  
    
                            $requisicao = mysqli_query($connect, $sql);
    
                            if ($requisicao == true) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Avaliador criado com sucesso!</h2><br>
    
                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Houve um erro na criação do avaliador, tente novamente.</h2><br>
    
                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;

                        case 2:
                            $id_avaliador = $_POST['id_avaliador'];

                            $sql = "select * from avaliador where id_avaliador  = $id_avaliador;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum avaliador com esse código.</h2><br>
    
                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                $campos = mysqli_fetch_array($requisicao);

                                $id_avaliador = $campos['id_avaliador'];
                                $nome = $campos['nome'];
                                $email = $campos['email'];
                                $telefone = $campos['telefone'];
                                $funcao = $campos['funcao'];
                                $instituicao = $campos['instituicao'];

                                echo"
                                <div id='formulario-escolha'>
                                    <h2 id='titulo-2'>Veja abaixo o resultado da pesquisa</h2><br>

                                    <p id='pesquisa'><span>Id do avaliador:</span> $id_avaliador<br><br>
                                    <span>Nome do Avaliador:</span> $nome<br><br>
                                    <span>Email:</span> $email<br><br>
                                    <span>Telefone:</span> $telefone<br><br>
                                    <span>Função:</span> $funcao<br><br>
                                    <span>Instituição:</span> $instituicao<br><br>
                                    

                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                        
                        case 3:
                            $id_avaliador = $_POST['id_avaliador'];

                            $sql = "select * from avaliador where id_avaliador = $id_avaliador;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum aluno com essa matrícula.</h2><br>
    
                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else { 
                                $campos = mysqli_fetch_array($requisicao);

                                $id_avaliador = $campos['id_avaliador'];
                                $nome = $campos['nome'];
                                $email = $campos['email'];
                                $telefone = $campos['telefone'];
                                $funcao = $campos['funcao'];
                                $instituicao = $campos['instituicao'];

                                echo"
                                <div style='padding-bottom: 30px;'>
                                    <form action='avaliador2.php' method='POST' id='formulario-escolha'>
                                        <h2 id='titulo-2'>Altere as informações do avaliador</h2><br>

                                        <p style='color: #000000;'><strong>Id do Avaliador:</strong> $id_avaliador<p>

                                        <div class='div-form'>
                                            <label for='nome_avaliador'>Nome do avaliador</label>
            
                                            <input type='text' name='nome' id='nome_avaliador' value='$nome'><br><br>
            
                                            <label for='email'>email: </label>
            
                                            <input type='text' name='email' id='email_avaliador' value='$email'><br><br>
            
                                            <label for='telefone'>telefone:</label>
            
                                            <input type='text' name='telefone' id='telefone_avaliador' value='$telefone'><br><br>
            
                                            <label for='funcao'>Função </label>
            
                                            <input type='text' name='funcao' id='funcao' value='$funcao'><br><br>
            
                                            <label for='instituicao'>Instituição:</label>
            
                                            <input type='text' name='instituicao' id='instituicao' value='$instituicao'>
                                        </div><br>
            
                                        <input type='hidden' name='operacao' value='3'>
        
                                        <input type='hidden' name='opcao' value='1'>

                                        <input type='hidden' name='id_avaliador' value='$id_avaliador'>

                                        <div>
                                            <button type='submit'>Alterar Avaliador</button>
                                        </div>
                                    </form>
                                </div>
                                ";
                            }
                            break;

                        case 4:
                            $id_avaliador = $_POST['id_avaliador'];

                            $sql = "select * from avaliador where id_avaliador = $id_avaliador;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum avaliador com esse Id.</h2><br>
    
                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                $campos = mysqli_fetch_array($requisicao);

                                $id_avaliador = $campos['id_avaliador'];
                                $nome = $campos['nome'];
                                $email = $campos['email'];
                                $telefone = $campos['telefone'];
                                $funcao = $campos['funcao'];
                                $instituicao = $campos['instituicao'];

                                echo"
                                <form action='avaliador2.php' method='POST' id='formulario-escolha'>
                                    <h2 id='titulo-2'>Deseja realmente excluir este avaliador?</h2><br>

                                    <p id='pesquisa'><span>Id do Avaliador:</span> $id_avaliador<br><br>
                                    <span>Nome do Avaliador:</span> $nome<br><br>
                                    <span>Email:</span> $email<br><br>
                                    <span>Telefone:</span> $telefone<br><br>
                                    <span>Função:</span> $funcao<br><br>
                                    <span>Instituição:</span> $instituicao<br><br>
                                   

                                    <div>
                                        <input type='radio' name='excluir' id='excluirs' value='sim'><label for='excluirs'> Sim</label>

                                        <input type='radio' name='excluir' id='excluirn' value='nao'><label for='excluirn'> Não</label>
                                    </div><br>
                                    
                                    <input type='hidden' name='operacao' value='3'>
        
                                    <input type='hidden' name='opcao' value='2'>

                                    <input type='hidden' name='id_avaliador' value='$id_avaliador'>

                                    <button type='submit'>Excluir curso</button>
                                </form>
                                ";
                            }
                            break;
                        }
                }
                
                if ($operacao == 3) {
                    switch ($opcao) {
                        case 1:
                            $id_avaliador = $_POST['id_avaliador'];
                            $nome = $_POST['nome'];
                            $email = $_POST['email'];
                            $telefone = $_POST['telefone'];
                            $funcao = $_POST['funcao'];
                            $instituicao = $_POST['instituicao'];
    
                            $sql = "update avaliador set nome = '$nome', email = '$email', telefone = '$telefone', funcao = '$funcao', instituicao = '$instituicao' where id_avaliador = $id_avaliador;";

                            $requisicao = mysqli_query($connect, $sql);

                            if ($requisicao == true) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Avaliador alterado com sucesso!</h2><br>
    
                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Houve um erro na alteração do avaliador, tente novamente.</h2><br>
    
                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                        
                        case 2:
                            if (!isset($_POST['excluir'])) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Detectamos um erro.</h2><br>
    
                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";

                                exit(0);
                            }

                            if ($_POST['excluir'] == 'sim') {
                                $id_avaliador = $_POST['id_avaliador'];
                                
                                $sql = "delete from avaliador where id_avaliador = $id_avaliador;";

                                $requisicao = mysqli_query($connect, $sql);

                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Avaliador excluído com sucesso!</h2><br>
    
                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Operação cancelada!</h2><br>
    
                                    <a href='./avaliador.php'><button name='botao-retornar'>Retornar</button></a>
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