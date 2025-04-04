<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Pedido</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2>📦 Olá, {{ $order->client->name }}!</h2>
    <p>Seu pedido foi recebido com sucesso. Aqui estão os detalhes:</p>

    <p><strong>Produto:</strong> {{ $order->product }}</p>
    <p><strong>Quantidade:</strong> {{ $order->quantity }}</p>
    <p><strong>Preço Total:</strong> R$ {{ number_format($order->price * $order->quantity, 2, ',', '.') }}</p>

    <p>Acompanhe o status do seu pedido pelo nosso sistema.</p>
    <p>Obrigado por comprar conosco! 😊</p>

    <hr>
    <p>AutomaClient - Sistema de Gestão de Clientes</p>
</body>
</html>
