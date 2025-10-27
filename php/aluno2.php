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

            <a href="./aluno.php" id="botao-menu">Voltar para opções</a>
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
    
                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
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
                                    <form action='aluno2.php' method='POST' id='formulario-escolha'>
                                        <h2 id='titulo-2'>Insira as informações do aluno</h2><br>
            
                                        <div class='div-form'>
                                            <label for='matricula'>Matrícula aluno: (Apenas números inteiros)</label>
                                        
                                            <input type='text' name='matricula' id='matricula' required maxlength='11'><br><br>
            
                                            <label for='nome'>Nome do curso:</label>
            
                                            <input type='text' name='nome' id='nome' required><br><br>
            
                                            <label for='curso'> curso: (xxxx-xx-xx)</label>
            
                                            <input type='text' name='curso' id='curso' ><br><br>
            
                                            <label for='email'> email: (X meses)</label>
            
                                            <input type='text' name='email' id='email' required><br><br>
            
                                            <label for='telefone'>telefone: </label>
            
                                            <input type='text' name='telefone' id='telefone' required><br><br>
            
                                            <label for='id_tcc'> id do tcc</label>
            
                                            <input type='text' name='id_tcc' id='id_tcc' required>
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
                            <form action='aluno2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira a matrícula do aluno para efetuar a pesquisa</h2><br>
        
                                <div>
                                    <label for='matricula'>Matrícula aluno:</label>
                                            
                                    <input type='text' name='matricula' id='matricula' required maxlength='11'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='2'>
        
                                <div>
                                    <button type='submit'>Pesquisar aluno</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;
                        
                        case 3:
                            $sql = "select * from aluno;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum aluno cadastrado.</h2><br>
    
                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 id='titulo-2'>Veja abaixo todos os cursos cadastrados</h2><br>

                                    <table id='tabela-mostrar'>
                                        <tr>
                                            <th>Matrícula</th>
                                            <th>Nome</th>
                                            <th>curso</th>
                                            <th>email</th>
                                            <th>telefone</th>
                                            <th>id_tcc</th>
                                        </tr>
                                ";

                                $campos = mysqli_fetch_array($requisicao);
                                
                                for ($i=0; $i < $campos; $i++) { 
                                    $matricula = $campos['matricula'];
                                    $nome = $campos['nome'];
                                    $curso = $campos['curso'];
                                    $email = $campos['email'];
                                    $telefone = $campos['telefone'];
                                    $id_tcc = $campos['id_tcc'];


                                    echo"
                                        <tr>
                                            <td>$matricula</td>
                                            <td>$nome</td>
                                            <td>$curso</td>
                                            <td>$email</td>
                                            <td>$telefone</td>
                                            <td>$id_tcc</td>
                                        </tr>
                                    ";

                                    $campos = mysqli_fetch_assoc($requisicao);
                                }

                                echo"
                                    </table><br>
                                
                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a><br>
                                <a href='./aluno_gerar_pdf.php'><button name='botao-retornar'>Gerar em Pdf</button></a>
                                </div>
                                ";
                             
                              
                            }
                            break;

                        case 4:
                            echo"
                            <form action='aluno2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira a matrícula do aluno que você deseja alterar</h2><br>
        
                                <div>
                                    <label for='matricula'>Matrícula aluno:</label>
                                            
                                    <input type='text' name='matricula' id='matricula' required maxlength='11'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='3'>
        
                                <div>
                                    <button type='submit'>Alterar aluno</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;

                        case 5:
                            echo"
                            <form action='aluno2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira a matrícula do aluno que você deseja excluir</h2><br>
        
                                <div>
                                    <label for='matricula'>Matrícula aluno:</label>
                                            
                                    <input type='text' name='matricula' id='matricula' required maxlength='11'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='4'>
        
                                <div>
                                    <button type='submit'>Excluir aluno</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;
                    } 
                }     
                
                if ($operacao == 2) {
                    switch ($opcao) {
                        case 1:
                            $matricula = $_POST['matricula'];
                            $nome = $_POST['nome'];
                            $curso = $_POST['curso'];
                            $email = $_POST['email'];
                            $telefone = $_POST['telefone'];
                            $id_tcc = $_POST['id_tcc'];
    
                            $sql = "insert into aluno values ('$matricula', '$nome', '$curso', '$email', '$telefone', '$id_tcc');";  
    
                            $requisicao = mysqli_query($connect, $sql);
    
                            if ($requisicao == true) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Aluno criado com sucesso!</h2><br>
    
                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Houve um erro na criação do aluno, tente novamente.</h2><br>
    
                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;

                        case 2:
                            $matricula = $_POST['matricula'];

                            $sql = "select * from aluno where matricula  = $matricula;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum aluno com esse código.</h2><br>
    
                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                $campos = mysqli_fetch_array($requisicao);

                                $matricula = $campos['matricula'];
                                    $nome = $campos['nome'];
                                    $curso = $campos['curso'];
                                    $email = $campos['email'];
                                    $telefone = $campos['telefone'];
                                    $id_tcc = $campos['id_tcc'];

                                echo"
                                <div id='formulario-escolha'>
                                    <h2 id='titulo-2'>Veja abaixo o resultado da pesquisa</h2><br>

                                    <p id='pesquisa'><span>Matrícula do Aluno:</span> $matricula<br><br>
                                    <span>Nome do Aluno:</span> $nome<br><br>
                                    <span>Curso:</span> $curso<br><br>
                                    <span>Email:</span> $email<br><br>
                                    <span>Telefone:</span> $telefone<br><br>
                                    <span>id_tcc:</span> $id_tcc<br><br>
                                    

                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                        
                        case 3:
                            $matricula = $_POST['matricula'];

                            $sql = "select * from aluno where matricula = $matricula;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum aluno com essa matrícula.</h2><br>
    
                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else { 
                                $campos = mysqli_fetch_array($requisicao);

                                $matricula = $campos['matricula'];
                                $nome = $campos['nome'];
                                $curso = $campos['curso'];
                                $email = $campos['email'];
                                $telefone = $campos['telefone'];
                                $id_tcc = $campos['id_tcc'];

                                echo"
                                <div style='padding-bottom: 30px;'>
                                    <form action='aluno2.php' method='POST' id='formulario-escolha'>
                                        <h2 id='titulo-2'>Altere as informações do aluno</h2><br>

                                        <p style='color: #000000;'><strong>Matrícula do aluno:</strong> $matricula<p>

                                        <div class='div-form'>
                                            <label for='nome'>Nome do aluno:</label>
            
                                            <input type='text' name='nome' id='nome' value='$nome'><br><br>
            
                                            <label for='curso'>curso: </label>
            
                                            <input type='text' name='curso' id='curso' value='$curso'><br><br>
            
                                            <label for='email'>email:</label>
            
                                            <input type='text' name='email' id='email' value='$email'><br><br>
            
                                            <label for='telefone'>telefone: </label>
            
                                            <input type='text' name='telefone' id='telefone' value='$telefone'><br><br>
            
                                            <label for='id_tcc'>id do tcc:</label>
            
                                            <input type='text' name='id_tcc' id='id_tcc' value='$id_tcc'>
                                        </div><br>
            
                                        <input type='hidden' name='operacao' value='3'>
        
                                        <input type='hidden' name='opcao' value='1'>

                                        <input type='hidden' name='matricula' value='$matricula'>

                                        <div>
                                            <button type='submit'>Alterar Aluno</button>
                                        </div>
                                    </form>
                                </div>
                                ";
                            }
                            break;

                        case 4:
                            $matricula = $_POST['matricula'];

                            $sql = "select * from aluno where matricula = $matricula;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum aluno com essa matrícula.</h2><br>
    
                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                $campos = mysqli_fetch_array($requisicao);

                                $matricula = $campos['matricula'];
                                $nome = $campos['nome'];
                                $curso = $campos['curso'];
                                $email = $campos['email'];
                                $telefone = $campos['telefone'];
                                $id_tcc = $campos['id_tcc'];

                                echo"
                                <form action='aluno2.php' method='POST' id='formulario-escolha'>
                                    <h2 id='titulo-2'>Deseja realmente excluir este aluno?</h2><br>

                                    <p id='pesquisa'><span>Matrícula do aluno:</span> $matricula<br><br>
                                    <span>Nome do aluno:</span> $nome<br><br>
                                    <span>Curso:</span> $curso<br><br>
                                    <span>Email:</span> $email<br><br>
                                    <span>Telefone:</span> $telefone<br><br>
                                    <span>Id_TCC:</span> $id_tcc<br><br>
                                   

                                    <div>
                                        <input type='radio' name='excluir' id='excluirs' value='sim'><label for='excluirs'> Sim</label>

                                        <input type='radio' name='excluir' id='excluirn' value='nao'><label for='excluirn'> Não</label>
                                    </div><br>
                                    
                                    <input type='hidden' name='operacao' value='3'>
        
                                    <input type='hidden' name='opcao' value='2'>

                                    <input type='hidden' name='matricula' value='$matricula'>

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
                            $matricula = $_POST['matricula'];
                            $nome = $_POST['nome'];
                            $curso = $_POST['curso'];
                            $email = $_POST['email'];
                            $telefone = $_POST['telefone'];
                            $id_tcc = $_POST['id_tcc'];
    
                            $sql = "update aluno set nome = '$nome', curso = '$curso', email = '$email', telefone = '$telefone', id_tcc = '$id_tcc' where matricula = $matricula;";

                            $requisicao = mysqli_query($connect, $sql);

                            if ($requisicao == true) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Aluno alterado com sucesso!</h2><br>
    
                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Houve um erro na alteração do aluno, tente novamente.</h2><br>
    
                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                        
                        case 2:
                            if (!isset($_POST['excluir'])) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Detectamos um erro.</h2><br>
    
                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";

                                exit(0);
                            }

                            if ($_POST['excluir'] == 'sim') {
                                $matricula = $_POST['matricula'];
                                
                                $sql = "delete from aluno where matricula = $matricula;";

                                $requisicao = mysqli_query($connect, $sql);

                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Aluno excluído com sucesso!</h2><br>
    
                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Operação cancelada!</h2><br>
    
                                    <a href='./aluno.php'><button name='botao-retornar'>Retornar</button></a>
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