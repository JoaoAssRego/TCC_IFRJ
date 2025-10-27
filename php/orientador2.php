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

            <a href="./orientador.php" id="botao-menu">Voltar para opções</a>
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
    
                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
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
                                    <form action='orientador2.php' method='POST' id='formulario-escolha'>
                                        <h2 id='titulo-2'>Insira as informações do orientador</h2><br>
            
                                        <div class='div-form'>
                                            <label for='id_orientador'>Id do orientador: </label>
                                        
                                            <input type='text' name='id_orientador' id='id_orientador'><br><br>
            
                                            <label for='nome'>Nome do orientador:</label>
            
                                            <input type='text' name='nome' id='nome' required><br><br>                                                    
            
                                            <label for='email'> email: (X meses)</label>
            
                                            <input type='text' name='email' id='email' required><br><br>
            
                                            <label for='telefone'>telefone: </label>
            
                                            <input type='text' name='telefone' id='telefone' required><br><br>
            
                                        </div><br>
            
                                        <input type='hidden' name='operacao' value='2'>
        
                                        <input type='hidden' name='opcao' value='1'>
        
            
                                        <div>
                                            <button type='submit'>Inserir Aluno</button>
            
                                            <button type='reset'>Limpar formulário</button>
                                        </div>
                                    </form>
                                </div>
                                ";
                                break;
                        
                        case 2:
                            echo"
                            <form action='orientador2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira o Id do orientador para efetuar a pesquisa</h2><br>
        
                                <div>
                                    <label for='id_orientador'>Id do orientador:</label>
                                            
                                    <input type='text' name='id_orientador' id='id_orientador'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='2'>
        
                                <div>
                                    <button type='submit'>Pesquisar orientador</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;
                        
                        case 3:
                            $sql = "select * from orientador;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum orientador cadastrado.</h2><br>
    
                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 id='titulo-2'>Veja abaixo todos os orientadores cadastrados</h2><br>

                                    <table id='tabela-mostrar'>
                                        <tr>
                                            <th>Id_orientador</th>
                                            <th>Nome</th>
                                            <th>email</th>
                                            <th>telefone</th>
                                        </tr>
                                ";

                                $campos = mysqli_fetch_array($requisicao);
                                
                                for ($i=0; $i < $campos; $i++) { 
                                    $id_orientador = $campos['id_orientador'];
                                    $nome = $campos['nome'];
                                    $email = $campos['email'];
                                    $telefone = $campos['telefone'];

                                    echo"
                                        <tr>
                                            <td>$id_orientador</td>
                                            <td>$nome</td>
                                            <td>$email</td>
                                            <td>$telefone</td>
                                        </tr>
                                    ";

                                    $campos = mysqli_fetch_assoc($requisicao);
                                }

                                echo"
                                    </table><br>
                                
                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a><br>
                                    <a href='./orientador_gerar_pdf.php'><button name='botao-retornar'>Gerar em Pdf</button></a>
                                    </div>
                                ";
                            }
                            break;

                        case 4:
                            echo"
                            <form action='orientador2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira o id do orientador que você deseja alterar</h2><br>
        
                                <div>
                                    <label for='id_orientador'>Id do orientador:</label>
                                            
                                    <input type='text' name='id_orientador' id='id_orientador'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='3'>
        
                                <div>
                                    <button type='submit'>Alterar orientador</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;

                        case 5:
                            echo"
                            <form action='orientador2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira o Id do Orientador que você deseja excluir</h2><br>
        
                                <div>
                                    <label for='id_orientador'>Id do orientador:</label>
                                            
                                    <input type='text' name='id_orientador' id='id_orientador'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='4'>
        
                                <div>
                                    <button type='submit'>Excluir orientador</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;
                    } 
                }     
                
                if ($operacao == 2) {
                    switch ($opcao) {
                        case 1:
                            $id_orientador = $_POST['id_orientador'];
                            $nome = $_POST['nome'];
                            $email = $_POST['email'];
                            $telefone = $_POST['telefone'];
    
                            $sql = "insert into orientador values ('$id_orientador', '$nome', '$email', '$telefone');";  
    
                            $requisicao = mysqli_query($connect, $sql);
    
                            if ($requisicao == true) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Orientador criado com sucesso!</h2><br>
    
                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Houve um erro na criação do orientador, tente novamente.</h2><br>
    
                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;

                        case 2:
                            $id_orientador = $_POST['id_orientador'];

                            $sql = "select * from orientador where id_orientador  = $id_orientador;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum orientador com esse código.</h2><br>
    
                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                $campos = mysqli_fetch_array($requisicao);

                                $id_orientador = $campos['id_orientador'];
                                    $nome = $campos['nome'];
                                    $email = $campos['email'];
                                    $telefone = $campos['telefone'];

                                echo"
                                <div id='formulario-escolha'>
                                    <h2 id='titulo-2'>Veja abaixo o resultado da pesquisa</h2><br>

                                    <p id='pesquisa'><span>Id do orientador:</span> $id_orientador<br><br>
                                    <span>Nome do Aluno:</span> $nome<br><br>
                                    <span>Email:</span> $email<br><br>
                                    <span>Telefone:</span> $telefone<br><br>
                                    

                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                        
                        case 3:
                            $id_orientador = $_POST['id_orientador'];

                            $sql = "select * from orientador where id_orientador = $id_orientador;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum orientador com esse ID.</h2><br>
    
                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else { 
                                $campos = mysqli_fetch_array($requisicao);

                                $id_orientador = $campos['id_orientador'];
                                $nome = $campos['nome'];
                                $email = $campos['email'];
                                $telefone = $campos['telefone'];

                                echo"
                                <div style='padding-bottom: 30px;'>
                                    <form action='orientador2.php' method='POST' id='formulario-escolha'>
                                        <h2 id='titulo-2'>Altere as informações do orientador</h2><br>

                                        <p style='color: #000000;'><strong>Id do orientador:</strong> $id_orientador<p>

                                        <div class='div-form'>
                                            <label for='nome'>Nome do orientador:</label>
            
                                            <input type='text' name='nome' id='nome' value='$nome'><br><br>                                                    
            
                                            <label for='email'>email:</label>
            
                                            <input type='text' name='email' id='email' value='$email'><br><br>
            
                                            <label for='telefone'>telefone: </label>
            
                                            <input type='text' name='telefone' id='telefone' value='$telefone'><br><br>
            
                                        </div><br>
            
                                        <input type='hidden' name='operacao' value='3'>
        
                                        <input type='hidden' name='opcao' value='1'>

                                        <input type='hidden' name='id_orientador' value='$id_orientador'>

                                        <div>
                                            <button type='submit'>Alterar orientador</button>
                                        </div>
                                    </form>
                                </div>
                                ";
                            }
                            break;

                        case 4:
                            $id_orientador = $_POST['id_orientador'];

                            $sql = "select * from orientador where id_orientador = $id_orientador;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum orientador com esse Id.</h2><br>
    
                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                $campos = mysqli_fetch_array($requisicao);

                                $id_orientador = $campos['id_orientador'];
                                $nome = $campos['nome'];
                                $email = $campos['email'];
                                $telefone = $campos['telefone'];

                                echo"
                                <form action='orientador2.php' method='POST' id='formulario-escolha'>
                                    <h2 id='titulo-2'>Deseja realmente excluir este orientador?</h2><br>

                                    <p id='pesquisa'><span>Id do orientador:</span> $id_orientador<br><br>
                                    <span>Nome do orientador:</span> $nome<br><br>
                                    <span>Email:</span> $email<br><br>
                                    <span>Telefone:</span> $telefone<br><br>
                                   

                                    <div>
                                        <input type='radio' name='excluir' id='excluirs' value='sim'><label for='excluirs'> Sim</label>

                                        <input type='radio' name='excluir' id='excluirn' value='nao'><label for='excluirn'> Não</label>
                                    </div><br>
                                    
                                    <input type='hidden' name='operacao' value='3'>
        
                                    <input type='hidden' name='opcao' value='2'>

                                    <input type='hidden' name='id_orientador' value='$id_orientador'>

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
                            $id_orientador = $_POST['id_orientador'];
                            $nome = $_POST['nome'];
                            $email = $_POST['email'];
                            $telefone = $_POST['telefone'];
    
                            $sql = "update orientador set nome = '$nome', email = '$email', telefone = '$telefone' where id_orientador = $id_orientador;";

                            $requisicao = mysqli_query($connect, $sql);

                            if ($requisicao == true) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Orientador alterado com sucesso!</h2><br>
    
                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Houve um erro na alteração do orientador, tente novamente.</h2><br>
    
                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                        
                        case 2:
                            if (!isset($_POST['excluir'])) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Detectamos um erro.</h2><br>
    
                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";

                                exit(0);
                            }

                            if ($_POST['excluir'] == 'sim') {
                                $id_orientador = $_POST['id_orientador'];
                                
                                $sql = "delete from orientador where id_orientador = $id_orientador;";

                                $requisicao = mysqli_query($connect, $sql);

                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Orientador excluído com sucesso!</h2><br>
    
                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Operação cancelada!</h2><br>
    
                                    <a href='./orientador.php'><button name='botao-retornar'>Retornar</button></a>
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