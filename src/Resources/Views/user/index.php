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
                        <a href="/usuarios" class="ms-1 text-sm font-medium text-gray-700 hover:text-gray-600 md:ms-2">Usuários</a>
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

            <div class="float-end mx-4">
                <a href="/usuarios/cadastro" class="text-white bg-gray-800 hover:bg-gray-800 focus:ring-4 focus:ring-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">+</a>
            </div>
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
                    if(!is_null($nome_usuario)){
                ?>
                    <a href="/usuarios" class="flex gap-x-1 font-medium border text-gray-800 p-2 px-5 mb-4 rounded-lg text-center bg-gray-300 hover:bg-gray-700 hover:text-white">
                        Limpar
                    </a>
                <?php } ?>
                </div>

                <div id="popup-modal-filter" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow-sm">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>

                            <div class="p-4 md:p-5">
                                <h3 class="text-center text-gray-700 my-4">Filtrar Usuários</h3>
                                <form action="/usuarios" method="GET" class="flex flex-col gap-y-4">
                                    <div>
                                        <label for="nome_usuario" class="block text-sm/6 font-medium text-gray-900">Usuário</label>
                                        <div class="mt-2">
                                            <input type="text" name="nome_usuario" id="nome_usuario" value="<?= $nome_usuario ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Situação</label>
                                        <div class="mt-2">
                                            <select name="ativo" id="ativo" value="<?= $ativo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
                                                <option value="" <?= ($ativo == '') ? 'selected' : null ?>>Insira a situação</option>
                                                <option value='1' <?= ($ativo == '1') ? 'selected' : null ?>>Ativo</option>
                                                <option value='0' <?= ($tipo == '0') ? 'selected' : null ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="py-2.5 px-5 text-sm font-medium text-white focus:outline-none bg-gray-500 rounded-lg border border-gray-200 hover:bg-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Filtrar</button>
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>

<?php
    require_once __DIR__ . '/../layout/bottom.php';
?>