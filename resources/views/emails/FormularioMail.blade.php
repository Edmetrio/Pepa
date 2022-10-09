<!DOCTYPE html>
<html>
<head>
    <title>Formulário do Preenchido!</title>
</head>
<body>
    <h1>Dados do Formulário preenchido</h1><hr>
   
    <p><strong>Tipo de Agricultura: </strong>{{ $details->categoria }}</p>
    <p><strong>Produtos disponíveis: </strong>{{ $details->produto }}</p>
    <p><strong>Quantidade: </strong>{{ $details->quantidade }}</p>
    <p><strong>Montante: </strong>{{ $details->montante }}</p>
    <p><strong>Observação: </strong>{{ $details->observacao }}</p>
    <h3>Detalhes do Fornecedor</h3>
    <p><strong>Nome do Produtor: </strong>{{ $details->users->name }}</p>
    <p><strong>E-mail: </strong>{{ $details->users->email }}</p>
    <p><strong>Endereço: </strong>
    @foreach($details->users->enderecos as $e)
    <ul>
        <li>{{$e->nome}}</li>
    </ul>
    @endforeach
    </p>
    <p><strong>Telefone: </strong>
    @foreach($details->users->telefones as $e)
    <ul>
        <li>{{ $e->numero }}</li>
    </ul>
    @endforeach
    </p>
    <p><strong>Distrito: </strong>{{ $details->distritos->nome }}</p>
    <p><strong>Provincia: </strong>{{ $details->distritos->provincias->nome }}</p>
    <p><strong>Pais: </strong>{{ $details->distritos->provincias->pais->nome }}</p>
    <p>Obrigado!</p>
</body>
</html>