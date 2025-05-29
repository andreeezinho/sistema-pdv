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
            <img class="mx-auto h-10 w-auto" src="<?= LOGO ?>" alt="Site logo">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900"><?= SITE_NAME ?></h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autocomplete="email" required class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                        </div>
                    </div>
                    <div class="my-5">
                        <input type="password" name="password" id="password" autocomplete="current-password" required class="border-2 border-solid block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>