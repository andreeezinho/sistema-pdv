<?php
    require_once __DIR__ . '/../../layout/top.php';
?>

    <div class="p-8 rounded-lg mt-14">
        <nav class="" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-600">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="/fiscal/entradas" class="ms-1 text-sm font-medium text-gray-700 hover:text-gray-600 md:ms-2">Fiscal/Entradas</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Cadastro</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="w-full bg-neutral-50 mt-6 p-4 rounded-lg">
            <h3 class="text-2xl text-center font-bold tracking-tight text-gray-900">Entrada de NF</h3>

            <div class="md:w-2/3 mt-5 mx-auto">
                <form action="/fiscal/entradas/cadastro" method="POST" id="fiscal-form">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                        <?php 
                            include_once('form.php');
                        ?>
                    </div>

                    <div class="flex flex-col my-4 mt-8 pt-2 border-1 border-t border-gray-300">
                        <h3 class="text-gray-800 text-2xl mb-3">Produtos da NF</h3>
                        <table class="text-sm text-left rtl:text-right text-white max-h-[200px] overflow-y-scroll">
                            <thead class="text-xs text-white uppercase bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Produto
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Valor Un.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tipo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantidade
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Codigo
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        NCM
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        COFINS
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        ICMS
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        IPI
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        PIS
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="products-table">
                                
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt-10">
                        <a href="/fiscal/entradas" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2.5 px-4 rounded">Cancelar</a>
                        <button type="submit" class="bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
    require_once __DIR__ . '/../../layout/bottom.php';
?>

<script>

    $(document).ready(function () {

        var products = [];

        if($("#searchNF").length){
            $("#searchNF").on('click', function(){
                var fileInput = document.getElementById("file");
                var file = fileInput.files[0];

                if (!file) {
                    return;
                }

                var formData = new FormData();
                formData.append('file', file);

                console.log('formData aqui: ' + formData);

                $.ajax({
                    type: "POST",
                    url: "/fiscal/entradas/search",
                    data: formData,
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response.infNFe);

                        $("#nNF").val(response.infNFe.ide.nNF);
                        $("#cNF").val(response.infNFe['@attributes'].Id);
                        $("#dhEmi").val(response.infNFe.ide.dhEmi.substring(0, 10));

                        $("#vBC").val(response.infNFe.total.ICMSTot.vBC);
                        $("#vICMS").val(response.infNFe.total.ICMSTot.vICMS);
                        $("#vBCST").val(response.infNFe.total.ICMSTot.vBCST);
                        $("#vST").val(response.infNFe.total.ICMSTot.vST);
                        $("#vFCP").val(response.infNFe.total.ICMSTot.vFCP);
                        $("#vFCPST").val(response.infNFe.total.ICMSTot.vFCP);
                        $("#vProd").val(response.infNFe.total.ICMSTot.vProd);
                        $("#vFrete").val(response.infNFe.total.ICMSTot.vFrete);
                        $("#vSeg").val(response.infNFe.total.ICMSTot.vSeg);
                        $("#vDesc").val(response.infNFe.total.ICMSTot.vDesc);
                        $("#vIPI").val(response.infNFe.total.ICMSTot.vIPI);
                        $("#vCOFINS").val(response.infNFe.total.ICMSTot.vCOFINS);
                        $("#vNF").val(response.infNFe.total.ICMSTot.vNF);

                        response.infNFe.det.forEach(function(produto){
                            products.push(produto);
                        });

                        var productItem = '';

                        if (products && Array.isArray(products) && products.length > 0) {
                            products.forEach(function(product) {
                                console.log(product);
                                productItem += '<tr class="odd:bg-gray-100 even:bg-gray-300 border-b border-gray-400 text-gray-800">';
                                productItem += '    <td class="px-6 py-4">';
                                productItem +=          product.prod.xProd;
                                productItem += '    </td>';
                                productItem += '    <td class="px-6 py-4">';
                                productItem +=          product.prod.vUnCom.substring(0, 8);
                                productItem += '    </td>';
                                productItem += '    <td class="px-6 py-4">';
                                productItem +=          product.prod.uCom;
                                productItem += '    </td>';
                                productItem += '    <td class="px-6 py-4">';
                                productItem +=          product.prod.qCom;
                                productItem += '    </td>';
                                productItem += '    <td class="px-6 py-4">';
                                productItem +=          product.prod.cEAN;
                                productItem += '    </td>';
                                productItem += '    <td class="px-6 py-4">';
                                productItem +=          product.prod.NCM;
                                productItem += '    </td>';
                                productItem += '    <td class="px-6 py-4">';
                                productItem +=          product.imposto.COFINS.COFINSAliq.vCOFINS;
                                productItem += '    </td>';
                                productItem += '    <td class="px-6 py-4">';
                                productItem +=          product.imposto.ICMS.ICMSSN101.vCredICMSSN;
                                productItem += '    </td>';
                                productItem += '    <td class="px-6 py-4">';
                                productItem +=          product.imposto.IPI.IPITrib.vIPI;
                                productItem += '    </td>';
                                productItem += '    <td class="px-6 py-4">';
                                productItem +=          product.imposto.PIS.PISAliq.vPIS;
                                productItem += '    </td>';
                                productItem += '</tr>';
                            });

                            $('#products-table').html(productItem).show();
                        }
                    },
                    error: function(error){
                        console.error('Erro na requisição:', error);
                    }
                });
            });
        }

        $('#fiscal-form').submit(function(e) {
            e.preventDefault();

            let formData = {};

            $(this).serializeArray().forEach(item => {
                formData[item.name] = item.value;
            });

            formData.products = products;

            $.ajax({
                type: "POST",
                url: "/fiscal/entradas/cadastro",
                data: formData,
                dataType: 'JSON',
                success: function(response) {
                    console.log(response);
                },
                error: function(error){
                    console.error('Erro na requisição:', error);
                }
            });
        });

    });

</script>