<?php

// Pega mensagem
$message = $_GET['message'];

// Recebe mensagem criptografada
$messageCripto = criptografaMensagem($message);

// Recebe mensagem descriptografada
//$messageDescripto = descriptografaMensagem($messageCripto);

// Exibe
echo '<p>Mensagem enviada:</p>';
echo '<p>' . $message . '</p>';

echo '<p>Mensagem criptografada: </p>';
echo '[<br>';
foreach ($messageCripto as $coluna) {
    foreach ($coluna as $itemColuna) {
        echo '(';
        echo $itemColuna;
        echo ')';
    }
    echo '<br>';
}
echo ']';



/**
 * Criptografa a mensagem utilizando matrizes
 * @param string $message
 * @return array
 */
function criptografaMensagem(string $message): array
{
    // Nossa matriz salzinho
    $matrizSal = [
        [1, 5],
        [5, 1]
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
    return $messageCripto;
}

/**
 * Descriptografa mensagens utilizando matrizes inversas
 * @param array $messageCripto
 * @return void
 */
function descriptografarMensagem(array $messageCripto)
{

}