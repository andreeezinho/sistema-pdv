<div class="col-span-2">
    <label for="nome" class="block mb-1 text-sm font-medium text-gray-900">Nome</label>
    <input type="text" name="nome" id="nome" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $cliente->nome ?? null?>" />
</div>

<div class="col-span-2">
    <label for="email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
    <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $cliente->email ?? null?>" />
</div>

<div class="col-span-2">
    <label for="documento" class="block mb-1 text-sm font-medium text-gray-900">Doc. (CPF/CNPJ)</label>
    <input type="text" name="documento" id="documento" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $cliente->documento ?? null?>" />
</div>

<div class="col-span-2">
    <label for="telefone" class="block mb-1 text-sm font-medium text-gray-900">Telefone</label>
    <input type="text" name="telefone" step="0.01" id="telefone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $cliente->telefone ?? null?>" />
</div>

<div class="col-span-full">
    <label for="endereco" class="block mb-1 text-sm font-medium text-gray-900">Endereço</label>
    <input type="text" name="endereco" step="0.01" id="endereco" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $cliente->endereco ?? null?>" />
</div>

<div class="col-span-full">
    <label for="ativo" class="block text-sm/6 font-medium text-gray-900">Situação</label>
    <div class="">
        <select name="ativo" id="ativo" value="<?= $cliente->ativo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-3 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($cliente) && $cliente->ativo == '') ? 'selected' : null ?>>Insira a situação</option>
            <option value='1' <?= (isset($cliente) && $cliente->ativo == '1') ? 'selected' : null ?>>Ativo</option>
            <option value='0' <?= (isset($cliente) && $cliente->ativo == '0') ? 'selected' : null ?>>Inativo</option>
        </select>
    </div>
</div>