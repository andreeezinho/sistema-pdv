<?php
    require_once __DIR__ . '/../layout/top.php';
?>

    <div class="p-4 rounded-lg mt-14">
        <h3 class="text-2xl text-center font-bold tracking-tight text-gray-900">Finalizar Venda</h3>
        
        <div class="flex gap-x-2 w-full min-h-[70dvh] p-4 mt-5">
            <div class="flex flex-col gap-y-6 w-1/2 p-5">
                <h3 class="text-2xl font-bold tracking-tight text-gray-900">Dados da venda</h3>

                <div class="w-1/3 pb-8 border-b border-gray-500">
                    <h3 class="text-3xl font-bold tracking-tight text-gray-800">Total</h3>
                    <div class="border border-gray-300 rounded-lg bg-neutral-100 p-3">
                        <p class="text-2xl font-bold tracking-tight text-gray-800">R$ <?= number_format($total,2,",",".") ?></p>
                    </div>
                </div>

                <div class="w-1/3">
                    <form action="/pdv/<?= $venda->uuid ?>/finalizar/troco" method="POST" id="form-troco">
                        <h3 class="text-3xl font-bold tracking-tight text-gray-500">Recebido</h3>
                        <input type="number" name="troco" id="troco" min="0" max="1000" step="0.01" autofocus class="w-full border border-gray-300 rounded-lg bg-neutral-50 p-3 text-2xl text-gray-800">
                    </form>
                </div>

                <div class="w-1/3">
                    <h3 class="text-3xl font-bold tracking-tight text-red-300">Troco</h3>
                    <div class="border border-gray-300 rounded-lg bg-neutral-100 p-3">
                        <p class="text-2xl font-bold tracking-tight text-gray-800" id="valor-troco">R$ </p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-y-6 w-1/2 p-5 bg-red-">
                <h3 class="text-2xl font-bold tracking-tight text-gray-900">Pagamento</h3>

                <div class="flex w-full mt-9">
                    <div id="pagamento-erro"></div>
                    <form action="/pdv/<?= $venda->uuid ?>/finalizar/pagamento" method="POST" class="w-1/6" id='forma-pagamento'>
                        <input type="number" name="pagamento" id="pagamento" class="w-full border border-gray-300 rounded-s-lg bg-neutral-50 p-3 text-2xl text-gray-800 px-8 text-center">
                    </form>
                    <p class="w-5/6 border-s border-y border-gray-300 bg-neutral-50 p-3 text-2xl text-gray-800" id='forma'> Forma de Pagamento </p>
                    <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="w-1/6 border border-y border-gray-300 rounded-e-lg bg-neutral-50 hover:bg-neutral-200 p-3 text-2xl text-gray-800 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>

                    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow-sm">
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">Formas de pagamento</h3>
                                    <div class="relative overflow-x-auto">
                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        Código
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Pagamento
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if(count($allPayments) > 0){
                                                        foreach($allPayments as $pagamento){
                                                ?>
                                                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-200 hover:cursor-pointer">
                                                        <td class="px-6 py-4">
                                                            <?= $pagamento->id ?>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <?= $pagamento->forma ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <h3 class="text-3xl font-bold tracking-tight text-gray-500 mb-4">Cliente</h3>
                    <form action="" method="POST">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="border border-gray-300 rounded-lg bg-neutral-100 p-3">
                                <p class="flex tracking-tight text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 border-r mr-2 pr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    Nome do cliente
                                </p>
                            </div>
                            <input type="number" name="cpf" class="border border-gray-300 rounded-lg bg-neutral-50 p-3 text-gray-500" placeholder="CPF do cliente">
                        </div>
                        <button type="submit" class="flex w-full bg-gray-300 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded mt-3 justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            Encontrar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="w-full flex gap-2">
            <form action="/pdv/<?= $venda->uuid ?>/cancelar" method="POST" class="w-full">
                <button type="submit" class="flex w-full bg-red-300 hover:bg-red-500 text-white font-bold py-2 px-4 rounded mt-1 justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    Cancelar
                </button>
            </form>

            <form action="/pdv/<?= $venda->uuid ?>/em-espera" method="POST" class="w-full">
                <button type="submit" class="flex w-full bg-gray-300 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded mt-1 justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Em Espera
                </button>
            </form>

            <form action="/pdv/<?= $venda->uuid ?>/finalizar" method="POST" class="w-full">
                <button type="submit" class="flex w-full bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded mt-1 justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Finalizar
                </button>
            </form>
        </div>
    </div>

<?php
    require_once __DIR__ . '/../layout/bottom.php';
?>

<script>
    $(document).ready(function () {

        $('#form-troco').submit(function (e) {
            e.preventDefault();

            const formData = $(this).serialize();

             $.ajax({
                type: "POST",
                url: "/pdv/<?= $venda->uuid ?>/finalizar/troco",
                data: formData,
                dataType: "JSON",
                success: function(response) {
                    if(response.errors){
                        console.log(response.errors);
                    }else{
                        console.log(response);

                        $('#valor-troco').text(response.troco.toLocaleString('pt-BR', { 
                            style: 'currency', 
                            currency: 'BRL' 
                        }));
                    }
                },
                error: function(error){
                    console.error('Erro na requisição:', error);
                    $('#forma').text('Não encontrado');
                }
            });
        });

        $('#forma-pagamento').submit(function (e) {
            e.preventDefault();

            const formData = $(this).serialize();

             $.ajax({
                type: "POST",
                url: "/pdv/<?= $venda->uuid ?>/finalizar/pagamento",
                data: formData,
                dataType: "JSON",
                success: function(response) {
                    if(response.errors){
                        $('#forma').text('Não encontrado');

                        $('#pagamento-erro').html(errors).show();
                    }else{
                        $('#pagamento').val(response.id); 
                        $('#forma').text(response.forma);
                    }
                },
                error: function(error){
                    console.error('Erro na requisição:', error);
                    $('#forma').text('Não encontrado');
                }
            });
        });

    });
</script>