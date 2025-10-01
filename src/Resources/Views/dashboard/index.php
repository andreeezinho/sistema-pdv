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
            <a href="/usuarios" class="block max-w-sm p-6 bg-white border border-gray-400 rounded-lg shadow-md hover:bg-gray-50 hover:shadow-lg">
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

            <a href="/produtos" class="block max-w-sm p-6 bg-white border border-gray-400 rounded-lg shadow-md hover:bg-gray-50 hover:shadow-lg">
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

            <a href="/vendas" class="block max-w-sm p-6 bg-white border border-gray-400 rounded-lg shadow-md hover:bg-gray-50 hover:shadow-lg">
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

            <a href="/vendas" class="block max-w-sm p-6 bg-white border border-gray-400 rounded-lg shadow-md hover:bg-gray-50 hover:shadow-lg">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>


                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Faturamento do dia</h5>
                </div>
                <?php
                    if(!is_null($faturamento)){
                ?>
                    <p class="font-normal text-gray-700">R$ <?= number_format($faturamento['faturamento'] ?? 0,2,",",".") ?></p>
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
            <div class="flex mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2 my-auto">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                <h3 class="text-2xl font-bold tracking-tight text-gray-900">Últimas vendas</h3>
            </div>

            <div class="h-[55dvh] overflow-y-scroll">
                <table class="w-full text-sm text-left rtl:text-right text-white">
                    <thead class="text-xs text-white uppercase bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nome
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Código
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tipo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Troco
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($last_sales) > 0){
                                foreach($last_sales as $venda){
                        ?>
                            <tr class="odd:bg-gray-100 even:bg-gray-300 border-b border-gray-400 text-gray-800">
                                <td class="px-6 py-4">
                                    <?= $venda->id ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $venda->desconto ?>
                                </td>
                                <td class="px-6 py-4">
                                    R$ <?= number_format($venda->preco ?? 0,2,",",".") ?>
                                </td>
                                <td class="px-6 py-4">
                                    R$ <?= number_format($venda->troco ?? 0,2,",",".") ?>
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

        <div class="flex flex-col bg-neutral-50 p-2 rounded-lg mt-5 w-1/2">
            <div class="rounded-lg w-[100%] h-2/3 flex gap-x-2">
                <div class="p-4 flex flex-col mb-2 w-1/2 bg-white">
                    <h3 class="text-2xl font-bold tracking-tight text-gray-900 mb-3">Vendas diárias</h3>

                    <div class="bg-neutral-50 border border-gray-300 max-w-sm w-full rounded-lg shadow-sm p-4 md:p-6 shadow shadow-lg mx-auto">
                        <div class="flex justify-between">
                            <div>
                                <h5 class="leading-none text-3xl font-bold text-gray-900 pb-2"><?= $total_last_sales['total_vendas'] ?></h5>
                                <p class="text-base font-normal text-gray-500">Vendas nos últimos 3 dias</p>
                            </div>
                            <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-center">
                                <?php
                                    if($daily_sales['hoje']['concluida']['vendas_diarias'] > $daily_sales['ontem']['concluida']['vendas_diarias']){
                                ?>
                                    <svg class="w-5 h-5 ms-1 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4"/>
                                    </svg>

                                <?php
                                    }

                                    if($daily_sales['hoje']['concluida']['vendas_diarias'] < $daily_sales['ontem']['concluida']['vendas_diarias']){
                                ?>
                                    <svg class="w-5 h-5 ms-1 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19V5m0 14-4-4m4 4 4-4"/>
                                    </svg>
                                <?php
                                    }

                                    if($daily_sales['hoje']['concluida']['vendas_diarias'] == $daily_sales['ontem']['concluida']['vendas_diarias']){
                                ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ms-1 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.499 8.248h15m-15 7.501h15" />
                                    </svg>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <div id="data-series-chart"></div>
                        <div class="grid grid-cols-1 items-center border-gray-200 border-t justify-between mt-5">
                            <div class="flex justify-between items-center pt-3">
                                <a
                                    href="/vendas"
                                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 hover:bg-gray-100 px-3 py-2">
                                    Ver vendas
                                    <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 flex flex-col mb-2 w-1/2 bg-white">
                    <h3 class="text-2xl font-bold tracking-tight text-gray-900 mb-3">Usuários Conectados</h3>

                    <div class="bg-neutral-50 border border-gray-300 max-w-sm w-full h-full max-h-[380px] rounded-lg shadow-sm md:px-6 md:py-2 shadow shadow-lg mx-auto overflow-y-scroll">
                        <ul class="max-w-md divide-y divide-gray-200">
                            <li class="py-3 sm:pb-4">
                                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                    <div class="shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="/public/img/user/icons/default.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                        André Adm
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                        Em Serviço
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mx-auto">
                                            <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </li>

                            <li class="py-3 sm:pb-4">
                                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                    <div class="shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="/public/img/user/icons/default.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                        Maria Luiza
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                        Banheiro
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mx-auto">
                                            <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </li>

                            <li class="py-3 sm:pb-4">
                                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                    <div class="shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="/public/img/user/icons/default.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                        Poliana Pimentel
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                        Em Serviço
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mx-auto">
                                            <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="bg-white p-2 rounded-lg w-[100%] h-1/3 flex items-center">
                <div class="bg-neutral-50 border border-gray-300 w-full rounded-lg shadow-sm p-4 md:p-6 shadow shadow-lg mx-auto">
                    <div class="flex justify-between">
                        <div class="w-full flex justify-between items-center text-base font-semibold">
                            <h3 class="text-2xl font-bold tracking-tight text-gray-900 mb-3">Faturamento</h3>
                            <?php
                                if($daily_invoice['hoje']['concluida']['faturamento'] > $daily_invoice['ontem']['concluida']['faturamento']){
                            ?>
                                <svg class="w-5 h-5 ms-1 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4"/>
                                </svg>
                            <?php
                                }

                                if($daily_invoice['hoje']['concluida']['faturamento'] < $daily_invoice['ontem']['concluida']['faturamento']){
                            ?>
                                <svg class="w-5 h-5 ms-1 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19V5m0 14-4-4m4 4 4-4"/>
                                </svg>
                            <?php
                                }

                                if($daily_invoice['hoje']['concluida']['faturamento'] == $daily_invoice['ontem']['concluida']['faturamento']){
                            ?>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ms-1 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.499 8.248h15m-15 7.501h15" />
                                </svg>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div id="invoicing-chart"></div>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once __DIR__ . '/../layout/bottom.php';
?>

<script>
    const sales = {
        series: [
        {
            name: "Vendas Finalizadas",
            data: [<?= $daily_sales['anteontem']['concluida']['vendas_diarias'] ?>, <?= $daily_sales['ontem']['concluida']['vendas_diarias'] ?>, <?= $daily_sales['hoje']['concluida']['vendas_diarias'] ?>],
            color: "#62a766ff",
        },
        {
            name: "Vendas Canceladas",
            data: [<?= $daily_sales['anteontem']['cancelada']['vendas_diarias'] ?>, <?= $daily_sales['ontem']['cancelada']['vendas_diarias'] ?>, <?= $daily_sales['hoje']['cancelada']['vendas_diarias'] ?>],
            color: "#aa5050ff",
        },
        {
            name: "Vendas em Espera",
            data: [<?= $daily_sales['anteontem']['em espera']['vendas_diarias'] ?>, <?= $daily_sales['ontem']['em espera']['vendas_diarias'] ?>, <?= $daily_sales['hoje']['em espera']['vendas_diarias'] ?>],
            color: "#7c7c7cff",
        },
        ],
        chart: {
            height: "52%",
            maxWidth: "100%",
            type: "area",
            fontFamily: "Inter, sans-serif",
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        tooltip: {
            enabled: true,
            x: {
                show: false,
            },
        },
        legend: {
            show: false
        },
        fill: {
            type: "gradient",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 3,
        },
        grid: {
            show: false,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: 0
            },
        },
        xaxis: {
            categories: ['Anteontem', 'Ontem', 'Hoje'],
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: false,
            labels: {
                formatter: function (value) {
                    return value;
                }
            }
        },
    }

    if (document.getElementById("data-series-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("data-series-chart"), sales);
        chart.render();
    }

    const invoicing = {
        series: [
            {
                name: "Faturamento",
                data: [
                    <?= $daily_invoice['5']['concluida']['faturamento'] ?? 0 ?>, 
                    <?= $daily_invoice['4']['concluida']['faturamento'] ?? 0 ?>, 
                    <?= $daily_invoice['anteontem']['concluida']['faturamento'] ?? 0 ?>, 
                    <?= $daily_invoice['ontem']['concluida']['faturamento'] ?? 0 ?>, 
                    <?= $daily_invoice['hoje']['concluida']['faturamento'] ?? 0 ?>
                ],
                color: "#1f2937",
            }
        ],
        chart: {
            height: "52%",
            maxWidth: "100%",
            type: "area",
            fontFamily: "Inter, sans-serif",
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        tooltip: {
            enabled: true,
            x: {
                show: false,
            },
        },
        legend: {
            show: false
        },
        fill: {
            type: "gradient",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 3,
        },
        grid: {
            show: false,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: 0
            },
        },
        xaxis: {
            categories: ['<?= date('d/m', strtotime('-4 day')) ?>', '<?= date('d/m', strtotime('-3 day')) ?>', 'Anteontem', 'Ontem', 'Hoje'],
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: false,
            labels: {
                formatter: function (value) {
                    return value.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
                }
            }
        },
    }

    if (document.getElementById("invoicing-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("invoicing-chart"), invoicing);
        chart.render();
    }
</script>