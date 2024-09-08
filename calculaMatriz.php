<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calcula matriz</title>
    <style>
        .matrix-container {
            display: inline-block;
            position: relative;
        }

        .matrix-container::before, .matrix-container::after {
            content: "[";
            position: absolute;
            top: -15px;
            font-size: 64px;
        }

        .matrix-container::after {
            content: "]";
            left: auto;
            right: 0;
        }

        table {
            border-collapse: collapse;
            margin-left: 20px;
            margin-right: 20px;
        }

        td {
            padding: 7px;
            text-align: center;
        }
    </style>
</head>
<body>
<?php
// Nossa matriz salzinho
$matrizSal = [
    [1, 3],
    [2, 4]
];

// Nossa matriz açucarada
$matrizAcucar = [
    [-2, 3 / 2],
    [1, -1 / 2]
];

// Alfabeto de matrizes segundo folha da Angela
$alfabeto = [
    'A' => [0, 0],
    'B' => [1, 0],
    'C' => [2, 0],
    'D' => [3, 0],
    'E' => [4, 0],
    'F' => [0, 1],
    'G' => [1, 1],
    'H' => [2, 1],
    'I' => [3, 1],
    'J' => [4, 1],
    'K' => [0, 2],
    'L' => [1, 2],
    'M' => [2, 2],
    'N' => [3, 2],
    'O' => [4, 2],
    'P' => [0, 3],
    'Q' => [1, 3],
    'R' => [2, 3],
    'S' => [3, 3],
    'T' => [4, 3],
    'U' => [0, 4],
    'V' => [1, 4],
    'W' => [2, 4],
    'X' => [3, 4],
    'Y' => [4, 4],
    'Z' => [0, 5],
    ' ' => [1, 5],
    '.' => [2, 5],
    ',' => [3, 5],
    '?' => [4, 5]
];

// Pega mensagem
$message = $_POST['message'];

// Recebe mensagem criptografada
$messageCripto = criptografaMensagem($message, $matrizSal, $alfabeto);

// Recebe mensagem descriptografada
$messageDescripto = descriptografaMensagem($messageCripto[0], $matrizAcucar, $alfabeto);

// Exibe
echo "<p>Mensagem enviada: \"$message\"</p>";

echo '<p>Mensagem convertida utilizando o alfabeto: </p>';
exibeMatriz($messageCripto[1]);

echo '<p>Mensagem criptografada: </p>';
exibeMatriz($messageCripto[0]);

echo "<p>Mensagem descriptografada: \"$messageDescripto\"</p>";

echo '<h2>Informações utilizadas:</h2>';

echo '<p>Matriz utilizada na criptografia:</p>';
echo 'A = ';
exibeMatriz($matrizSal);

echo '<p>Matriz inversa utlizada na descriptografia:</p>';
echo 'A^-1 = ';
exibeMatriz($matrizAcucar);

echo '<p>Codificação do alfabeto:</p>';

foreach ($alfabeto as $key => $value) {
    echo ' "' . $key . '" => ';
    exibeAlfabeto($value);

}

?>
</body>
</html>

<?php
/**
 * Criptografa a mensagem utilizando matrizes
 * @param string $message
 * @param array $matrizSal
 * @param array $alfabeto
 * @return array
 */
function criptografaMensagem(string $message, array $matrizSal, array $alfabeto): array
{
    // Converte string da mensagem em array
    $message = str_split(strtoupper($message));

    $messageMatrificada = [];

    // Percorre a mensagem e o alfabeto, gerando a mensagem convertida em matriz
    foreach ($message as $caracter) {
        foreach ($alfabeto as $letra => $matriz) {
            if ($caracter == $letra) {
                $messageMatrificada[] = $matriz;
            }
        }
    }

    $messageCripto = [];

    // Calcula a matriz criptografada utilizando o salzinho
    foreach ($messageMatrificada as $caracterMatrificado) {
        $cima = ($matrizSal[0][0] * $caracterMatrificado[0]) + ($matrizSal[0][1] * $caracterMatrificado[1]);
        $baixo = ($matrizSal[1][0] * $caracterMatrificado[0]) + ($matrizSal[1][1] * $caracterMatrificado[1]);

        $messageCripto[] = [
            $cima,
            $baixo
        ];
    }

    // Retorna a matriz criptografada
    return [$messageCripto, $messageMatrificada];
}

/**
 * Descriptografa mensagens utilizando matrizes inversas
 * @param array $messageCripto
 * @param array $matrizAcucar
 * @param array $alfabeto
 * @return string
 */
function descriptografaMensagem(array $messageCripto, array $matrizAcucar, array $alfabeto): string
{
    $messageDescripto = [];

    // Calcula a matriz criptografada utilizando o salzinho
    foreach ($messageCripto as $caracterCripto) {
        $cima = ($matrizAcucar[0][0] * $caracterCripto[0]) + ($matrizAcucar[0][1] * $caracterCripto[1]);
        $baixo = ($matrizAcucar[1][0] * $caracterCripto[0]) + ($matrizAcucar[1][1] * $caracterCripto[1]);

        $messageDescripto[] = [
            $cima,
            $baixo
        ];
    }

    $messageMatrificada = '';

    // Percorre a mensagem e o alfabeto, gerando a mensagem convertida em matriz
    foreach ($messageDescripto as $caracterMatrificado) {
        foreach ($alfabeto as $letra => $matriz) {
            if ($caracterMatrificado == $matriz) {
                $messageMatrificada .= $letra;
            }
        }
    }

    // Retorna a matriz criptografada
    return strtolower($messageMatrificada);
}

function exibeMatriz($matriz): void
{
    echo '<div class="matrix-container"><table>';
    echo '<tr>';
    foreach ($matriz as $coluna) {
        foreach ($coluna as $indice => $itemColuna) {
            if ($indice == 0) {
                echo '<td>' . $itemColuna . '</td>';
            }
        }
    }
    echo '</tr>';
    echo '<tr>';
    foreach ($matriz as $coluna) {
        foreach ($coluna as $indice => $itemColuna) {
            if ($indice == 1) {
                echo '<td>' . $itemColuna . '</td>';
            }
        }
    }
    echo '</tr>';
    echo '</table></div>';
}

function exibeAlfabeto(array $alfabeto): void
{
    echo '<div class="matrix-container"><table>';
    echo '<tr>';
    foreach ($alfabeto as $indice => $itemColuna) {
        if ($indice == 0) {
            echo '<td>' . $itemColuna . '</td>';
        }
    }

    echo '</tr>';
    echo '<tr>';
    foreach ($alfabeto as $indice => $itemColuna) {
        if ($indice == 1) {
            echo '<td>' . $itemColuna . '</td>';
        }
    }

    echo '</tr>';
    echo '</table></div>';
}