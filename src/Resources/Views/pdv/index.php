<?php
    require_once __DIR__ . '/../layout/top.php';
?>

    <div class="bg-neutral-200 p-4 rounded-lg mt-14">
        <h3 class="text-2xl text-center font-bold tracking-tight text-gray-900">Venda em aberto</h3>

        <div class="flex w-[100%] bg-neutral-50 mt-2 p-3 gap-x-2">
            <div class="w-2/3 min-h-[80dvh] p-2 border border-r border-gray-400">
                <div class="flex p-2 py-4 bg-gray-100 border-b border-gray-400 mb-4 pr-7">
                    <p class="w-2/4 text-gray-500 border-r border-gray-400 pl-2">Produto</p>
                    <p class="w-1/4 text-gray-500 border-r border-gray-400 pl-2">Código</p>
                    <p class="w-1/6 text-gray-500 border-r border-gray-400 pl-2">Quantidade</p>
                    <p class="w-1/6 text-gray-500 pl-2">Total</p>
                </div>

                <div class="h-[70vh] overflow-y-scroll">
                    <div class="flex p-2 text-gray-800 border-b border-gray-200 mb-4">
                        <p class="w-2/4 border-r border-gray-200 pl-2">Nome do Produto</p>
                        <p class="w-1/4 border-r border-gray-200 pl-2">1234567891011</p>
                        <p class="w-1/6 border-r border-gray-200 text-center">3</p>
                        <p class="w-1/6 pl-2">R$ 0,00</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-y-2 w-1/3 min-h-[80dvh] p-2">
                <div class="flex h-3/4 p-3">
                    <img src="<?= LOGO ?>" alt="Logo Site" class="m-auto">
                </div>

                <div class="h-2/4 p-3 pt-8">
                    <form action="" method="POST">
                        <div class="grid gap-2  grid-cols-2">
                            <div>
                                <label for="codigo" class="block mb-1 text-sm font-medium text-gray-900">Código</label>
                                <input type="number" id="codigo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                            </div>

                            <div>
                                <label for="quantidade" class="block mb-1 text-sm font-medium text-gray-900">Quant.</label>
                                <input type="number" id="quantidade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                            </div>

                            <div>
                                <label for="desconto" class="block mb-1 text-sm font-medium text-gray-900">Desconto</label>
                                <input type="number" id="desconto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value=0 />
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Adicionar</button>
                        </div>
                    </form>
                </div>

                <div class="h-1/6 bg-gray-100 p-3">
                    <h1 class="text-4xl text-center text-gray-700">Total a pagar: <b>R$ 0,00</b></h1>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once __DIR__ . '/../layout/bottom.php';
?>