<?php
  // faz a conexão com o banco de dados que criamos no MySQL usando o phpMyAdmin
  //                    endereço    usuario  senha   nome do banco
  $db = mysqli_connect("localhost", "root", "", "banco-dos-tesouros");
  $db->set_charset("utf8");

  // verifica se a conexão funcionou...
  if (!$db) {
    // encerra a execução do script php, mostrando um erro
    $descricaoErro = "Erro: não foi possível conectar ao banco de dados. ";
    $descricaoErro = $descricaoErro . "Detalhes: " . mysqli_connect_error();
    die($descricaoErro);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Controle de Estoque dos Tesouros</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" href="calice.ico">
  </head>
  <body>
    <h1>Gerenciador de Tesouros <?php echo "Marcos";?></h1>
    <?php
    // faz uma consulta no banco de dados para pegar todos os tesouros cadastrados
    $sql = "SELECT * FROM tesouros";
    $resultado = $db->query($sql);

    $totalGeral = 100;
  ?>
    <table>
      <caption>Estes são os tesouros acumulados do Barba-Ruiva em suas aventuras</caption>
      <thead>
        <tr>
          <th>Tesouro</th>
          <th>Nome</th>
          <th>Valor unitário</th>
          <th>Quantidade</th>
          <th>Valor total</th>
        </tr>
      </thead>
      <tbody>
      <?php
      // $resultado é o array que vamos percorrer
      // $tesouroAtual é a variável que contém o elemento atual do array
      foreach ($resultado as $tesouroAtual) {
        
      ?>
      <tr>
          <td><img src="<?=$tesouroAtual["icone"]?>"?></td>
          <td><?php echo $tesouroAtual["nome"]?></td>
          <td><?php echo $tesouroAtual["valorUnitario"] ?></td>
          <td><?=$tesouroAtual["quantidade"]?></td>
          <?php $totalGeral+=$tesouroAtual["quantidade"]*$tesouroAtual["valorUnitario"]?>
          <td><?=number_format($tesouroAtual["quantidade"]*$tesouroAtual["valorUnitario"], 2, ',', '.')?></td>

        </tr>
      <?php
        }
      ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="4">Total geral</td>
          <td><?=number_format($totalGeral, 2, ',', '.');?></td>
        </tr>
      </tfoot>
    </table>
    <p>Yarr Harr, marujo! Aqui é o temido Barba-Ruiva e você deve me ajudar
      a contabilizar os espólios das minhas aventuras!</p>
  </body>
</html>
