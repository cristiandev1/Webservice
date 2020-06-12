<?php $email_html = '
<div style="width: 700px; background-color: #1d1d1d; padding-top: 30px; padding-bottom: 30px; font-family: arial, sans-serif">
  <div style="width: 600px; position: relative; margin-left: 50px;">
    <div><img src="https://pokerweb.com.br/_site_files/imagens/logos/emails/actionclock.png" style="width: 200px; margin: 10px 0 20px 0"></div>
    <div style="font-size: 30px; text-align: center;padding: 20px 0 15px 0; background-color: #3b75d0; color: #ffffff; border-radius: 7px 7px 0 0">ATIVAÇÃO DE CADASTRO</div>
    <div style="font-size:14px; padding: 25px; background-color: #ffffff; border-radius: 0 0 7px 7px; margin: 10px 0 0 0;line-height: 25px;">
      Ol&aacute; ' .$nome_completo. ',<br><br>
      Agradecemos por baixar e cadastrar-se para utilizar o aplicativo Action Clock da Pokerweb.<br><br>
      Clique no link abaixo para ativar seu cadastro
      <div style="border: solid 2px #577690;padding: 30px 0;margin: 10px 0 30px 0; text-align: center; background-color: #d0e1f7; border-radius: 7px">
        <div style="font-size: 35px; font-weight: bold;">
          <a href="https://apis.pokerweb.com.br/app_actionclock/ativar_email.php?em='.$email.'&cod='.$cod.'&tk='.$cod_md5.'" style="text-decoration: none">
            ATIVAR CADASTRO
          </a>
        </div>
      </div>
      Atenciosamente,<br>Equipe ActionClock
    </div>
  </div>
  <div style="text-align: center; margin: 10px 0 0 0; font-size: 11px;color: #a0a0a0">Por favor, n&atilde;o responda este e-mail, o mesmo foi gerado automaticamente e n&atilde;o pode receber respostas de retorno.</div>
</div>
';?>