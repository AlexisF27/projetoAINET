<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Encomenda state</title>
</head>
<body>
    <h1>A encomenda num: {{$encomenda->id}}</h1>
    <h3>O estado da encomenda esta {{$encomenda->estado}} </h3>
    <h3>Cliente id:  {{$encomenda->cliente_id}}</h3>
    <h3>Cliente nif:  {{$encomenda->nif}}</h3>
    <h3>Endereco encomenda:  {{$encomenda->endereco}}</h3>
    <h3>Tipo pagamento:  {{$encomenda->tipo_pagamento}}</h3>
    <h3>Data:  {{$encomenda->data}}</h3>
    <h3>Nota  {{$encomenda->nota}}</h3>
    <h3>Cliente id:  {{$encomenda->cliente_id}}</h3>

</body>
</html>
