<?php
    require_once __DIR__ . '/../layout/top.php';
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
                        <a href="/vendas" class="ms-1 text-sm font-medium text-gray-700 hover:text-gray-600 md:ms-2">Vendas</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Detalhes</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="w-full bg-neutral-50 mt-6 p-4 rounded-lg">
            <h3 class="text-2xl text-center font-bold tracking-tight text-gray-900">Informações da Venda</h3>

            <div class="md:w-2/3 mt-5 mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-2 gap-y-4">
                    <div class="col-span-2">
                        <label class="block mb-1 text-sm font-medium text-gray-900">N° da Venda</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <p><?= $vendedor->id ?? null ?></p>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Vendedor</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <p><?= $vendedor->nome ?? null ?></p>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Total</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <p>R$ <?= number_format($venda->total,2,",",".") ?? null ?></p>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Desconto</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <p><?= $venda->desconto ?? null ?></p>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Troco</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <p>R$ <?= number_format($venda->troco,2,",",".") ?? null ?></p>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Situação da Venda</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <p><?= $venda->situacao ?? null ?></p>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Forma de Pagamento</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <p><?= $pagamento->forma ?? 'Não inserido' ?></p>
                        </div>
                    </div>
                    
                    <div class="col-span-2">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Criada em</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <p><?= date('d/m/Y - H:i', strtotime($venda->created_at)) ?? null ?></p>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-1 text-sm font-medium text-gray-900">Atualizada em</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <p><?= date('d/m/Y - H:i', strtotime($venda->updated_at)) ?? null ?></p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 p-3">
                    <h3 class="text-1xl text-center font-bold tracking-tight text-gray-900">Produtos da venda</h3>

                    <h3 class="text-1xl font-bold tracking-tight text-gray-900 mt-5">Total de produtos: <?= count($allProductsInSale) ?></h3>

                    <table class="w-full text-sm text-left rtl:text-right text-white">
                        <thead class="text-xs text-white uppercase bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nome
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Código
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tipo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quant
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Preço
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(count($allProductsInSale) > 0){
                                    foreach($allProductsInSale as $produto){
                            ?>
                                <tr class="bg-gray-100 border-b border-gray-400 text-gray-800">
                                    <td class="px-6 py-4">
                                        <?= $produto->nome ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $produto->codigo ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= strtoupper($produto->tipo) ?>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <?= $produto->quantidade ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        R$ <?= number_format($produto->preco ?? 0,2,",",".") ?>
                                    </td>
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <h3 class="text-1xl text-end font-bold tracking-tight text-gray-900 mt-2">Total: <?= number_format($venda->total ?? 0,2,",",".") ?></h3>
                </div>

                <button type="button" data-modal-target="popup-modal-<?= $venda->uuid ?>" data-modal-toggle="popup-modal-<?= $venda->uuid ?>" class="font-medium float-end mt-8 text-white p-2 rounded-lg text-center bg-red-400 hover:bg-red-700 flex gap-x-2">
                    Cancelar
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>

                <div id="popup-modal-<?= $venda->uuid ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow-sm">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-<?= $venda->uuid ?>">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-700">Deseja cancelar esse venda?</h3>
                                <h3 class="mb-5 text-sm font-normal text-gray-500">Total: R$<?= number_format($venda->total ?? 0,2,",",".") ?></h3>
                                <form action="/vendas/<?= $venda->uuid ?>/cancelar" method="POST">
                                    <button data-modal-hide="popup-modal-<?= $venda->uuid ?>" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Não</button>
                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Cancelar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once __DIR__ . '/../layout/bottom.php';
?>