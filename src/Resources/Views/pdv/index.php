<?php
    require_once __DIR__ . '/../layout/top.php';
?>

    <div class="p-4 rounded-lg mt-14">
        <h3 class="text-2xl text-center font-bold tracking-tight text-gray-900">Venda em aberto</h3>

        <div class="flex w-[100%] bg-neutral-50 mt-2 p-3 gap-x-2">
            <div class="w-2/3 min-h-[80dvh] p-2 border border-r border-gray-400">
                <div class="flex p-2 py-4 bg-gray-100 border-b border-gray-400 mb-4 pr-7">
                    <p class="w-2/4 text-gray-500 border-r border-gray-400 pl-2">Produto</p>
                    <p class="w-1/6 text-gray-500 border-r border-gray-400 pl-2">Código</p>
                    <p class="w-1/6 text-gray-500 border-r border-gray-400 pl-2">Quantidade</p>
                    <p class="w-1/5 text-gray-500 pl-2">Total</p>
                </div>

                <div class="h-[70vh] overflow-y-scroll">
                    <?php
                        if(count($produtos) > 0){
                            foreach($produtos as $produto){
                    ?>
                        <div class="flex p-2 text-gray-800 border-b border-gray-200 mb-4">
                            <p class="w-2/4 border-r border-gray-200 pl-2"><?= $produto->nome ?></p>
                            <p class="w-1/6 border-r border-gray-200 pl-2"><?= $produto->codigo ?></p>
                            <p class="w-1/6 border-r border-gray-200 text-center"><?= $produto->quantidade ?></p>
                            <div class="w-1/5 pl-2 flex">
                                <p class="w-1/2">R$ <?=  number_format(($produto->preco * $produto->quantidade) ?? 0,2,",",".") ?></p>
                                <form action="/pdv/<?= $venda->uuid ?>/remover/<?= $produto->uuid ?>" method="POST" class="w-1/2">
                                    <button type="button" class="float-end bg-red-300 hover:bg-red-500 text-white font-bold py-2 px-4 rounded" data-modal-target="popup-modal-><?= $produto->uuid ?>" data-modal-toggle="popup-modal-><?= $produto->uuid ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>

                                    <div id="popup-modal-><?= $produto->uuid ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow-sm">
                                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                </button>
                                                <div class="p-4 md:p-5 text-center">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Deseja realmente remover o produto?</h3>
                                                    <button data-modal-hide="popup-modal-><?= $produto->uuid ?>" type="button" class="text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Não
                                                    </button>
                                                    <button type="submit" class="py-2.5 px-5 bg-red-600 hover:bg-red-800 ms-3 text-sm font-medium text-white focus:outline-none rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100">Sim</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>

            <div class="flex flex-col gap-y-2 w-1/3 min-h-[80dvh] p-2">
                <div class="flex h-3/4 p-3">
                    <img src="<?= LOGO ?>" alt="Logo Site" class="m-auto">
                </div>

                <div class="h-2/4 p-3 pt-8">
                    <form action="/pdv/<?= $venda->uuid ?>/adicionar" method="POST">
                        <div class="grid gap-2 grid-cols-2">
                            <div>
                                <label for="codigo" class="block mb-1 text-sm font-medium text-gray-900">Código</label>
                                <input type="number" name="codigo" id="codigo" autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                            </div>

                            <div>
                                <label for="quantidade" class="block mb-1 text-sm font-medium text-gray-900">Quant.</label>
                                <input type="float" name="quantidade" id="quantidade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required value="1" />
                            </div>

                            <!-- <div>
                                <label for="desconto" class="block mb-1 text-sm font-medium text-gray-900">Desconto</label>
                                <input type="number" name="desconto" id="desconto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value=0 />
                            </div> -->
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="w-full bg-violet-300 hover:bg-violet-500 text-white font-bold py-2 px-4 rounded">Adicionar</button>
                        </div>
                    </form>
                </div>

                <div class="h-1/6 p-3">
                    <h1 class="text-4xl text-center text-gray-700">Total a pagar: <b>R$ <?= number_format(($total) ?? 0,2,",",".") ?></b></h1>
                    <div class="flex gap-x-2 justify-center mt-3">
                        <form action="" method="POST">
                            <button type="button" class="flex w-full bg-gray-300 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded" data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 pr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                Cancelar
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
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Deseja realmente cancelar a venda?</h3>
                                            <button data-modal-hide="popup-modal" type="button" class="text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Não
                                            </button>
                                            <button type="submit" class="py-2.5 px-5 bg-red-600 hover:bg-red-800 ms-3 text-sm font-medium text-white focus:outline-none rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100">Sim</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="" method="POST">
                            <button type="submit" class="flex w-full bg-lime-300 hover:bg-lime-500 text-white font-bold py-2 px-4 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 pr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                Finalizar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once __DIR__ . '/../layout/bottom.php';
?>