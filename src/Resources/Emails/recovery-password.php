<!DOCTYPE html>
<html>
  <body>
    <div style="width: 100%; text-align: center;">
      <h1>Recuperação de senha</h1>
    </div>

    <p>Olá, <strong> <?= htmlspecialchars($nome) ?></strong></p>

    <p>Recebemos sua solicitação para a recuperação da senha da sua conta!</p>
    <p>Utilize este código para conseguir acessar novamente a sua conta:</p>

    <div style="width: 100%; background-color:rgb(221, 221, 221); text-align: center; margin-top: 10px">
      <h3 style="padding: 20px 0"><?= htmlspecialchars($codigo) ?></h3>
    </div>

    <p>Insira este código para prosseguir com a recuperação da sua conta!</p>

    <div style="width: 100%; margin-top: 40px;">
      <span><strong>Se não foi você que solicitou a recuperação da senha, entre em contato com o administrador.</strong></span>
    </div>

    <p style="margin-top: 50px">Att.</p>
    <p><?= SITE_NAME ?></p>
  </body>
</html>