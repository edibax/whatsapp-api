<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Mensagem via WhatsApp</title>
</head>
<body>
    <h1>Enviar Mensagem via WhatsApp</h1>
    <form method="POST" action="">
        <label for="number">Número do WhatsApp (inclua o código do país):</label><br>
        <input type="text" id="number" name="number" placeholder="Ex: 5519998098434" required><br><br>

        <label for="message">Mensagem:</label><br>
        <textarea id="message" name="message" rows="4" placeholder="Digite a mensagem" required></textarea><br><br>

        <button type="submit" name="send">Enviar Mensagem</button>
    </form>

    <?php
    if (isset($_POST['send'])) {
        $number = $_POST['number'];
        $message = $_POST['message'];

        // Envia a requisição para a API usando cURL
        $url = 'http://localhost:3000/send-message';
        $data = array(
            'number' => $number,
            'message' => $message
        );

        $options = array(
            'http' => array(
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ),
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            echo "<p>Erro na requisição: Não foi possível enviar a mensagem.</p>";
        } else {
            $response = json_decode($result, true);
            if ($response['success']) {
                echo "<p>Mensagem enviada com sucesso!</p>";
            } else {
                echo "<p>Erro ao enviar mensagem: " . $response['error'] . "</p>";
            }
        }
    }
    ?>
</body>
</html>
