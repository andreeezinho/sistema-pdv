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
                        <a href="/usuarios" class="ms-1 text-sm font-medium text-gray-700 hover:text-gray-600 md:ms-2"><?= $usuario->usuario ?></a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-700 hover:text-gray-600 md:ms-2">Permissões</span>
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
            <h3 class="text-2xl mb-2 ml-1">Atalhos</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-2 mb-10 pb-3 border-b border-gray-300"> 
                <label for="all-checkbox" class="flex p-2 rounded-md bg-gray-100 hover:cursor-pointer hover:bg-gray-200">
                    <span>Selecionar Todos</span>
                    <input 
                        type="checkbox"
                        name="permissions[]" 
                        id="all-checkbox"
                        class="float-right ml-auto accent-gray-800"
                    />
                </label>

                <label for="remove-all-checkbox" class="flex p-2 rounded-md bg-gray-100 hover:cursor-pointer hover:bg-gray-200">
                    <span>Remover Todos</span>
                    <input 
                        type="checkbox"
                        name="permissions[]" 
                        id="remove-all-checkbox"
                        class="float-right ml-auto accent-gray-800"
                    />
                </label>
            </div>

            <form action="/usuarios/<?= $usuario->uuid ?>/vincular" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-2" id="checkbox-container">
                    <?php
                        if(count($permissoes) > 0){
                            foreach($permissoes as $permissao){
                    ?>
                        <label for="permissao-<?= $permissao->uuid ?>" class="flex p-2 rounded-md bg-gray-100 hover:cursor-pointer hover:bg-gray-200">
                            <span><?= $permissao->nome ?></span>
                            <input 
                                type="checkbox" 
                                <?= userPermissionChecked($permissao->id, $permissao_user) ? 'checked' : '' ?>
                                name="permissions[]" 
                                id="permissao-<?= $permissao->uuid ?>" 
                                value="<?= $permissao->id ?>" 
                                class="float-right ml-auto accent-gray-800"
                            />
                        </label>
                    <?php
                            }
                        }else{
                    ?>
                        <p>Usuário não tem permissões vinculadas</p>
                    <?php
                        }
                    ?>
                </div>
                <div class="text-right mt-10">
                    <a href="/usuarios" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2.5 px-4 rounded">Cancelar</a>
                    <button type="submit" class="bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
<?php
    require_once __DIR__ . '/../../layout/bottom.php';
?>

<script>
    $(document).ready(function () {

        $("#all-checkbox").on("change", function(){
            if($(this).is(":checked")){
                $("#checkbox-container input[type=checkbox]").prop("checked", true);
            }else{
                $("#checkbox-container input[type=checkbox]").prop("checked", false);
            }
        });

        $("#remove-all-checkbox").on("click", function(){
            $("#checkbox-container input[type=checkbox]").prop("checked", false);
        });
        
    });
</script>