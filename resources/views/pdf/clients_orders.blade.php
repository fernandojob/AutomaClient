<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Clientes e Pedidos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        .client { border-bottom: 1px solid #ddd; padding: 10px 0; }
        .order { margin-left: 20px; font-size: 11px; }
    </style>
</head>
<body>
    <h2>Relatório de Clientes e Pedidos</h2>
    
    @foreach ($clients as $client)
        <div class="client">
            <strong>Nome:</strong> {{ $client->name }}<br>
            <strong>Email:</strong> {{ $client->email }}<br>
            <strong>Telefone:</strong> {{ $client->phone }}<br>
            <strong>Endereço:</strong> {{ $client->address }}<br>

            <strong>Pedidos:</strong>
            @if (count($client->orders) > 0)
                <ul>
                    @foreach ($client->orders as $order)
                        <li class="order">
                            {{ $order->product }} - Quantidade: {{ $order->quantity }} - R$ {{ $order->price }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="order">Nenhum pedido encontrado.</p>
            @endif
        </div>
    @endforeach
</body>
</html>
