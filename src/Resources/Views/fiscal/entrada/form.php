<div class="col-span-full border-1 border-b border-gray-800 pb-4">
    <h3 class="text-gray-800 text-2xl mt-3">Inserir NF</h3>
    <h3 class="text-gray-500 text-sm mt-1">Insira um arquivo .xml <b>ou</b> a chave de acesso da NF</h3>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-2 w-full">
        <div class="mt-4 col-span-2">
            <label for="file" class="block mb-1 text-sm font-medium text-gray-900">Chave de acesso da NF</label>
            <input type="file" name="file" id="file" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-gray-600 focus:ring-gray-600 disabled:opacity-50 file:bg-gray-200 file:border-0 file:me-4 file:py-3 file:px-4 file:cursor-pointer cursor-pointer hover:file:bg-gray-300" />
        </div>

        <div class="mt-4 col-span-2">
            <label for="nome" class="block mb-1 text-sm font-medium text-gray-900">N° da NF</label>
            <input type="text" name="nome" id="nome" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
        </div>

        <div class="mt-2">
            <button type="button" id="searchNF" class="bg-gray-800 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Confirmar</button>
        </div>
    </div>
</div>

<div class="mt-4">
    <label for="nNF" class="block mb-1 text-sm font-medium text-gray-900">N° NF</label>
    <input type="number" name="nNF" id="nNF" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4 col-span-2">
    <label for="cNF" class="block mb-1 text-sm font-medium text-gray-900">Chave do Doc. Eletrônico</label>
    <input type="text" name="cNF" id="cNF" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="dhEmi" class="block mb-1 text-sm font-medium text-gray-900">Data Emissão</label>
    <input type="date" name="dhEmi" id="dhEmi" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vBC" class="block mb-1 text-sm font-medium text-gray-900">Base Cálc. ICMS</label>
    <input type="number" name="vBC" id="vBC" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vICMS" class="block mb-1 text-sm font-medium text-gray-900">Valor do ICMS</label>
    <input type="number" name="vICMS" id="vICMS" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vBCST" class="block mb-1 text-sm font-medium text-gray-900">Base Cálc. ICMS ST</label>
    <input type="number" name="vBCST" id="vBCST" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vST" class="block mb-1 text-sm font-medium text-gray-900">Valor ICMS ST</label>
    <input type="number" name="vST" id="vST" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vFCP" class="block mb-1 text-sm font-medium text-gray-900">Valor do FCP</label>
    <input type="number" name="vFCP" id="vFCP" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vFCPST" class="block mb-1 text-sm font-medium text-gray-900">Valor do FCP ST</label>
    <input type="number" name="vFCPST" id="vFCPST" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vProd" class="block mb-1 text-sm font-medium text-gray-900">Valor dos Produtos</label>
    <input type="number" name="vProd" id="vProd" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vFrete" class="block mb-1 text-sm font-medium text-gray-900">Valor do Frete</label>
    <input type="number" name="vFrete" id="vFrete" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vSeg" class="block mb-1 text-sm font-medium text-gray-900">Valor do Seguro</label>
    <input type="number" name="vSeg" id="vSeg" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vDesc" class="block mb-1 text-sm font-medium text-gray-900">Desconto Contábil</label>
    <input type="number" name="vDesc" id="vDesc" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vIPI" class="block mb-1 text-sm font-medium text-gray-900">Valor do IPI</label>
    <input type="number" name="vIPI" id="vIPI" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vCOFINS" class="block mb-1 text-sm font-medium text-gray-900">Valor do COFINS</label>
    <input type="number" name="vCOFINS" id="vCOFINS" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>

<div class="mt-4">
    <label for="vNF" class="block mb-1 text-sm font-medium text-gray-900">Total da NF</label>
    <input type="number" name="vNF" id="vNF" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
</div>