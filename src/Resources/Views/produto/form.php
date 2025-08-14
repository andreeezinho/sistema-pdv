<div class="col-span-2">
    <label for="nome" class="block mb-1 text-sm font-medium text-gray-900">Nome</label>
    <input type="text" name="nome" id="nome" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $produto->nome ?? null?>" />
</div>

<div class="col-span-2">
    <label for="codigo" class="block mb-1 text-sm font-medium text-gray-900">Código</label>
    <input type="number" name="codigo" id="codigo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $produto->codigo ?? null?>" />
</div>

<div>
    <label for="preco" class="block mb-1 text-sm font-medium text-gray-900">Preço</label>
    <input type="number" name="preco" id="preco" min="0" max="1000" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $produto->preco ?? null?>" />
</div>

<div>
    <label for="estoque" class="block mb-1 text-sm font-medium text-gray-900">Estoque</label>
    <input type="number" name="estoque" min="0" max="1000" step="0.01" id="estoque" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $produto->estoque ?? null?>" />
</div>

<div>
    <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Tipo</label>
    <div class="">
        <select name="tipo" id="tipo" value="<?= $produto->tipo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-3 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($produto) && $produto->tipo == '') ? 'selected' : null ?>>Insira o tipo</option>
            <option value="un" <?= (isset($produto) && $produto->tipo == 'un') ? 'selected' : null ?>>UN</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>KG</option>
        </select>
    </div>
</div>

<div>
    <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Situação</label>
    <div class="">
        <select name="ativo" id="ativo" value="<?= $produto->ativo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-3 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($produto) && $produto->ativo == '') ? 'selected' : null ?>>Insira a situação</option>
            <option value='1' <?= (isset($produto) && $produto->ativo == '1') ? 'selected' : null ?>>Ativo</option>
            <option value='0' <?= (isset($produto) && $produto->ativo == '0') ? 'selected' : null ?>>Inativo</option>
        </select>
    </div>
</div>