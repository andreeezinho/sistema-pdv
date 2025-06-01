<?php
    require_once __DIR__ . '/../layout/top.php';
?>

    <div class="bg-neutral-50 p-4 rounded-lg mt-14">
        <div class="flex mt-3 mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
            </svg>
            <h3 class="text-3xl font-bold tracking-tight text-gray-900">Sua Loja</h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-4">
            <a href="/usuarios" class="block max-w-sm p-6 bg-white border border-indigo-400 rounded-lg shadow-sm hover:bg-indigo-50">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Usuários</h5>
                </div>
                <?php
                    if(isset($usuarios) && count($usuarios) > 0){
                ?>
                    <p class="font-normal text-gray-700"><?= count($usuarios) ?></p>
                <?php
                    }else{
                ?>
                    <p class="font-normal text-gray-700">Ainda não há usuários</p>
                <?php
                    }
                ?>
            </a>

            <a href="/produtos" class="block max-w-sm p-6 bg-white border border-indigo-400 rounded-lg shadow-sm hover:bg-indigo-50">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Produtos</h5>
                </div>
                <?php
                    if(isset($produtos) && count($produtos) > 0){
                ?>
                    <p class="font-normal text-gray-700"><?= count($produtos) ?></p>
                <?php
                    }else{
                ?>
                    <p class="font-normal text-gray-700">Ainda não há produtos</p>
                <?php
                    }
                ?>
            </a>

            <a href="/vendas" class="block max-w-sm p-6 bg-white border border-indigo-400 rounded-lg shadow-sm hover:bg-indigo-50">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Vendas</h5>
                </div>
                <?php
                    if(isset($vendas) && count($vendas) > 0){
                ?>
                    <p class="font-normal text-gray-700"><?= count($vendas) ?></p>
                <?php
                    }else{
                ?>
                    <p class="font-normal text-gray-700">Ainda não há vendas</p>
                <?php
                    }
                ?>
            </a>
        </div>
    </div>

    <div class="flex gap-x-2">
        <div class="bg-neutral-50 p-4 rounded-lg mt-5 w-1/2">
            <div class="flex mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2 my-auto">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                <h3 class="text-2xl font-bold tracking-tight text-gray-900">Últimas vendas</h3>
            </div>

            <div class="flex px-2 border-b border-gray-200 my-4">
                <p class="w-[25%] text-gray-500 border-r border-gray-200 pl-2">Código</p>
                <p class="w-[25%] text-gray-500 border-r border-gray-200 pl-2">Produtos</p>
                <p class="w-[25%] text-gray-500 border-r border-gray-200 pl-2">Total</p>
                <p class="w-[25%] text-gray-500 pl-2">Pagamento</p>
            </div>

            <div class="h-[50dvh] overflow-y-scroll">
                <?php
                    if(count($last_sales) > 0){
                        foreach($last_sales as $venda){
                ?>
                        <div class="flex bg-white p-2 border border-gray-200 mb-1">
                            <p class="w-[25%] text-gray-800 border-r border-gray-200 pl-2"><?= $venda->id ?></p>
                            <p class="w-[25%] text-gray-800 border-r border-gray-200 pl-2"><?= $venda->usuario ?></p>
                            <p class="w-[25%] text-gray-800 border-r border-gray-200 pl-2">R$ <?= number_format($venda->total,2,",",".") ?></p>
                            <p class="w-[25%] text-gray-800 pl-2"><?= $venda->id ?></p>
                        </div>
                <?php
                        }
                    }else{
                ?>

                <?php
                    }
                ?>
            </div>
        </div>

        <div class="flex flex-col bg-neutral-50 p-4 rounded-lg mt-5 w-1/2">
            <div class="bg-white p-4 rounded-lg w-[100%] y-1/2">
                <div class="flex mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2 my-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="text-2xl font-bold tracking-tight text-gray-900">Lucro diário</h3>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg w-[100%] y-1/2 mt-3">
            </div>
        </div>
    </div>

<?php
    require_once __DIR__ . '/../layout/bottom.php';
?>