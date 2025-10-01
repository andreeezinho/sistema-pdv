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
                    <a href="/perfil" class="ms-1 text-sm font-medium text-gray-700 hover:text-gray-600 md:ms-2">Seu perfil</a>
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

    <?php
        if(isset($erro)){
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p class="m-0 p-0"><?= $erro ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        }
    ?>

    <h3 class="text-2xl text-center font-bold tracking-tight text-gray-900 mt-10">Seu perfil</h3>

    <div class="my-3 pt-3">
        <form action="/perfil/icone" method="POST" enctype="multipart/form-data">
            <div class="">
                <label for="icone" class="text-gray-600 flex flex-col text-center">
                    <div class="d-flex mb-3 relative mx-auto">
                        <img src="<?= URL_SITE ?>/public/img/user/icons/<?= ($usuario->icone == "default.png" || $usuario->icone == "") ? "default.png" : $usuario->icone ?>" alt="Icone de usuario" id="preview" class="bg-gray-400 cadastro-icone rounded-[50px] mx-auto hover-border">
                        <span class="absolute bottom-0 end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 bg-white rounded-[25px] p-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                        </span>
                    </div>
                    Insira uma foto de perfil
                </label>

                <input type="file" name="icone" id="icone" class="hidden">
            </div>

            <div class="text-center my-3">
                <button type="submit" class="bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Atualizar</button>
            </div>
        </form>
    </div>

    <div class="my-3 py-5">
        <h3 class="text-2xl font-bold tracking-tight text-gray-900 mt-10">Seus dados</h3>

        <form action="/perfil/editar" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-2 pt-2">
                <?php
                    require_once __DIR__ . '/../form.php';
                ?>
            </div>

            <div class="text-center my-3">
                <button type="submit" class="bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Atualizar</button>
            </div>
        </form>
    </div>

    <div class="my-3 py-5">
        <h3 class="text-2xl font-bold tracking-tight text-gray-900 mt-10">Nova senha</h3>

        <form action="/perfil/senha" method="POST" enctype="multipart/form-data">
            <div class="grid gap-2 pt-2 mx-auto">
                <div class="relative col-span-1">
                    <label for="senha" class="block mb-1 text-sm font-medium text-gray-900">Insira uma nova senha</label>
                    <input type="password" name="senha" id="senha" autocomplete="current-password" required class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 absolute top-9 right-5 hover:size-5 cursor-pointer" id="password-eye"">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
            </div>

            <div class="text-center my-3">
                <button type="submit" class="bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Atualizar</button>
            </div>
        </form>
    </div>
</div>

<?php
    require_once __DIR__ . '/../../layout/bottom.php';
?>