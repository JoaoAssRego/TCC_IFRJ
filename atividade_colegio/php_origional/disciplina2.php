<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="https://portal.ifrj.edu.br/sites/all/themes/ifrj/favicon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" type="text/css" href="../style.css">

    <title>Sistema - Disciplinas | IFRJ</title>
</head>
<body>
    <div id="cabecalho">
        <a href="../index.html" title="Logo IFRJ">
            <img src="../images/logo-ifrj.png" alt="Logo IFRJ">
        </a>
    </div>

    <div id="container-1">
        <div id="titulo-1">
            <h1 style="font-size: 18px;">Sistema de administração de disciplinas</h1>

            <a href="../index.html" id="botao-menu">Menu principal</a>

            <a href="./disciplina.php" id="botao-menu">Voltar para opções</a>
        </div>
    </div>

    <div id="container-2">
        <?php
            $connect = mysqli_connect('127.0.0.1', 'root', '', 'colegio');

            if (!isset($_POST['opcao'])) {
                echo"
                <div id='formulario-escolha'>
                    <h2 class='msg-erro'>Retorne e selecione uma opção!</h2><br>
    
                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
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
                                    <form action='disciplina2.php' method='POST' id='formulario-escolha'>
                                        <h2 id='titulo-2'>Insira as informações da disciplina</h2><br>
            
                                        <div class='div-form'>
                                            <label for='numero_disciplina'>Matrícula disciplina: (Apenas números inteiros)</label>
                                        
                                            <input type='text' name='numero_disciplina' id='numero_disciplina' required maxlength='11'><br><br>
            
                                            <label for='nome_disciplina'>Nome do disciplina:</label>
            
                                            <input type='text' name='nome_disciplina' id='nome_disciplina' required><br><br>
            
                                            <label for='carga_horaria_disciplina'>Carga horária do disciplina: (X horas)</label>
            
                                            <input type='text' name='carga_horaria_disciplina' id='carga_horaria_disciplina' required><br><br>
            
                                            <label for='professor_disciplina'>Professor(a) do disciplina:</label>
            
                                            <input type='text' name='professor_disciplina' id='professor_disciplina' required><br><br>
                            ";

                            $sql = "select * from curso";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo "
                                    <label for='disciplina_curso'>Adicione a disciplina a um curso:</label>

                                    <select name='disciplina_curso' id='disciplina_curso' required disabled>
                                        <option value='0' autofocus>Nenhum curso encontrado!</option>
                                    </select>
                                ";
                            } else {
                                echo "
                                    <label for='disciplina_curso'>Adicione a disciplina a um curso:</label><br>
                                            
                                    <select name='disciplina_curso' id='disciplina_curso' required>
                                ";

                                while ($campos = mysqli_fetch_assoc($requisicao)) {
                                    $id_curso = $campos['id_curso'];
                                    $nome_curso = $campos['nome_curso'];

                                    echo "
                                        <option value='$id_curso' autofocus>$nome_curso</option>
                                    ";
                                }

                                echo"
                                    </select>
                                </div><br>
                                ";
                            }
                                                   
                            echo "
                                    <input type='hidden' name='operacao' value='2'>
                
                                    <input type='hidden' name='opcao' value='1'>
                
                                    <div class='div-form'>
                                        <label for='descricao_disciplina'>Descreva a disciplina:</label>
                    
                                        <textarea name='descricao_disciplina' cols='30' rows='10' required></textarea>
                                    </div><br>

                                    <div>
                                        <button type='submit'>Criar disciplina</button>
                    
                                        <button type='reset'>Limpar formulário</button>
                                    </div>
                                </form>
                            </div>
                            ";
                            break;

                        case 2:
                            echo"
                            <form action='disciplina2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira a matrícula da disciplina para efetuar a pesquisa</h2><br>
        
                                <div>
                                    <label for='numero_disciplina'>Matrícula disciplina: (Apenas números inteiros)</label>
                                            
                                    <input type='text' name='numero_disciplina' id='numero_disciplina' required maxlength='11'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='2'>
        
                                <div>
                                    <button type='submit'>Pesquisar disciplina</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;

                        case 3:
                            $sql = "select * from disciplina;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhuma disciplina cadastrada.</h2><br>
    
                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 id='titulo-2'>Veja abaixo todas as disciplinas cadastradas</h2><br>

                                    <table id='tabela-mostrar'>
                                        <tr>
                                            <th>Matrícula</th>
                                            <th>Nome</th>
                                            <th>Carga horária</th>
                                            <th>Professor</th>
                                            <th>Curso</th>
                                            <th>Descrição</th>
                                        </tr>
                                ";

                                $campos = mysqli_fetch_array($requisicao);
                                
                                for ($i=0; $i < $campos; $i++) { 
                                    $codigo_disciplina = $campos['id_disciplina'];
                                    $nome_disciplina = $campos['nome_disciplina'];
                                    $carga_horaria_disciplina = $campos['carga_horaria_disciplina'];
                                    $professor_disciplina = $campos['professor_disciplina'];
                                    $id_curso = $campos['id_curso'];
                                    $descricao_disciplina = $campos['descricao_disciplina'];

                                    $sql2 = "select * from curso where id_curso = $id_curso";

                                    $requisicao2 = mysqli_query($connect, $sql2);                                    

                                    $campos2 = mysqli_fetch_assoc($requisicao2);

                                    $disciplina_curso = $campos2['nome_curso'];

                                    echo"
                                        <tr>
                                            <td>$codigo_disciplina</td>
                                            <td>$nome_disciplina</td>
                                            <td>$carga_horaria_disciplina</td>
                                            <td>$professor_disciplina</td>
                                            <td>$disciplina_curso</td>
                                            <td>$descricao_disciplina</td>
                                        </tr>
                                    ";

                                    $campos = mysqli_fetch_assoc($requisicao);
                                }

                                echo"
                                    </table><br>
                                
                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                        
                        case 4:
                            echo"
                            <form action='disciplina2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira a matrícula da disciplina que você deseja alterar</h2><br>
        
                                <div>
                                    <label for='numero_disciplina'>Matrícula disciplina: (Apenas números inteiros)</label>
                                                
                                    <input type='text' name='numero_disciplina' id='numero_disciplina' required maxlength='11'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='3'>
        
                                <div>
                                    <button type='submit'>Alterar disciplina</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;

                        case 5:
                            echo"
                            <form action='disciplina2.php' method='POST' id='formulario-escolha'>
                                <h2 id='titulo-2'>Insira a matrícula da disciplina que você deseja excluir</h2><br>
        
                                <div>
                                    <label for='numero_disciplina'>Matrícula disciplina: (Apenas números inteiros)</label>
                                                    
                                    <input type='text' name='numero_disciplina' id='numero_disciplina' required maxlength='11'>
                                </div><br>
        
                                <input type='hidden' name='operacao' value='2'>
        
                                <input type='hidden' name='opcao' value='4'>
        
                                <div>
                                    <button type='submit'>Excluir disciplina</button>
            
                                    <button type='reset'>Limpar campo</button>
                                </div>
                            </form>";
                            break;
                    }
                }

                if ($operacao == 2) {
                    switch ($opcao) {
                        case 1:
                            $codigo_disciplina = $_POST['numero_disciplina'];
                            $nome_disciplina = $_POST['nome_disciplina'];
                            $carga_horaria_disciplina = $_POST['carga_horaria_disciplina'];
                            $professor_disciplina = $_POST['professor_disciplina'];
                            $disciplina_curso = $_POST ['disciplina_curso'];
                            $descricao_disciplina = $_POST['descricao_disciplina'];
    
                            $sql = "insert into disciplina values ('$codigo_disciplina', '$nome_disciplina', '$descricao_disciplina', '$carga_horaria_disciplina', '$professor_disciplina', '$disciplina_curso');";  
    
                            $requisicao = mysqli_query($connect, $sql);
    
                            if ($requisicao == true) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Disciplina adicionada com sucesso!</h2><br>
    
                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Houve um erro na criação da disciplina, tente novamente.</h2><br>
    
                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;
                        
                        case 2:
                            $codigo_disciplina = $_POST['numero_disciplina'];

                            $sql = "select * from disciplina where id_disciplina = $codigo_disciplina;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhuma disciplina com esse código.</h2><br>
    
                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                $campos = mysqli_fetch_array($requisicao);

                                $codigo_disciplina = $campos['id_disciplina'];
                                $nome_disciplina = $campos['nome_disciplina'];
                                $carga_horaria_disciplina = $campos['carga_horaria_disciplina'];
                                $professor_disciplina = $campos['professor_disciplina'];
                                $id_curso = $campos['id_curso'];
                                $descricao_disciplina = $campos['descricao_disciplina'];

                                $sql2 = "select * from curso where id_curso = $id_curso";

                                $requisicao2 = mysqli_query($connect, $sql2);

                                $campos2 = mysqli_fetch_array($requisicao2);

                                $disciplina_curso = $campos2['nome_curso'];

                                echo"
                                <div id='formulario-escolha'>
                                    <h2 id='titulo-2'>Veja abaixo o resultado da pesquisa</h2><br>

                                    <p id='pesquisa'><span>Matrícula da disciplina:</span> $codigo_disciplina<br><br>
                                    <span>Nome da disciplina:</span> $nome_disciplina<br><br>
                                    <span>Carga horária da disciplina:</span> $carga_horaria_disciplina<br><br>
                                    <span>Professor da disciplina:</span> $professor_disciplina<br><br>
                                    <span>Curso pertencente:</span> $disciplina_curso<br><br>
                                    <span>Descrição da disciplina:</span> $descricao_disciplina</p><br><br>

                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;

                        case 3:
                            $codigo_disciplina = $_POST['numero_disciplina'];

                            $sql = "select * from disciplina where id_disciplina = $codigo_disciplina;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhuma disciplina com essa matrícula.</h2><br>
    
                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else { 
                                $campos = mysqli_fetch_array($requisicao);

                                $codigo_disciplina = $campos['id_disciplina'];
                                $nome_disciplina = $campos['nome_disciplina'];
                                $carga_horaria_disciplina = $campos['carga_horaria_disciplina'];
                                $professor_disciplina = $campos['professor_disciplina'];
                                $descricao_disciplina = $campos['descricao_disciplina'];

                                echo"
                                <div style='padding-bottom: 30px;'>
                                    <form action='disciplina2.php' method='POST' id='formulario-escolha'>
                                        <h2 id='titulo-2'>Altere as informações da disciplina</h2><br>

                                        <p style='color: #000000;'><strong>Matrícula disciplina:</strong> $codigo_disciplina<p>

                                        <div class='div-form'>
                                            <label for='nome_disciplina'>Nome do disciplina:</label>
            
                                            <input type='text' name='nome_disciplina' id='nome_disciplina' value='$nome_disciplina'><br><br>
            
                                            <label for='carga_horaria_disciplina'>Carga horária do disciplina: (X horas)</label>
            
                                            <input type='text' name='carga_horaria_disciplina' id='carga_horaria_disciplina' value='$carga_horaria_disciplina'><br><br>
            
                                            <label for='professor_disciplina'>Professor(a) do disciplina:</label>
            
                                            <input type='text' name='professor_disciplina' id='professor_disciplina' value='$professor_disciplina'><br><br>
                            ";

                            $sql = "select * from curso";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo "
                                    <label for='disciplina_curso'>Adicione a disciplina a um curso:</label>

                                    <select name='disciplina_curso' id='disciplina_curso' required disabled>
                                        <option value='0' autofocus>Nenhum curso encontrado!</option>
                                    </select>
                                ";
                            } else {
                                echo "
                                    <label for='disciplina_curso'>Adicione a disciplina a um curso:</label><br>
                                            
                                    <select name='disciplina_curso' id='disciplina_curso' required>
                                ";

                                while ($campos = mysqli_fetch_assoc($requisicao)) {
                                    $id_curso = $campos['id_curso'];
                                    $nome_curso = $campos['nome_curso'];

                                    echo "
                                        <option value='$id_curso' autofocus>$nome_curso</option>
                                    ";
                                }

                                echo"
                                    </select>
                                </div><br>
                                ";
                            }

                            echo "
                                    <input type='hidden' name='operacao' value='3'>
                
                                    <input type='hidden' name='opcao' value='1'>

                                    <input type='hidden' name='codigo_disciplina' value='$codigo_disciplina'>

                                    <div class='div-form'>
                                        <label for='descricao_disciplina'>Descreva a disciplina:</label>
                    
                                        <textarea name='descricao_disciplina' cols='30' rows='10'>$descricao_disciplina</textarea>
                                    </div><br>

                                    <div>
                                        <button type='submit'>Alterar disciplina</button>
                    
                                        <button type='reset'>Limpar formulário</button>
                                    </div>
                                </form>
                            </div>
                            ";
                            }
                            break;
                        
                        case 4:
                            $codigo_disciplina = $_POST['numero_disciplina'];

                            $sql = "select * from disciplina where id_disciplina = $codigo_disciplina;";

                            $requisicao = mysqli_query($connect, $sql);

                            $resultado = mysqli_num_rows($requisicao);

                            if ($resultado == 0) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Não encontramos nenhuma disciplina com essa matrícula.</h2><br>
    
                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                $campos = mysqli_fetch_array($requisicao);

                                $codigo_disciplina = $campos['id_disciplina'];
                                $nome_disciplina = $campos['nome_disciplina'];
                                $carga_horaria_disciplina = $campos['carga_horaria_disciplina'];
                                $professor_disciplina = $campos['professor_disciplina'];
                                $id_curso = $campos['id_curso'];
                                $descricao_disciplina = $campos['descricao_disciplina'];

                                $sql2 = "select * from curso where id_curso = $id_curso";

                                $requisicao2 = mysqli_query($connect, $sql2);

                                $campos2 = mysqli_fetch_array($requisicao2);

                                $disciplina_curso = $campos2['nome_curso'];

                                echo"
                                <form action='disciplina2.php' method='POST' id='formulario-escolha'>
                                    <h2 id='titulo-2'>Deseja realmente excluir este estudante?</h2><br>

                                    <p id='pesquisa'><span>Matrícula da disciplina:</span> $codigo_disciplina<br><br>
                                    <span>Nome da disciplina:</span> $nome_disciplina<br><br>
                                    <span>Carga horária da disciplina:</span> $carga_horaria_disciplina<br><br>
                                    <span>Professor da disciplina:</span> $professor_disciplina<br><br>
                                    <span>Curso pertencente:</span> $disciplina_curso<br><br>
                                    <span>Descrição da disciplina:</span> $descricao_disciplina</p><br>

                                    <div>
                                        <input type='radio' name='excluir' id='excluirs' value='sim'><label for='excluirs'> Sim</label>

                                        <input type='radio' name='excluir' id='excluirn' value='nao'><label for='excluirn'> Não</label>
                                    </div><br>
                                    
                                    <input type='hidden' name='operacao' value='3'>
        
                                    <input type='hidden' name='opcao' value='2'>

                                    <input type='hidden' name='codigo_disciplina' value='$codigo_disciplina'>

                                    <button type='submit'>Excluir disciplina</button>
                                </form>
                                ";
                            }
                            break;
                    }
                }

                if ($operacao == 3) {
                    switch ($opcao) {
                        case 1:
                            $codigo_disciplina = $_POST['codigo_disciplina'];

                            $nome_disciplina = $_POST['nome_disciplina'];
                            $carga_horaria_disciplina = $_POST['carga_horaria_disciplina'];
                            $professor_disciplina = $_POST['professor_disciplina'];
                            $disciplina_curso = $_POST ['disciplina_curso'];
                            $descricao_disciplina = $_POST['descricao_disciplina'];

                            $sql = "update disciplina set nome_disciplina = '$nome_disciplina', descricao_disciplina = '$descricao_disciplina', carga_horaria_disciplina = '$carga_horaria_disciplina', professor_disciplina = '$professor_disciplina' where id_disciplina = $codigo_disciplina;";

                            $requisicao = mysqli_query($connect, $sql);

                            if ($requisicao == true) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Disciplina alterada com sucesso!</h2><br>
    
                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Houve um erro na alteração da disciplina, tente novamente.</h2><br>
    
                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            }
                            break;

                        case 2:
                            if (!isset($_POST['excluir'])) {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Ops! Detectamos um erro.</h2><br>
    
                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";

                                exit(0);
                            }

                            if ($_POST['excluir'] == 'sim') {
                                $codigo_disciplina = $_POST['codigo_disciplina'];
                                
                                $sql = "delete from disciplina where id_disciplina = $codigo_disciplina;";

                                $requisicao = mysqli_query($connect, $sql);

                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-sucesso'>Disciplina excluída com sucesso!</h2><br>
    
                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
                                </div>
                                ";
                            } else {
                                echo"
                                <div id='formulario-escolha'>
                                    <h2 class='msg-erro'>Operação cancelada!</h2><br>
    
                                    <a href='./disciplina.php'><button name='botao-retornar'>Retornar</button></a>
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