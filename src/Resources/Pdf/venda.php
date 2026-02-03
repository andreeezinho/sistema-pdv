<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= URL_SITE ?>/public/img/site/site-icone.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= URL_SITE ?>/public/css/style.css">
    <title>Venda</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            font-size: 6px;
        }

        .bg-services{
            background-color:rgb(252, 252, 252);
        }

        .colunas{
            padding-left: 5px;
        }

        .borda{
            border-right: 1px solid #313131;
        }

        .borda-linha{
            border-bottom: 1px solid #313131;
        }

        .borda-linha-titulo{
            border-bottom: 1px solid #313131;
        }

        .services-container{
            width: 100%;
        }
    </style>
</head>
<body class="bg-theme">
    <div class="container">
        <div class="col-12">
            <p style="font-size: 15px;margin-bottom:20px;text-align: center;">Cupom Fiscal</p>
        </div>

        <table>
            <tr>
                <td width="100%" height="5px" class="colunas"><b>Razao Social:</b> <?= date('d/m/Y - h:i', strtotime($venda->created_at)) ?></td>
            </tr>
            <tr>
                <td width="100%" height="5px" class="colunas"><b>CNPJ:</b> <?= date('d/m/Y - h:i', strtotime($venda->created_at)) ?></td>
            </tr>
            <tr>
                <td width="100%" height="5px" class="colunas"><b>Endereço:</b> <?= date('d/m/Y - h:i', strtotime($venda->created_at)) ?></td>
            </tr>
            <tr>
                <td width="100%" height="5px" class="colunas"><b>Data:</b> <?= date('d/m/Y - H:i', strtotime($venda->created_at)) ?></td>
            </tr>
        </table>

        <div class="col-12 text-center">
            <p style='font-size: 10px; margin: 15px 0 15px 0'>Produtos</p>
        </div>

        <div class="services-container bg-services">
            <table class="" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <td width="60%" height="20px" class="colunas borda borda-linha-titulo"><b style="font-size: 8px">Produto</b></td>
                        <td width="10%" height="20px" class="colunas borda borda-linha-titulo"><b style="font-size: 8px">Quant.</b></td>
                        <td width="30%" height="20px" class="colunas borda-linha-titulo"><b style="font-size: 8px">Preço</b></td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(count($produtos) > 0){
                        foreach($produtos as $produto){
                ?>
                    <tr>
                        <td width="60%" height="20px" class="colunas borda borda-linha"><?= $produto->nome ?></td>
                        <td width="10%" height="20px" class="colunas borda borda-linha"><?= $produto->quantidade ?></td>
                        <td width="30%" height="20px" class="colunas borda-linha">R$ <?= number_format($produto->preco,2,",",".") ?></td>
                    </tr>
                <?php
                        }
                    }else{
                ?>
                    <tr>
                        <td width="60%" height="20px" class="colunas">Não há produtos na venda</td>
                        <td width="10%" height="20px" class="colunas"></td>
                        <td width="30%" height="20px" class="colunas"></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>

        <div class="col-12 pt-3">
            <div class="mx-auto text-end px-5">
                <p style="font-size: 10px" class="my-1"><b>Desconto:</b> <?= $venda->desconto ?>%</p>
                <p style="font-size: 10px" class="my-1"><b>Total:</b> R$: <?= number_format($venda->total,2,",",".") ?></p>
                <p style="font-size: 10px" class="my-1"><b>Valor Pago:</b> R$: <?= number_format($venda->total + $venda->troco,2,",",".") ?></p>
                <p style="font-size: 10px" class="my-1"><b>Troco:</b> R$: <?= number_format($venda->troco,2,",",".") ?></p>
            </div>
        </div>

    </div>
</body>
</html>