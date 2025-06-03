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
                        <a href="/produtos" class="ms-1 text-sm font-medium text-gray-700 hover:text-violet-600 md:ms-2">Produtos</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Editar</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="w-full bg-neutral-50 mt-6 p-4 rounded-lg">
            <h3 class="text-2xl text-center font-bold tracking-tight text-gray-900">Editar Produto</h3>

            <div class="md:w-2/3 mt-5 mx-auto">
                <form action="/produtos/<?= $produto->uuid ?>/editar" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                        <?php 
                            include_once('form.php');
                        ?>
                    </div>

                    <div class="text-center mt-5 ">
                        <a href="/produtos" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2.5 px-4 rounded">Cancelar</a>
                        <button type="submit" class="bg-violet-300 hover:bg-violet-500 text-white font-bold py-2 px-4 rounded">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>

<?php
    require_once __DIR__ . '/../layout/bottom.php';
?>