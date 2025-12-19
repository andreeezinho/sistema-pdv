<?php
    require_once __DIR__ . '/../layout/top.php';
?>

    <div class="p-4 rounded-lg mt-14">
        <div class="float-start">
            <button type="button" class="flex text-sm p-1 hover:bg-gray-300 rounded-sm" aria-expanded="false" data-dropdown-toggle="dropdown-sale">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm" id="dropdown-sale">
            <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900" role="none">
                    <b>Menu de Vendas</b>
                </p>
            </div>
            <ul class="py-1" role="none">
                <li>
                    <button type="button" id="diarias" class="w-full block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:hidden text-left" role="menuitem" data-modal-target="vendas-diarias" data-modal-toggle="vendas-diarias">Vendas do dia</button>
                </li>
                <li>
                    <button type="button" id="em-espera" class="w-full block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:hidden text-left" role="menuitem" data-modal-target="vendas-em-espera" data-modal-toggle="vendas-em-espera">Venda em espera</button>
                </li>
                <li>
                    <button type="button" id="selecao-intervalo" class="w-full block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:hidden text-left" role="menuitem" data-modal-target="intervalo" data-modal-toggle="intervalo">Intervalo</button>
                </li>
            </ul>
        </div>

        <div id="vendas-diarias" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-lg max-w-full max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="vendas-diarias">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <h3 class="mb-5 text-lg font-normal text-gray-700">Vendas do dia</h3>
                        
                        <table class="w-full text-sm text-left rtl:text-right text-white">
                            <thead class="text-xs text-white uppercase bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        N°
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Troco
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Hora
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
                                    if(count($vendas_diarias) > 0){
                                        foreach($vendas_diarias as $vendas_diaria){
                                ?>
                                    <tr class="odd:bg-gray-100 even:bg-gray-300 border-b border-gray-400 text-gray-800">
                                        <td class="px-6 py-4">
                                            <?= $vendas_diaria->id ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            R$ <?= number_format($vendas_diaria->total ?? 0,2,",",".") ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            R$ <?= number_format($vendas_diaria->troco ?? 0,2,",",".") ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= date('d/m/Y H:i', strtotime($vendas_diaria->created_at)) ?>
                                        </td>
                                        <td class="px-6 py-4 gap-x-2 justify-center text-<?= $vendas_diaria->situacao == 'concluida' ? 'green' : ($vendas_diaria->situacao == 'em andamento' ? 'yellow' : ($venda->situacao == 'em espera' ? 'gray' : 'red')) ?>-500 ">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mx-auto">
                                                <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                                            </svg>
                                        </td>
                                        <td class="px-6 py-4 flex gap-x-2 justify-center">
                                            <a href="/vendas/<?= $vendas_diaria->uuid ?>/visualizar" class="font-medium text-white p-2 rounded-lg text-center bg-blue-500 hover:bg-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                                                </svg>
                                            </a>
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
        </div>

        <div id="vendas-em-espera" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-lg max-w-full max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="vendas-em-espera">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <h3 class="mb-5 text-lg font-normal text-gray-700">Vendas em espera</h3>
                        
                        <table class="w-full text-sm text-left rtl:text-right text-white">
                            <thead class="text-xs text-white uppercase bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        N°
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Troco
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Data
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        -
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(count($vendas_suspensas) > 0){
                                        foreach($vendas_suspensas as $venda_suspensa){
                                ?>
                                    <tr class="odd:bg-gray-100 even:bg-gray-300 border-b border-gray-400 text-gray-800">
                                        <td class="px-6 py-4">
                                            <?= $venda_suspensa->id ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            R$ <?= number_format($venda_suspensa->total ?? 0,2,",",".") ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            R$ <?= number_format($venda_suspensa->troco ?? 0,2,",",".") ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= date('d/m/Y - H:i', strtotime($venda_suspensa->created_at)) ?>
                                        </td>
                                        <td class="px-6 py-4 flex gap-x-2 justify-center">
                                            <a href="/vendas/<?= $venda_suspensa->uuid ?>/liberar" class="font-medium text-white p-2 rounded-lg text-center bg-blue-500 hover:bg-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                                                </svg>
                                            </a>

                                            <button type="button" data-modal-target="popup-modal-<?= $venda_suspensa->uuid ?>" data-modal-toggle="popup-modal-<?= $venda_suspensa->uuid ?>" class="font-medium text-white p-2 rounded-lg text-center bg-red-400 hover:bg-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>

                                            <div id="popup-modal-<?= $venda_suspensa->uuid ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <div class="relative bg-white rounded-lg shadow-sm">
                                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-<?= $venda_suspensa->uuid ?>">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                        </button>
                                                        <div class="p-4 md:p-5 text-center">
                                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                            </svg>
                                                            <h3 class="mb-5 text-lg font-normal text-gray-700">Deseja cancelar esse venda?</h3>
                                                            <h3 class="mb-5 text-sm font-normal text-gray-500">Total: R$<?= number_format($venda_suspensa->total ?? 0,2,",",".") ?></h3>
                                                            <form action="/vendas/<?= $venda_suspensa->uuid ?>/cancelar" method="POST">
                                                                <button data-modal-hide="popup-modal-<?= $venda_suspensa->uuid ?>" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Não</button>
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
        </div>

        <div id="intervalo" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-lg max-w-full max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="intervalo">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                    <div class="p-10 md:p-5">
                        <div class="p-8">
                            <h3 class="mb-10 text-lg font-normal text-gray-700 text-center">Selecione um Intervalo</h3>
                        
                            <div class="w-full flex flex-col md:flex-row gap-2 mb-10">
                                <button type="button" id="" value="5" class="intervalo-button border-hidden bg-gray-800 px-3 py-2 rounded-lg text-white font-semibold flex gap-x-1 hover:bg-gray-500">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
                                    </svg>
                                    Banheiro
                                </button>

                                <button type="button" id="" value="60" class="intervalo-button border-hidden bg-gray-800 px-3 py-2 rounded-lg text-white font-semibold flex gap-x-1 hover:bg-gray-500">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5.00001 4.00003c-.55229 0-1 .44772-1 1 0 .55229.44771 1 1 1h1c.55228 0 1-.44771 1-1 0-.55228-.44772-1-1-1h-1Zm5.66889 1.39531c-.2216-.27879-.645-.61839-.94433-.83763-.16499-.12086-.34155-.24116-.49677-.33129-.072-.04181-.17435-.09779-.28569-.14043-.05091-.0195-.15457-.05642-.2853-.07202-.07757-.00926-.47279-.05405-.81565.25599-.28283.25575-.32408.57239-.33352.663-.01301.12501-.0017.22937.00606.28539.0164.11839.04792.22824.0723.30499.05229.16466.12863.35151.20939.5288.15481.33984.39005.78485.63096 1.08802.16417.20658.53268.55501.87921.85987-.34653.30486-.71505.65329-.87921.85988-.24091.30316-.47615.74817-.63096 1.08801-.08076.17728-.1571.36418-.20939.52878-.02438.0768-.0559.1866-.0723.305-.00776.056-.01907.1604-.00606.2854.00944.0906.05069.4072.33352.663.34286.31.73807.2653.81565.256.13073-.0156.23439-.0525.2853-.072.11134-.0427.21369-.0986.28569-.1405.15522-.0901.33178-.2104.49677-.3313.29933-.2192.72273-.5588.94433-.8376.1753-.2206.5103-.74026.773-1.18533.082-.13908.1641-.28267.2378-.41934h1.1367c-.2032.28993-.3943.65733-.5267.94787-.0807.1773-.1571.3642-.2094.5288-.0243.0768-.0559.1866-.0723.305-.0077.056-.019.1604-.006.2854.0094.0906.0507.4072.3335.663.3429.31.7381.2652.8156.256.1308-.0156.2344-.0525.2853-.072.1114-.0427.2137-.0987.2857-.1405.1552-.0901.3318-.2104.4968-.3313.2993-.2192.7228-.5588.9443-.8376.1754-.2207.5103-.74026.773-1.18532.0821-.13908.1641-.28267.2378-.41935h.6424c-.2032.28993-.3943.65733-.5267.94787-.0807.1773-.1571.3642-.2094.5288-.0243.0768-.0559.1866-.0723.305-.0077.056-.019.1604-.006.2854.0094.0906.0507.4072.3335.663.3429.31.7381.2652.8156.256.1308-.0156.2344-.0525.2853-.072.1114-.0427.2137-.0987.2857-.1405.1552-.0901.3318-.2104.4968-.3313.2993-.2192.7228-.5588.9443-.8376.1754-.2207.5103-.74026.773-1.18532.0821-.13908.1641-.28267.2378-.41935h.8261c.5522 0 1-.44772 1-1s-.4478-1-1-1h-.8261c-.0737-.13668-.1557-.28027-.2378-.41935-.2627-.44506-.5976-.96467-.773-1.18532-.2215-.27879-.645-.61839-.9443-.83763-.165-.12086-.3416-.24117-.4968-.33129-.072-.04182-.1743-.09779-.2857-.14044-.0509-.0195-.1545-.05642-.2853-.07202-.0775-.00926-.4727-.05404-.8156.25599-.2828.25575-.3241.57239-.3335.66301-.013.125-.0017.22936.006.28538.0164.1184.048.22824.0723.30499.0523.16466.1287.35151.2094.52881.1324.29054.3235.65794.5267.94787h-.6424c-.0737-.13667-.1557-.28026-.2378-.41935-.2627-.44506-.5976-.96467-.773-1.18532-.2215-.27879-.645-.61839-.9443-.83763-.165-.12086-.3416-.24117-.4968-.33129-.072-.04182-.1743-.09779-.2857-.14044-.0509-.0195-.1545-.05642-.2853-.07202-.0775-.00926-.4727-.05404-.8156.25599-.2828.25576-.3241.57239-.3335.66301-.013.125-.0017.22936.006.28538.0164.1184.048.22824.0723.305.0523.16465.1287.3515.2094.5288.1324.29054.3235.65795.5267.94787h-1.1367c-.0737-.13668-.1558-.28027-.2378-.41936-.2627-.44506-.5977-.96467-.773-1.18533Z"/>
                                        <path fill="currentColor" d="M3.00001 7.00003c-.55229 0-1 .44772-1 1 0 .55229.44771 1 1 1h4c.55228 0 1-.44771 1-1 0-.55228-.44772-1-1-1h-4Zm2 2.99997c-.55229 0-1 .4477-1 1s.44771 1 1 1h1c.55228 0 1-.4477 1-1s-.44772-1-1-1h-1Zm-2 3c-.30399 0-.59147.1383-.78123.3758-.18976.2375-.2612.5484-.19413.8449.27848 1.231 1.1312 2.2553 2.23009 3.035.92161.6539 2.06605 1.1737 3.34395 1.5346V19c0 .5523.44772 1 1 1h6.80261c.5523 0 1-.4477 1-1v-.2097c1.2779-.3609 2.4224-.8807 3.344-1.5346 1.0989-.7797 1.9516-1.804 2.2301-3.035.067-.2965-.0044-.6074-.1942-.8449C21.5915 13.1383 21.304 13 21 13H3.00001Z"/>
                                    </svg>
                                    Almoço
                                </button>

                                <button type="button" id="" value="10" class="intervalo-button border-hidden bg-gray-800 px-3 py-2 rounded-lg text-white font-semibold flex gap-x-1 hover:bg-gray-500">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M15.0524 2.01283c-.2634-.00221-.7706-.00646-1.3064.08808-.6053.10681-1.377.35866-1.975.99279-.557.59067-.8308 1.31504-.9706 1.92248-.1413.61388-.1628 1.1828-.1628 1.5327v1h1c.0429 0 .0873.00018.1333.00036.8172.00329 2.1026.00847 3.2375-.9589.7023-.59862.9572-1.43277 1.059-2.06861.0871-.54385.0798-1.08153.0758-1.37798-.0007-.051-.0013-.09486-.0013-.13038v-1h-1c-.0255 0-.0554-.00025-.0895-.00054Zm-3.0525 7.02912c-.2934 0-.3974-.0566-.7263-.23555-.1027-.05589-.2273-.12372-.3865-.20548-.6797-.34907-1.55211-.64467-3.12486-.59552-1.30968.04093-2.37715.88151-3.01521 2.0359-.64078 1.1594-.90215 2.7005-.65499 4.4145.1543 1.07.66239 2.84 1.39644 4.358.36735.7596.81762 1.5119 1.34963 2.0895C7.35502 21.4646 8.08053 22 8.99163 22c1.17857 0 1.86287-.2589 2.38977-.5504.1663-.092.2761-.1558.3523-.2001.1161-.0674.1542-.0895.1949-.0968.0198-.0035.0403-.0035.0708-.0035.0105 0 .0195-.0003.0268-.0005.0132-.0003.0222-.0006.031.0009.0193.0032.0373.0146.095.0514.0638.0408.1761.1125.3925.2382.5319.3091 1.2263.5608 2.4635.5608.9293 0 1.6712-.5145 2.2105-1.0909.5456-.5832.9936-1.3421 1.3526-2.1048.7186-1.5268 1.1845-3.2947 1.3365-4.3485.2471-1.714-.0142-3.2551-.655-4.4145-.6381-1.15439-1.7055-1.99497-3.0152-2.0359-1.5728-.04915-2.4451.24645-3.1248.59552-.1592.08176-.2839.14959-.3866.20548-.3289.17895-.4329.23555-.7263.23555Z"/>
                                    </svg>
                                    Lanche
                                </button>

                                <button type="button" id="" value="5" class="intervalo-button border-hidden bg-gray-800 px-3 py-2 rounded-lg text-white font-semibold flex gap-x-1 hover:bg-gray-500">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M7 2a2 2 0 0 0-2 2v1a1 1 0 0 0 0 2v1a1 1 0 0 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H7Zm3 8a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm-1 7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3 1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                                    </svg>
                                    Feedback
                                </button>

                                <button type="button" id="" value="10" class="intervalo-button border-hidden bg-gray-800 px-3 py-2 rounded-lg text-white font-semibold flex gap-x-1 hover:bg-gray-500">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                                    </svg>
                                    Reunião
                                </button>
                            </div>

                            <div class="text-center mt-5 text-3xl text-neutral-600 font-semibold py-5" id="demo"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <h3 class="text-2xl text-center font-bold tracking-tight text-gray-900">Venda em aberto</h3>

        <div class="flex w-[100%] bg-neutral-50 mt-2 p-3 gap-x-2">
            <div class="w-2/3 min-h-[80dvh] max-h-[80dvh] overflow-y-scroll p-2 border border-r border-gray-400">
                <table class="w-full text-sm text-left rtl:text-right text-white">
                    <thead class="text-xs text-white uppercase bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Produto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Código
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tipo
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Quant.
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Total
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                -
                            </th>
                        </tr>
                    </thead>

                    <tbody class="">
                        <?php
                            if(count($produtos) > 0){
                                foreach($produtos as $produto){
                        ?>
                            <tr class="odd:bg-gray-100 even:bg-gray-300 border-b border-gray-400 text-gray-800">
                                <td class="px-6 py-4"><?= $produto->nome ?></td>
                                <td class="px-6 py-4"><?= $produto->codigo ?></td>
                                <td class="px-6 py-4"><?= strtoupper($produto->tipo) ?></td>
                                <td class="px-6 py-4 text-center"><?= $produto->quantidade ?></td>
                                <td class="px-6 py-4 text-center">R$ <?=  number_format(($produto->preco * $produto->quantidade) ?? 0,2,",",".") ?></td>
                                <td class="px-6 py-4 text-center">
                                    <form action="/pdv/<?= $venda->uuid ?>/remover/<?= $produto->uuid ?>" method="POST" class="text-center">
                                        <button type="button" class="float-end bg-red-300 hover:bg-red-500 text-white font-bold py-2 px-4 rounded" data-modal-target="popup-modal-<?= $produto->uuid ?>" data-modal-toggle="popup-modal-<?= $produto->uuid ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>

                                        <div id="popup-modal-<?= $produto->uuid ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow-sm">
                                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-<?= $produto->uuid ?>">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                        </svg>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Deseja realmente remover o produto?</h3>
                                                        <button data-modal-hide="popup-modal-<?= $produto->uuid ?>" type="button" class="text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Não
                                                        </button>
                                                        <button type="submit" class="py-2.5 px-5 bg-red-600 hover:bg-red-800 ms-3 text-sm font-medium text-white focus:outline-none rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100">Sim</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col gap-y-2 w-1/3 min-h-[80dvh] p-2">
                <div class="flex h-3/4 p-3">
                    <img src="<?= COLORED_LOGO ?>" alt="Logo Site" class="m-auto w-[70%]">
                </div>

                <div class="h-2/4 p-3 pt-8">
                        <div class="grid gap-2 grid-cols-2">
                            <div>
                                <label for="codigo" class="block mb-1 text-sm font-medium text-gray-900">Código</label>
                                <div class="flex border border-gray-300 rounded-lg">
                                    <form action="/pdv/<?= $venda->uuid ?>/adicionar" method="POST">
                                        <input type="number" name="codigo" id="codigo" autofocus class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:outline-none block w-full p-2.5" required />
                                        <input type="number" name="quantidade" id="quantidade" min="1" max="1000" step="any" class="hidden" value="1" />
                                        <button type="submit" name="btn-form" id="btn-form" class="hidden"></button>
                                    </form>
                                    <button type="button" class="bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded" data-modal-target="pesquisar" data-modal-toggle="pesquisar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                        </svg>
                                    </button>

                                    <div id="pesquisar" tabindex="-1" class="hidden w-1/2 mx-auto overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-h-full">
                                            <div class="relative bg-white rounded-lg shadow-sm">
                                                <button type="button" id="drop-modal" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="pesquisar">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                </button>
                                                <div class="p-4 md:p-5 text-center">
                                                    <h3 class="mb-5 text-lg font-normal text-gray-700">Pesquisar produto</h3>

                                                    <div class="flex flex-col p-4 w-full">
                                                        <div class="flex border border-gray-300 rounded-lg mb-5">
                                                            <input type="text" name="search" id="search" placeholder="Insira o nome ou código do produto" class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:outline-none block w-full p-2.5" />
                                                            <button type="button" id="search-button" class="bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <table class="w-full text-sm text-left rtl:text-right text-white">
                                                                <thead class="text-xs text-white uppercase bg-gray-800">
                                                                    <tr>
                                                                        <th scope="col" class="px-6 py-3">
                                                                            Nome
                                                                        </th>
                                                                        <th scope="col" class="px-6 py-3">
                                                                            Código
                                                                        </th>
                                                                        <th scope="col" class="px-6 py-3 text-center">
                                                                            Estoque
                                                                        </th>
                                                                        <th scope="col" class="px-6 py-3 text-center">
                                                                            Tipo
                                                                        </th>
                                                                        <th scope="col" class="px-6 py-3 text-center">
                                                                            -
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="products_table"></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="quantidade-placehoder" class="block mb-1 text-sm font-medium text-gray-900">Quant.</label>
                                <input type="number" name="quantidade-placehoder" id="quantidade-placehoder" min="0" max="1000" step="any" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="1" />
                            </div>

                            <!-- <div>
                                <label for="desconto" class="block mb-1 text-sm font-medium text-gray-900">Desconto</label>
                                <input type="number" name="desconto" id="desconto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value=0 />
                            </div> -->
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" id="button-placeholder" class="w-full bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Adicionar</button>
                        </div>
                </div>

                <div class="h-1/6 p-3">
                    <h1 class="text-4xl text-center text-gray-700">Total a pagar: <b>R$ <?= number_format(($total) ?? 0,2,",",".") ?></b></h1>
                    <div class="flex gap-x-2 justify-center mt-3">
                        <form action="/pdv/<?= $venda->uuid ?>/cancelar" method="POST">
                            <button type="button" class="flex w-full bg-gray-300 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded" data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 pr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                Cancelar
                            </button>

                            <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm">
                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Deseja realmente cancelar a venda?</h3>
                                            <button data-modal-hide="popup-modal" type="button" class="text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Não
                                            </button>
                                            <button type="submit" class="py-2.5 px-5 bg-red-600 hover:bg-red-800 ms-3 text-sm font-medium text-white focus:outline-none rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100">Sim</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div>
                            <a href="/pdv/<?= $venda->uuid ?>/finalizar" class="flex w-full bg-lime-300 hover:bg-lime-500 text-white font-bold py-2 px-4 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 pr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                Finalizar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once __DIR__ . '/../layout/bottom.php';
?>

<script>
    $(document).ready(function () {

        $("#quantidade-placehoder").on('input', function(){
            let quant = $(this).val();

            $("#quantidade").val(quant);
        });

        $("#codigo").keypress(function(event){
            if(event.witch === 13){
                $("#btn-form").click();
            }
        });

        $("#button-placeholder").on('click', function(){
            $("#btn-form").click();
        });

        $('#diarias').click(function (e) {
            $('#dropdown-sale').removeClass("block");

            $('#dropdown-sale').addClass("hidden");
        });

        $('#em-espera').click(function (e) {
            $('#dropdown-sale').removeClass("block");

            $('#dropdown-sale').addClass("hidden");
        });

        $('#selecao-intervalo').click(function (e) {
            $('#dropdown-sale').removeClass("block");

            $('#dropdown-sale').addClass("hidden");
        });

        $(".intervalo-button").on("click", function(){
            //$(".intervalo-button").hide();
            var countDownDate = new Date().getTime() + (parseInt($(this).val(), 10) * 60 * 1000)

            var x = setInterval(function() {
                var now = new Date().getTime();

                var distance = countDownDate - now;

                var days    = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                if (distance < 1) {
                    $('#demo').text('');
                } else if (days > 0) {
                    $('#demo').text(
                        hours + "h " + minutes + "m " + seconds + "s"
                    );
                } else if (hours == 0 && minutes == 0) {
                    $('#demo').text(
                        seconds + "s"
                    );
                } else if (hours == 0) {
                    $('#demo').text(
                        minutes + "m " + seconds + "s"
                    );
                } else {
                    $('#demo').text(
                        hours + "h " + minutes + "m " + seconds + "s"
                    );
                }
            }, 1000);
        });

        $('#products_table').hide();

        $('#search-button').on('click', function() {
            var data = $('#search').val();

            $.ajax({
                type: "GET",
                url: "/produtos-api",
                data: {nome_codigo: data},
                dataType: "JSON",
                success: function(response) {
                    var suggestions = '';

                    if (response && Array.isArray(response) && response.length > 0) {
                        response.forEach(function(produto) {
                            suggestions += '<tr class="odd:bg-gray-100 even:bg-gray-300 border-b border-gray-400 text-gray-800">'
                            suggestions += '    <td class="px-6 py-4">'
                            suggestions +=          produto.nome
                            suggestions += '    </td>'
                            suggestions += '    <td class="px-6 py-4">'
                            suggestions +=          produto.codigo
                            suggestions += '    </td>'
                            suggestions += '    <td class="px-6 py-4 text-center">'
                            suggestions +=          produto.estoque
                            suggestions += '    </td>'
                            suggestions += '    <td class="px-6 py-4 text-center">'
                            suggestions +=          produto.tipo
                            suggestions += '    </td>'
                            suggestions += '    <td class="px-6 py-4 text-center">'
                            suggestions += '        <button type="button" data-codigo="'+produto.codigo+'" class="product-button bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">'
                            suggestions += '            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">'
                            suggestions += '                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />'
                            suggestions += '            </svg>'
                            suggestions += '        </button>'
                            suggestions += '    </td>'
                            suggestions += '</tr>'
                        });

                        $('#products_table').html(suggestions).show();

                        $('.product-button').on('click', function(){
                            let codigo = $(this).data('codigo');

                            $('#codigo').val(codigo);
                            $('#drop-modal').click();
                            $('#codigo').focus();
                        });
                    }else{
                        suggestions += '<p class="w-full text-gray-500 text-md mt-5">Nenhum produto encontrado</p>'

                        $('#products_table').html(suggestions).show();
                    }
                },
                error: function(error){
                    console.error('Erro na requisição:', error);
                }
            });
        });
        
    });
</script>