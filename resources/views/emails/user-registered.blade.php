<h1> olá {{ $user->name }}, tudo bem? Espero que sim!</h1>

<h3>Obrigada pela sua inscrição</h3>

<p>
    Faça bom proveito e exelentes compras em nosso marketplace! <br>
    Seu email de cadastro é <strong>{{ $user->email }}</strong> <br>
    Sua senha: <strong>Por questões de segurança não enviamos sua senha, mas você deve se lembrar!</strong>

</p>
<hr>
Email enviado em {{ date('d/m/y H:i:s ') }}.
