<div class="mt-4 col-span-2">
    <label for="razao_social" class="block mb-1 text-sm font-medium text-gray-900">Razão Social</label>
    <input type="text" name="razao_social" id="razao_social" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $fornecedor->razao_social ?? null ?>" />
</div>

<div class="mt-4 col-span-2">
    <label for="nome_fantasia" class="block mb-1 text-sm font-medium text-gray-900">Nome Fantasia</label>
    <input type="text" name="nome_fantasia" id="nome_fantasia" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $fornecedor->nome_fantasia ?? null ?>" />
</div>

<div class="mt-4 col-span-2">
    <label for="documento" class="block mb-1 text-sm font-medium text-gray-900">Documento</label>
    <input type="text" name="documento" id="documento" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $fornecedor->documento ?? null ?>" />
</div>

<div class="mt-4 col-span-1">
    <label for="ie_rg" class="block mb-1 text-sm font-medium text-gray-900">Inscrição Estadual</label>
    <input type="text" name="ie_rg" id="ie_rg" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $fornecedor->ie_rg ?? null ?>" />
</div>

<div class="mt-4 col-span-1">
    <label for="num_serie_nfe" class="block mb-1 text-sm font-medium text-gray-900">N° Série NFe</label>
    <input type="text" name="num_serie_nfe" id="num_serie_nfe" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $fornecedor->num_serie_nfe ?? null ?>" />
</div>

<div class="mt-4 col-span-1">
    <label for="enderecos_id" class="block mb-1 text-sm font-medium text-gray-900">Endereço</label>
    <input type="number" name="enderecos_id" id="enderecos_id" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $fornecedor->enderecos_id ?? null ?>" />
</div>

<div class="mt-4">
    <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Situação</label>
    <div class="">
        <select name="ativo" id="ativo" value="<?= $fornecedor->ativo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-3 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($fornecedor) && $fornecedor->ativo == '') ? 'selected' : null ?>>Insira a situação</option>
            <option value='1' <?= (isset($fornecedor) && $fornecedor->ativo == '1') ? 'selected' : null ?>>Ativo</option>
            <option value='0' <?= (isset($fornecedor) && $fornecedor->ativo == '0') ? 'selected' : null ?>>Inativo</option>
        </select>
    </div>
</div>