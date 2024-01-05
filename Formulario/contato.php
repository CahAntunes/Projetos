<?php

    $name = addslashes($_POST['name']);
    $email = addslashes($_POST['email']);
    $telefone = addslashes($_POST['telefone']);
    $message = addslashes($_POST['message']);

    $para = "oliveiracamilaantunes@gmail.com";
    $assunto = "Novo Contato";

    $corpo= "Nome: ".$name."\n".
            "E-mail: ".$email."\n".
            "Telefone: ".$telefone."\n".
            "Mensagem: ".$message;

    $cabeca = 'From: oliveiracamilaantunes@gmail.com' . "\r\n" .
    'Reply-To: daniel.r.amancio@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    if(mail($para,$assunto,$corpo,$cabeca)){
        echo("E-mail enviado com sucesso!");
    }else{
        echo("Houve um erro ao enviar o email!");

        $test = mail($para,$assunto,$corpo,$cabeca);
        var_dump($test);
    }

?>
