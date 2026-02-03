<div class="col-span-2">
    <label for="usuario" class="block mb-1 text-sm font-medium text-gray-900">Usuário</label>
    <input type="text" name="usuario" id="usuario" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $usuario->usuario ?? null?>" />
</div>

<div class="col-span-2">
    <label for="nome" class="block mb-1 text-sm font-medium text-gray-900">Nome</label>
    <input type="text" name="nome" id="nome" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $usuario->nome ?? null?>" />
</div>

<div class="col-span-2">
    <label for="email" class="block mb-1 text-sm font-medium text-gray-900">E-mail</label>
    <input type="text" name="email" id="email" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $usuario->email ?? null?>" />
</div>

<div class="col-span-2">
    <label for="cpf" class="block mb-1 text-sm font-medium text-gray-900">CPF</label>
    <input type="text" name="cpf" id="cpf" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $usuario->cpf ?? null?>" />
</div>

<div class="col-span-2">
    <label for="telefone" class="block mb-1 text-sm font-medium text-gray-900">Telefone</label>
    <input type="text" name="telefone" id="telefone" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="<?= $usuario->telefone ?? null?>" />
</div>

<?php
    if(!$perfil){
?>
    <div>
        <label for="cargo" class="block text-sm/6 font-medium text-gray-900">Cargo</label>
        <div class="">
            <select name="cargo" id="cargo" value="<?= $usuario->cargo ?? null ?>" class="border-2 border-solid block w-full rounded-md bg-white px-3 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
                <option value="" <?= (isset($usuario) && $usuario->cargo == '') ? 'selected' : null ?>>Selecione o cargo</option>
                <option value="Administrativo" <?= (isset($usuario) && $usuario->cargo == 'Administrativo') ? 'selected' : null ?>>Administrativo</option>
                <option value='Frente de Caixa' <?= (isset($usuario) && $usuario->cargo == 'Frente de Caixa') ? 'selected' : null ?>>Frente de Caixa</option>
                <option value='Repositor' <?= (isset($usuario) && $usuario->cargo == 'Repositor') ? 'selected' : null ?>>Repositor</option>
                <option value='Entregador' <?= (isset($usuario) && $usuario->cargo == 'Entregador') ? 'selected' : null ?>>Entregador</option>
            </select>
        </div>
    </div>

    <div>
        <label for="ativo" class="block text-sm/6 font-medium text-gray-900">Situação</label>
        <div class="">
            <select name="ativo" id="ativo" value="<?= $usuario->ativo ?? null ?>" placeholder="Código ou nome" class="border-2 border-solid block w-full rounded-md bg-white px-3 p-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-gray-600 sm:text-sm/6">
                <option value="" <?= (isset($usuario) && $usuario->ativo == '') ? 'selected' : null ?>>Insira a situação</option>
                <option value='1' <?= (isset($usuario) && $usuario->ativo == '1') ? 'selected' : null ?>>Ativo</option>
                <option value='0' <?= (isset($usuario) && $usuario->ativo == '0') ? 'selected' : null ?>>Inativo</option>
            </select>
        </div>
    </div>
<?php
    }
?>