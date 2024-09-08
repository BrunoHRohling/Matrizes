<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Matrizes</title>
</head>
<body>
<h1>Criptografia de mensagem utilizando matrizes</h1>
<form action="./" method="post">
    <label for="Mensagem">Digite sua mensagem:</label>
    <input type="text" name="message" id="Mensagem" required>

    <button type="submit" name="submit">Criptografar mensagem!</button>
</form>
<?php
if (isset($_POST['submit'])) {
    include 'calculaMatriz.php';
}
?>
</body>
</html>