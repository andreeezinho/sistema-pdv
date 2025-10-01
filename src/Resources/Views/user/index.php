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
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-filter">
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
                                            <input type="text" name="nome_usuario" id="nome_usuario" value="<?= $nome_usuario ?? null ?>" placeholder="Nome do usuário" class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="cpf" class="block text-sm/6 font-medium text-gray-900">CPF</label>
                                        <div class="mt-2">
                                            <input type="text" name="cpf" id="cpf" value="<?= $cpf ?? null ?>" placeholder="CPF do usuário" class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Cargo</label>
                                        <div class="mt-2">
                                            <select name="cargo" id="cargo" value="<?= $cargo ?? null ?>" class="border-2 border-solid block w-full rounded-md bg-white px-2 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
                                                <option value="" <?= ($cargo == '') ? 'selected' : null ?>>Selecione o cargo</option>
                                                <option value="Administrativo" <?= ($cargo == 'Administrativo') ? 'selected' : null ?>>Administrativo</option>
                                                <option value='Frente de Caixa' <?= ($cargo == 'Frente de Caixa') ? 'selected' : null ?>>Frente de Caixa</option>
                                                <option value='Repositor' <?= ($cargo == 'Repositor') ? 'selected' : null ?>>Repositor</option>
                                                <option value='Entregador' <?= ($cargo == 'Entregador') ? 'selected' : null ?>>Entregador</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Situação</label>
                                        <div class="mt-2">
                                            <select name="ativo" id="ativo" value="<?= $ativo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-2 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
                                                <option value="" <?= ($ativo == '') ? 'selected' : null ?>>Insira a situação</option>
                                                <option value='1' <?= ($ativo == '1') ? 'selected' : null ?>>Ativo</option>
                                                <option value='0' <?= ($ativo == '0') ? 'selected' : null ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="py-2.5 px-5 text-sm font-medium text-white focus:outline-none bg-gray-500 rounded-lg border border-gray-200 hover:bg-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Filtrar</button>
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>

                <table class="w-full text-sm text-left rtl:text-right text-white">
                    <thead class="text-xs text-white uppercase bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Usuário
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nome
                            </th>
                            <th scope="col" class="px-6 py-3">
                                E-mail
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cargo
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Ativo
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                -
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($usuarios) > 0){
                                foreach($usuarios as $usuario){
                        ?>
                            <tr class="odd:bg-gray-100 even:bg-gray-300 border-b border-gray-400 text-gray-800">
                                <td class="px-6 py-4">
                                    <?= $usuario->usuario ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $usuario->nome ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $usuario->email ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $usuario->cargo ?>
                                </td>
                                <td class="px-6 py-4 text-<?= ($usuario->ativo == 1) ? 'green' : 'red' ?>-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mx-auto">
                                        <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                                    </svg>
                                </td>
                                <td class="px-6 py-4 flex gap-x-2 justify-center">
                                    <a href="/usuarios/<?= $usuario->uuid ?>/editar" class="font-medium text-white p-2 rounded-lg text-center bg-blue-400 hover:bg-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>
                                    <a href="/usuarios/<?= $usuario->uuid ?>/permissoes" data-modal-target="modal-permissoes-<?= $usuario->uuid ?>" data-modal-toggle="modal-permissoes-<?= $usuario->uuid ?>" class="font-medium text-white p-2 rounded-lg text-center bg-gray-400 hover:bg-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                                        </svg>
                                    </a>

                                    <button type="button" data-modal-target="popup-modal-<?= $usuario->uuid ?>" data-modal-toggle="popup-modal-<?= $usuario->uuid ?>" class="font-medium text-white p-2 rounded-lg text-center bg-red-400 hover:bg-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>

                                    <div id="popup-modal-<?= $usuario->uuid ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow-sm">
                                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-<?= $usuario->uuid ?>">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                </button>
                                                <div class="p-4 md:p-5 text-center">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-700">Deseja deletar esse usuário?</h3>
                                                    <h3 class="mb-5 text-sm font-normal text-gray-500"><?= $usuario->nome ?></h3>
                                                    <form action="/usuarios/<?= $usuario->uuid ?>/deletar" method="POST">
                                                        <button data-modal-hide="popup-modal-<?= $usuario->uuid ?>" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Não, cancelar</button>
                                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Deletar
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

<script>
    $(document).ready(function () {

        $.ajax({
            type: "GET",
            url: "/usuarios/<?= $usuario->uuid ?>/permissoes",
            dataType: "JSON",
            success: function(response) {
                var permissions = '';

                if (response && Array.isArray(response.permissoes) && response.permissoes.length > 0) {
                    response.permissoes.forEach(function(permissao) {
                        permissions += '<input type="checkbox" id="checkbox-'+permissao.id+'" value="'+permissao.id+'" />';
                    });

                    $('#form-user-permissions').html(permissions);
                }

                
            },
            error: function(error){
                console.error('Erro na requisição:', error);
            }
        });
    });
</script>