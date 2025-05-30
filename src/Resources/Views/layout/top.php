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

<body class="bg-neutral-100">
        
<header>
    <?php
        require_once('navbar.php');
    ?>
</header>

<section>
   <?php
      require_once('sidebar.php');
    ?>
</section>

<div class="p-4 sm:ml-64 min-h-[100dvh]">

         


