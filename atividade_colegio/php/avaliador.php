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
        </div>
    </div>

    <div id="container-2">
            <form action="./avaliador2.php" method="POST" id="formulario-escolha">
                <h2 id="titulo-2">Selecione:</h2><br>

                <div>
                    <input type="radio" name="opcao" id="criar" value="1"><label for="criar"> Criar avaliador</label><br><br>

                    <input type="radio" name="opcao" id="pesquisar" value="2"><label for="pesquisar"> Pesquisar avaliador</label><br><br>

                    <input type="radio" name="opcao" id="listar" value="3"><label for="listar"> Mostrar avaliador</label><br><br>

                    <input type="radio" name="opcao" id="alterar" value="4"><label for="alterar"> Alterar avaliador</label><br><br>

                    <input type="radio" name="opcao" id="excluir" value="5"><label for="excluir"> Excluir avaliador</label>
                </div><br>
                
                <input type='hidden' name='operacao' value='1'>

                <div>
                    <button type="submit">Escolher opção</button>

                    <button type="reset">Limpar escolha</button>
                </div>
            </form>
    </div>
</body>
</html>