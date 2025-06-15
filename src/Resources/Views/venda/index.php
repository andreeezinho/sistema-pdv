<?php
    require_once __DIR__ . '/../layout/top.php';
?>

    <div class="p-8 rounded-lg mt-14">
        <nav class="" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-violet-600">
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
                        <a href="/vendas" class="ms-1 text-sm font-medium text-gray-700 hover:text-violet-600 md:ms-2">Vendas</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">-</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="w-full bg-neutral-50 mt-6 p-4 rounded-lg">
            <div class="relative h-[75dvh] overflow-y-scroll">
                <div class="flex gap-x-2">
                    <button type="button" data-modal-target="popup-modal-filter" data-modal-toggle="popup-modal-filter" class="flex gap-x-1 font-medium border text-gray-800 p-2 px-5 mb-4 rounded-lg text-center bg-gray-100 hover:bg-gray-700 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path d="M18.75 12.75h1.5a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM12 6a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 6ZM12 18a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 18ZM3.75 6.75h1.5a.75.75 0 1 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM5.25 18.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 0 1.5ZM3 12a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 3 12ZM9 3.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM12.75 12a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM9 15.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                        </svg>
                        Filtrar
                    </button>

                    <?php
                        if(isset($usuario) && !is_null($usuario)){
                    ?>
                        <a href="/vendas" class="flex gap-x-1 font-medium border text-gray-800 p-2 px-5 mb-4 rounded-lg text-center bg-gray-300 hover:bg-gray-700 hover:text-white">
                            Limpar
                        </a>
                    <?php } ?>

                    <!-- <div class="flex gap-x-2 w-1/2">
                        <p class="flex gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-green-500">
                                <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                            </svg>
                            Concluída
                        </p>
                        <p class="flex gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-yellow-500">
                                <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                            </svg>
                            Em andamento
                        </p>
                        <p class="flex gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-gray-500">
                                <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                            </svg>
                            Em espera
                        </p>
                        <p class="flex gap-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-red-500">
                                <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                            </svg>
                            Cancelada
                        </p>
                    </div> -->
                </div>

                <div id="popup-modal-filter" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow-sm">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-filter">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>

                            <div class="p-4 md:p-5">
                                <h3 class="text-center text-gray-700 my-4">Filtrar Vendas</h3>
                                <form action="/vendas" method="GET" class="flex flex-col gap-y-4">
                                    <div>
                                        <label for="usuario" class="block text-sm/6 font-medium text-gray-900">Vendedor</label>
                                        <div class="mt-2">
                                            <input type="text" name="usuario" id="usuario" value="<?= $usuario ?? null ?>" placeholder="Insira o vendedor" class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="exact_data" class="block text-sm/6 font-medium text-gray-900">Data</label>
                                        <div class="mt-2">
                                            <input type="date" name="exact_data" id="exact_data" value="<?= $data ?? null ?>" placeholder="Insira a data" class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="total" class="block text-sm/6 font-medium text-gray-900">Valor da Venda</label>
                                        <div class="mt-2">
                                            <input type="number" name="total" id="total" value="<?= $total ?? null ?>" placeholder="Insira o valor da venda" class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Situação</label>
                                        <div class="mt-2">
                                            <select name="situacao" id="situacao" value="<?= $situacao ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                                <option value="" <?= ($situacao == '') ? 'selected' : null ?>>Insira a situação</option>
                                                <option value='cancelada' <?= ($situacao == 'cancelada') ? 'selected' : null ?>>Cancelada</option>
                                                <option value='concluida' <?= ($situacao == 'concluida') ? 'selected' : null ?>>Concluída</option>
                                                <option value='em andamento' <?= ($situacao == 'em andamento') ? 'selected' : null ?>>Em Andamento</option>
                                                <option value='em espera' <?= ($situacao == 'em espera') ? 'selected' : null ?>>Em Espera</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="py-2.5 px-5 text-sm font-medium text-white focus:outline-none bg-violet-500 rounded-lg border border-gray-200 hover:bg-violet-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Filtrar</button>
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-white">
                    <thead class="text-xs text-white uppercase bg-violet-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Usuário
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Forma de Pagamento
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Troco
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Data
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Situação
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                -
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($vendas) > 0){
                                foreach($vendas as $venda){
                        ?>
                            <tr class="bg-stone-100 border-b border-gray-400 text-gray-800">
                                <td class="px-6 py-4">
                                    <?= $venda->usuario ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php
                                        foreach($vendaPagamento as $pagamento){
                                            if($pagamento->vendas_id == $venda->id){
                                    ?>
                                        <?= $pagamento->forma ?? null ?>
                                    <?php 
                                            } 
                                        }
                                    ?>
                                </td>
                                <td class="px-6 py-4">
                                    R$ <?= number_format($venda->total ?? 0,2,",",".") ?>
                                </td>
                                <td class="px-6 py-4">
                                    R$ <?= number_format($venda->troco ?? 0,2,",",".") ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= date('d/m/Y - H:i', strtotime($venda->created_at)) ?>
                                </td>
                                <td class="px-6 py-4 text-<?= $venda->situacao == 'concluida' ? 'green' : ($venda->situacao == 'em andamento' ? 'yellow' : ($venda->situacao == 'em espera' ? 'gray' : 'red'))?>-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mx-auto">
                                        <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                                    </svg>
                                </td>
                                <td class="px-6 py-4 flex gap-x-2 justify-center">
                                    <a href="/vendas/<?= $venda->uuid ?>/visualizar" class="font-medium text-white p-2 rounded-lg text-center bg-blue-500 hover:bg-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>

                                    <a href="/vendas/<?= $venda->uuid ?>/comprovante" class="font-medium text-white p-2 rounded-lg text-center bg-violet-400 hover:bg-violet-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                            <path fill-rule="evenodd" d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 0 0 3 3h15a3 3 0 0 1-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125ZM12 9.75a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H12Zm-.75-2.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5H12a.75.75 0 0 1-.75-.75ZM6 12.75a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5H6Zm-.75 3.75a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5H6a.75.75 0 0 1-.75-.75ZM6 6.75a.75.75 0 0 0-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75v-3A.75.75 0 0 0 9 6.75H6Z" clip-rule="evenodd" />
                                            <path d="M18.75 6.75h1.875c.621 0 1.125.504 1.125 1.125V18a1.5 1.5 0 0 1-3 0V6.75Z" />
                                        </svg>
                                    </a>

                                    <button type="button" data-modal-target="popup-modal-<?= $venda->uuid ?>" data-modal-toggle="popup-modal-<?= $venda->uuid ?>" class="font-medium text-white p-2 rounded-lg text-center bg-red-400 hover:bg-red-700">
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
                                                        <button data-modal-hide="popup-modal-<?= $venda->uuid ?>" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Não</button>
                                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Cancelar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

<?php
    require_once __DIR__ . '/../layout/bottom.php';
?>