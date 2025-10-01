<div class="col-span-2">
    <label for="nome" class="block mb-1 text-sm font-medium text-gray-900">Nome</label>
    <input type="text" name="nome" id="nome" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $produto->nome ?? null?>" />
</div>

<?php
    if(isset($edit)){
?>
    <div class="col-span-1">
        <label for="estoque" class="block mb-1 text-sm font-medium text-gray-900">N° Produto</label>
        <label class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"><?= $produto->id ?? null?></span>
    </div>
<?php
    }
?>

<div class="col-span-1">
    <label for="codigo" class="block mb-1 text-sm font-medium text-gray-900">Código</label>
    <input type="number" name="codigo" id="codigo" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $produto->codigo ?? null?>" />
</div>

<div>
    <label for="preco" class="block mb-1 text-sm font-medium text-gray-900">Preço</label>
    <input type="number" name="preco" id="preco" min="0" max="1000" step="0.01" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $produto->preco ?? null?>" />
</div>

<div>
    <label for="estoque" class="block mb-1 text-sm font-medium text-gray-900">Estoque</label>
    <input type="number" name="estoque" min="0" max="1000" step="0.01" id="estoque" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $produto->estoque ?? null?>" />
</div>

<div>
    <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Tipo</label>
    <div class="">
        <select name="tipo" id="tipo" value="<?= $produto->tipo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-2 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($produto) && $produto->tipo == '') ? 'selected' : null ?>>Insira o tipo</option>
            <option value="un" <?= (isset($produto) && $produto->tipo == 'un') ? 'selected' : null ?>>UN</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>KG</option>
        </select>
    </div>
</div>

<div>
    <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Grupo</label>
    <div class="">
        <select name="tipo" id="tipo" value="<?= $produto->tipo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-2 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($produto) && $produto->tipo == '') ? 'selected' : null ?>>Insira o grupo</option>
            <option value="un" <?= (isset($produto) && $produto->tipo == 'un') ? 'selected' : null ?>>Genero Alimentício</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>Limpeza</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>Utilidades</option>
        </select>
    </div>
</div>

<div>
    <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Embalagem (Entrada)</label>
    <div class="">
        <select name="tipo" id="tipo" value="<?= $produto->tipo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-2 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($produto) && $produto->tipo == '') ? 'selected' : null ?>>Insira o tipo da entrada</option>
            <option value="un" <?= (isset($produto) && $produto->tipo == 'un') ? 'selected' : null ?>>Unidade</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>Fardo 12</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>Fardo 24</option>
        </select>
    </div>
</div>

<div>
    <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Embalagem (Saída)</label>
    <div class="">
        <select name="tipo" id="tipo" value="<?= $produto->tipo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-2 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($produto) && $produto->tipo == '') ? 'selected' : null ?>>Insira o tipo da saída</option>
            <option value="un" <?= (isset($produto) && $produto->tipo == 'un') ? 'selected' : null ?>>Unidade</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>Fardo 12</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>Fardo 24</option>
        </select>
    </div>
</div>

<div>
    <label for="ativo" class="block text-sm/6 font-medium text-gray-900">Situação</label>
    <div class="">
        <select name="ativo" id="ativo" value="<?= $produto->ativo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-2 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($produto) && $produto->ativo == '') ? 'selected' : null ?>>Insira a situação</option>
            <option value='1' <?= (isset($produto) && $produto->ativo == '1') ? 'selected' : null ?>>Ativo</option>
            <option value='0' <?= (isset($produto) && $produto->ativo == '0') ? 'selected' : null ?>>Inativo</option>
        </select>
    </div>
</div>

<div class="col-span-full border-1 border-t border-gray-800 mt-10 mb-4">
    <h3 class="text-gray-800 text-2xl mt-3">Tributação</h3>
</div>

<div class="col-span-1">
    <label for="ncm" class="block mb-1 text-sm font-medium text-gray-900">NCM</label>
    <input type="number" name="ncm" id="ncm" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="" />
</div>

<div class="col-span-1">
    <label for="cest" class="block mb-1 text-sm font-medium text-gray-900">CEST</label>
    <input type="number" name="cest" id="cest" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" value="" />
</div>

<div>
    <label for="icms" class="block text-sm/6 font-medium text-gray-900">ICMS</label>
    <div class="">
        <select name="icms" id="icms" value="<?= $produto->tipo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-2 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($produto) && $produto->tipo == '') ? 'selected' : null ?>>Insira o ICMS</option>
            <option value="un" <?= (isset($produto) && $produto->tipo == 'un') ? 'selected' : null ?>>Tributado 20,5%</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>Tributado 7%</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>Tributado 12%</option>
        </select>
    </div>
</div>

<div>
    <label for="ipi" class="block text-sm/6 font-medium text-gray-900">IPI</label>
    <div class="">
        <select name="ipi" id="ipi" value="<?= $produto->tipo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-2 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($produto) && $produto->tipo == '') ? 'selected' : null ?>>Insira o IPI</option>
            <option value="un" <?= (isset($produto) && $produto->tipo == 'un') ? 'selected' : null ?>>Tributado 20,5%</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>Tributado 7%</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>Tributado 12%</option>
        </select>
    </div>
</div>

<div class="col-span-2">
    <label for="pis" class="block text-sm/6 font-medium text-gray-900">PIS/CONFINS</label>
    <div class="">
        <select name="pis" id="pis" value="<?= $produto->tipo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-2 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($produto) && $produto->tipo == '') ? 'selected' : null ?>>Insira o PIS/CONFINS</option>
            <option value="un" <?= (isset($produto) && $produto->tipo == 'un') ? 'selected' : null ?>>Tributado 01/50</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>PIS/CONFINS 05/75</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>Monofásico 04/70</option>
        </select>
    </div>
</div>

<div class="col-span-2">
    <label for="pis" class="block text-sm/6 font-medium text-gray-900">Origem da Mercadoria</label>
    <div class="">
        <select name="pis" id="pis" value="<?= $produto->tipo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-2 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($produto) && $produto->tipo == '') ? 'selected' : null ?>>Insira a origem</option>
            <option value="un" <?= (isset($produto) && $produto->tipo == 'un') ? 'selected' : null ?>>0 – Nacional, exceto as indicadas nos códigos 3, 4, 5 e 8</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>1 – Estrangeira – Importação direta</option>
            <option value="kg" <?= (isset($produto) && $produto->tipo == 'kg') ? 'selected' : null ?>>2 – Estrangeira – Adquirida no mercado interno</option>
        </select>
    </div>
</div>

<div class="col-span-1">
    <label for="nat-receita" class="block mb-1 text-sm font-medium text-gray-900">Nat. Receita</label>
    <input type="number" name="nat-receita" id="nat-receita" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" value="" />
</div>