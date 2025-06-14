<!DOCTYPE html>
<html lang="pt-br" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= URL_SITE ?>/public/img/site/logo.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= URL_SITE ?>/public/css/style.css">
    <title><?= SITE_NAME ?></title>
</head>

<body class="h-full bg-neutral-100">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 items-center">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-12 w-auto" src="<?= COLORED_LOGO ?>" alt="Site logo">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900"><?= SITE_NAME ?></h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <?php
                if(isset($erro)){
            ?>
                <div id="alert-additional-content-2" class="p-4 mb-4 text-red-800 border border-red-100 rounded-lg bg-red-50" role="alert">
                    <div class="flex items-center">
                        <svg class="shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <?= $erro ?>
                    </div>
                </div>
            <?php   
                }
            ?>

            <form class="space-y-6" action="/login" method="POST">
                <div>
                    <label for="usuario" class="block text-sm/6 font-medium text-gray-900">Usuário</label>
                    <div class="mt-2">
                        <input type="text" name="usuario" id="usuario" required value="<?= $usuario ?? null ?>" class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="senha" class="block text-sm/6 font-medium text-gray-900">Senha</label>
                    </div>
                    <div class="relative">
                        <input type="password" name="senha" id="senha" autocomplete="current-password" required class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 absolute top-3 right-5 hover:size-5 cursor-pointer" id="password-eye"">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                    <div class="text-sm mt-3">
                        <a href="/recuperar-senha" class="font-semibold text-indigo-400 hover:text-indigo-500">Esqueceu sua senha?</a>
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-400 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= URL_SITE ?>/public/js/script.js"></script>
</body>
</html>