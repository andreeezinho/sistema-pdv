<div class="col-span-2">
    <label for="nome" class="block mb-1 text-sm font-medium text-gray-900">Nome</label>
    <input type="text" name="nome" id="nome" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $permissao->nome ?? null?>" />
</div>

<div class="">
    <label for="tipo" class="block text-sm/6 font-medium text-gray-900">Tipo</label>
    <div>
        <select name="tipo" id="tipo" value="<?= $permissao->tipo ?? null ?>" class="border-2 border-solid block w-full rounded-md bg-white px-3 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($permissao) && $permissao->tipo == "") ? 'selected' : "" ?> >Selecione o tipo</option>
            <option value="cadastrar" <?= (isset($permissao) && $permissao->tipo == "cadastrar") ? 'selected' : "" ?>>Cadastrar</option>
            <option value="deletar" <?= (isset($permissao) && $permissao->tipo == "deletar") ? 'selected' : "" ?>>Deletar</option>
            <option value="editar" <?= (isset($permissao) && $permissao->tipo == "editar") ? 'selected' : "" ?>>Editar</option>
            <option value="visualizar" <?= (isset($permissao) && $permissao->tipo == "visualizar") ? 'selected' : "" ?>>Visualizar</option>
        </select>
    </div>
</div>

<div>
    <label for="ativo" class="block text-sm/6 font-medium text-gray-900">Situação</label>
    <div class="">
        <select name="ativo" id="ativo" value="<?= $permissao->ativo ?? null ?>" class="border-2 border-solid block w-full rounded-md bg-white px-3 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
            <option value="" <?= (isset($permissao) && $permissao->ativo == '') ? 'selected' : null ?>>Insira a situação</option>
            <option value='1' <?= (isset($permissao) && $permissao->ativo == '1') ? 'selected' : null ?>>Ativo</option>
            <option value='0' <?= (isset($permissao) && $permissao->ativo == '0') ? 'selected' : null ?>>Inativo</option>
        </select>
    </div>
</div>