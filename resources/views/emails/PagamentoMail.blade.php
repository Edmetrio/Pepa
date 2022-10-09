<!DOCTYPE html>
<html>
<head>
    <title>Nova Encomenda</title>
</head>
<body>
    <h1>Dados da nova encomenda</h1><hr>
   
    <p><strong>Nome do Produto: </strong>{{ $details->produtos->nome }}</p>
    <p><strong>Quantidade: </strong>{{ $details->quantidade }} T</p>
    <p><strong>Nome do cliente: </strong>{{ $details->users->name }}</p>
    @foreach($details->users->telefones as $u)
    <p><strong>Número do cliente: </strong>{{ $u->numero }}</p>
    @endforeach
    <p><strong>E-mail: </strong>{{ $details->users->email }}</p>
    @foreach($details->enderecos as $e)
    <p><strong>Ponto de Entrega: </strong>{{ $e->nome }}</p>
    @endforeach
    <p><strong>Ponto de Origem: </strong>{{ $details->distritos->nome }}</p>
    <p>Obrigado!</p>
</body>
</html>