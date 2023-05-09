<?php

// Configurações do banco de dados e conexão com o banco de dados (configurado no meu phpmyadmin local)
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "contratos";

$conn = new mysqli($servername, $username, $password, $dbname);


// Verificação de conexão
if ($conn->connect_error) {
  die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta dos dados requisitados
$sql = "SELECT c.codigo AS codigo_contrato, c.data_inclusao, c.valor, c.prazo, cs.convenio, 
cs.servico, cv.verba, b.nome AS nome_banco
FROM Tb_contrato c
JOIN Tb_convenio_servico cs ON cs.codigo = c.convenio_servico
JOIN Tb_convenio cv ON cv.codigo = cs.convenio
JOIN Tb_banco b ON b.codigo = cv.banco";

$result = $conn->query($sql);

// Exibindo resultados se retornar dados:

if ($result->num_rows > 0) {

  echo "
  
  <table>
         <tr>
             <th>Banco</th>
             <th>Verba</th>
             <th>Código do Contrato</th>
             <th>Data de Inclusão</th>
             <th>Valor</th>
             <th>Prazo</th>
         </tr>
    </table>";

  while($row = $result->fetch_assoc()) {

    echo "

    <tr>
         <td>".$row["nome"]."</td>
         <td>".$row["verba"]."</td>
         <td>".$row["codigo"]."</td>
         <td>".$row["data_inclusao"]."</td>
         <td>".$row["valor"]."</td>
         <td>".$row["prazo"]."</td>
    </tr>";

} else {

  echo "Nenhum resultado encontrado.";

}

$conn->close();

?> 