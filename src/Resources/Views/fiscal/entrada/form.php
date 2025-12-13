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
    <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Situação</label>
    <div class="">
        <select name="ativo" id="ativo" value="<?= $entrada->ativo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-3 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($entrada) && $entrada->ativo == '') ? 'selected' : null ?>>Insira a situação</option>
            <option value='1' <?= (isset($entrada) && $entrada->ativo == '1') ? 'selected' : null ?>>Ativo</option>
            <option value='0' <?= (isset($entrada) && $entrada->ativo == '0') ? 'selected' : null ?>>Inativo</option>
        </select>
    </div>
</div>