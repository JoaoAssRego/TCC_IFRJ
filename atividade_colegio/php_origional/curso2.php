<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="https://portal.ifrj.edu.br/sites/all/themes/ifrj/favicon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" type="text/css" href="../style.css">

    <title>Sistema - Cursos | IFRJ</title>
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

            <a href="./curso.php" id="botao-menu">Voltar para opções</a>
        </div>
    </div>

    <div id="container-2">
        <?php
            $connect = mysqli_connect('127.0.0.1', 'root', '', 'colegio');

            if (!isset($_POST['opcao'])) {
                echo"
                <div id='formulario-escolha'>
                    <h2 class='msg-erro'>Retorne e selecione uma opção!</h2><br>
    
                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
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
                                    <form action='curso2.php' method='POST' id='formulario-escolha'>
                                        <h2 id='titulo-2'>Insira as informações do curso</h2><br>
            
                                        <div class='div-form'>
                                            <label for='numero_curso'>Matrícula curso: (Apenas números inteiros)</label>
                                        
                                            <input type='text' name='numero_curso' id='numero_curso' required maxlength='11'><br><br>
            
                                            <label for='nome_curso'>Nome do curso:</label>
            
                                            <input type='text' name='nome_curso' id='nome_curso' required><br><br>
            
                                            <label for='data_curso'>Data de criação do curso: (xxxx-xx-xx)</label>
            
                                            <input type='text' name='data_curso' id='data_curso' required maxlength='10'><br><br>
            
                                            <label for='duracao_curso'>Duração do curso: (X meses)</label>
            
                                            <input type='text' name='duracao_curso' id='duracao_curso' required><br><br>
            
                                            <label for='carga_horaria_curso'>Carga horária do curso: (X horas)</label>
            
                                            <input type='text' name='carga_horaria_curso' id='carga_horaria_curso' required><br><br>
            
                                            <label for='coordenador_curso'>Coordenador(a) do curso:</label>
            
                                            <input type='text' name='coordenador_curso' id='coordenador_curso' required>
                                        </div><br>
            
                                        <input type='hidden' name='operacao' value='2'>
        
                                        <input type='hidden' name='opcao' value='1'>
        
                                        <div class='div-form'>
                                            <label for='descricao_curso'>Descreva o curso:</label>
            
                                            <textarea name='descricao_curso' cols='30' rows='10' required></textarea>
                                        </div><br>
            
                                        <div>
                                            <button type='submit'>Criar curso</button>
            
                                            <button type='reset'>Limpar formulário</button>
                                        </div>
                                    </form>
                                </div>
                                ";
                                break;
                        
                        case 2:
                            echo"
                            <form action='curso2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira a matrícula do curso para efetuar a pesquisa</h2><br>
        
                                <div>
                                    <label for='numero_curso'>Matrícula curso:</label>
                                            
                                    <input type='text' name='numero_curso' id='numero_curso' required maxlength='11'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='2'>
        
                                <div>
                                    <button type='submit'>Pesquisar curso</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;
                        
                        case 3:
                            $sql = "select * from curso;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum curso cadastrado.</h2><br>
    
                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
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
                                            <th>Data de criação</th>
                                            <th>Duração</th>
                                            <th>Carga horária</th>
                                            <th>Coordenador</th>
                                            <th>Descrição</th>
                                        </tr>
                                ";

                                $campos = mysqli_fetch_array($requisicao);
                                
                                for ($i=0; $i < $campos; $i++) { 
                                    $codigo_curso = $campos['id_curso'];
                                    $nome_curso = $campos['nome_curso'];
                                    $data_curso = $campos['data_criacao_curso'];
                                    $duracao_curso = $campos['duracao_curso'];
                                    $carga_horaria_curso = $campos['carga_horaria_curso'];
                                    $coordenador_curso = $campos['coordenador_curso'];
                                    $descricao_curso = $campos['descricao_curso'];

                                    echo"
                                        <tr>
                                            <td>$codigo_curso</td>
                                            <td>$nome_curso</td>
                                            <td>$data_curso</td>
                                            <td>$duracao_curso</td>
                                            <td>$carga_horaria_curso</td>
                                            <td>$coordenador_curso</td>
                                            <td>$descricao_curso</td>
                                        </tr>
                                    ";

                                    $campos = mysqli_fetch_assoc($requisicao);
                                }

                                echo"
                                    </table><br>
                                
                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;

                        case 4:
                            echo"
                            <form action='curso2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira a matrícula do curso que você deseja alterar</h2><br>
        
                                <div>
                                    <label for='numero_curso'>Matrícula curso:</label>
                                            
                                    <input type='text' name='numero_curso' id='numero_curso' required maxlength='11'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='3'>
        
                                <div>
                                    <button type='submit'>Alterar curso</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;

                        case 5:
                            echo"
                            <form action='curso2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira a matrícula do curso que você deseja excluir</h2><br>
        
                                <div>
                                    <label for='numero_curso'>Matrícula curso:</label>
                                            
                                    <input type='text' name='numero_curso' id='numero_curso' required maxlength='11'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='4'>
        
                                <div>
                                    <button type='submit'>Excluir curso</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;
                    } 
                }     
                
                if ($operacao == 2) {
                    switch ($opcao) {
                        case 1:
                            $codigo_curso = $_POST['numero_curso'];
                            $nome_curso = $_POST['nome_curso'];
                            $data_curso = $_POST['data_curso'];
                            $duracao_curso = $_POST['duracao_curso'];
                            $carga_horaria_curso = $_POST['carga_horaria_curso'];
                            $coordenador_curso = $_POST['coordenador_curso'];
                            $descricao_curso = $_POST['descricao_curso'];
    
                            $sql = "insert into curso values ('$codigo_curso', '$nome_curso', '$data_curso', '$descricao_curso', '$duracao_curso', '$carga_horaria_curso', '$coordenador_curso');";  
    
                            $requisicao = mysqli_query($connect, $sql);
    
                            if ($requisicao == true) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Curso criado com sucesso!</h2><br>
    
                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Houve um erro na criação do curso, tente novamente.</h2><br>
    
                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;

                        case 2:
                            $codigo_curso = $_POST['numero_curso'];

                            $sql = "select * from curso where id_curso = $codigo_curso;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum curso com esse código.</h2><br>
    
                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                $campos = mysqli_fetch_array($requisicao);

                                $codigo_curso = $campos['id_curso'];
                                $nome_curso = $campos['nome_curso'];
                                $data_curso = $campos['data_criacao_curso'];
                                $duracao_curso = $campos['duracao_curso'];
                                $carga_horaria_curso = $campos['carga_horaria_curso'];
                                $coordenador_curso = $campos['coordenador_curso'];
                                $descricao_curso = $campos['descricao_curso'];

                                echo"
                                <div id='formulario-escolha'>
                                    <h2 id='titulo-2'>Veja abaixo o resultado da pesquisa</h2><br>

                                    <p id='pesquisa'><span>Matrícula do curso:</span> $codigo_curso<br><br>
                                    <span>Nome do curso:</span> $nome_curso<br><br>
                                    <span>Data de criação do curso:</span> $data_curso<br><br>
                                    <span>Duração do curso:</span> $duracao_curso<br><br>
                                    <span>Carga horária do curso:</span> $carga_horaria_curso<br><br>
                                    <span>Coordenador do curso:</span> $coordenador_curso<br><br>
                                    <span>Descrição do curso:</span> $descricao_curso</p><br><br>

                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                        
                        case 3:
                            $codigo_curso = $_POST['numero_curso'];

                            $sql = "select * from curso where id_curso = $codigo_curso;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum curso com essa matrícula.</h2><br>
    
                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else { 
                                $campos = mysqli_fetch_array($requisicao);

                                $codigo_curso = $campos['id_curso'];
                                $nome_curso = $campos['nome_curso'];
                                $data_curso = $campos['data_criacao_curso'];
                                $duracao_curso = $campos['duracao_curso'];
                                $carga_horaria_curso = $campos['carga_horaria_curso'];
                                $coordenador_curso = $campos['coordenador_curso'];
                                $descricao_curso = $campos['descricao_curso'];

                                echo"
                                <div style='padding-bottom: 30px;'>
                                    <form action='curso2.php' method='POST' id='formulario-escolha'>
                                        <h2 id='titulo-2'>Altere as informações do curso</h2><br>

                                        <p style='color: #000000;'><strong>Matrícula do curso:</strong> $codigo_curso<p>

                                        <div class='div-form'>
                                            <label for='nome_curso'>Nome do curso:</label>
            
                                            <input type='text' name='nome_curso' id='nome_curso' value='$nome_curso'><br><br>
            
                                            <label for='data_curso'>Data de criação do curso: (xxxx-xx-xx)</label>
            
                                            <input type='text' name='data_curso' id='data_curso' maxlength='10' value='$data_curso'><br><br>
            
                                            <label for='duracao_curso'>Duração do curso: (X meses)</label>
            
                                            <input type='text' name='duracao_curso' id='duracao_curso' value='$duracao_curso'><br><br>
            
                                            <label for='carga_horaria_curso'>Carga horária do curso: (X horas)</label>
            
                                            <input type='text' name='carga_horaria_curso' id='carga_horaria_curso' value='$carga_horaria_curso'><br><br>
            
                                            <label for='coordenador_curso'>Coordenador(a) do curso:</label>
            
                                            <input type='text' name='coordenador_curso' id='coordenador_curso' value='$coordenador_curso'>
                                        </div><br>
            
                                        <input type='hidden' name='operacao' value='3'>
        
                                        <input type='hidden' name='opcao' value='1'>

                                        <input type='hidden' name='codigo_curso' value='$codigo_curso'>

                                        <div class='div-form'>
                                            <label for='descricao_curso'>Descreva o curso:</label>
            
                                            <textarea name='descricao_curso' cols='30' rows='10'>$descricao_curso</textarea>
                                        </div><br>

                                        <div>
                                            <button type='submit'>Alterar curso</button>
                                        </div>
                                    </form>
                                </div>
                                ";
                            }
                            break;

                        case 4:
                            $codigo_curso = $_POST['numero_curso'];

                            $sql = "select * from curso where id_curso = $codigo_curso;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhum curso com essa matrícula.</h2><br>
    
                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                $campos = mysqli_fetch_array($requisicao);

                                $codigo_curso = $campos['id_curso'];
                                $nome_curso = $campos['nome_curso'];
                                $data_curso = $campos['data_criacao_curso'];
                                $duracao_curso = $campos['duracao_curso'];
                                $carga_horaria_curso = $campos['carga_horaria_curso'];
                                $coordenador_curso = $campos['coordenador_curso'];
                                $descricao_curso = $campos['descricao_curso'];

                                echo"
                                <form action='curso2.php' method='POST' id='formulario-escolha'>
                                    <h2 id='titulo-2'>Deseja realmente excluir este estudante?</h2><br>

                                    <p id='pesquisa'><span>Matrícula do curso:</span> $codigo_curso<br><br>
                                    <span>Nome do curso:</span> $nome_curso<br><br>
                                    <span>Data de criação do curso:</span> $data_curso<br><br>
                                    <span>Duração do curso:</span> $duracao_curso<br><br>
                                    <span>Carga horária do curso:</span> $carga_horaria_curso<br><br>
                                    <span>Coordenador do curso:</span> $coordenador_curso<br><br>
                                    <span>Descrição do curso:</span> $descricao_curso</p><br>

                                    <div>
                                        <input type='radio' name='excluir' id='excluirs' value='sim'><label for='excluirs'> Sim</label>

                                        <input type='radio' name='excluir' id='excluirn' value='nao'><label for='excluirn'> Não</label>
                                    </div><br>
                                    
                                    <input type='hidden' name='operacao' value='3'>
        
                                    <input type='hidden' name='opcao' value='2'>

                                    <input type='hidden' name='codigo_curso' value='$codigo_curso'>

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
                            $codigo_curso = $_POST['codigo_curso'];
                            $nome_curso = $_POST['nome_curso'];
                            $data_curso = $_POST['data_curso'];
                            $duracao_curso = $_POST['duracao_curso'];
                            $carga_horaria_curso = $_POST['carga_horaria_curso'];
                            $coordenador_curso = $_POST['coordenador_curso'];
                            $descricao_curso = $_POST['descricao_curso'];

                            $sql = "update curso set nome_curso = '$nome_curso', data_criacao_curso = '$data_curso', descricao_curso = '$descricao_curso', duracao_curso = '$duracao_curso', carga_horaria_curso = '$carga_horaria_curso', coordenador_curso = '$coordenador_curso' where id_curso = $codigo_curso;";

                            $requisicao = mysqli_query($connect, $sql);

                            if ($requisicao == true) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Curso alterado com sucesso!</h2><br>
    
                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Houve um erro na alteração do curso, tente novamente.</h2><br>
    
                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                        
                        case 2:
                            if (!isset($_POST['excluir'])) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Detectamos um erro.</h2><br>
    
                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";

                                exit(0);
                            }

                            if ($_POST['excluir'] == 'sim') {
                                $codigo_curso = $_POST['codigo_curso'];
                                
                                $sql = "delete from curso where id_curso = $codigo_curso;";

                                $requisicao = mysqli_query($connect, $sql);

                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Curso excluído com sucesso!</h2><br>
    
                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Operação cancelada!</h2><br>
    
                                    <a href='./curso.php'><button name='botao-retornar'>Retornar</button></a>
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