<div class="mt-4">
    <label for="forma" class="block mb-1 text-sm font-medium text-gray-900">Forma de Pagamento</label>
    <input type="text" name="forma" id="forma" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $pagamento->forma ?? null ?>" />
</div>

<div class="mt-4">
    <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Situação</label>
    <div class="">
        <select name="ativo" id="ativo" value="<?= $pagamento->ativo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-3 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            <option value="" <?= (isset($pagamento) && $pagamento->ativo == '') ? 'selected' : null ?>>Insira a situação</option>
            <option value='1' <?= (isset($pagamento) && $pagamento->ativo == '1') ? 'selected' : null ?>>Ativo</option>
            <option value='0' <?= (isset($pagamento) && $pagamento->ativo == '0') ? 'selected' : null ?>>Inativo</option>
        </select>
    </div>
</div>