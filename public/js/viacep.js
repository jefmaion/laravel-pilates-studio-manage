function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("input[name='user[address]']").val("");
    $("input[name='user[district]']").val("");
    $("input[name='user[city]']").val("");
    $("input[name='user[state]']").val("");
    $("input[name='user[ibge]']").val("");
}

//Quando o campo cep perde o foco.
function pesquisacep(cep) {


    //Nova variável "cep" somente com dígitos.
    var cep = cep.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("input[name='user[address]']").val("...");
            $("input[name='user[district]']").val("...");
            $("input[name='user[city]']").val("...");
            $("input[name='user[state]']").val("...");
            $("input[name='user[ibge]']").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

            console.log(dados)

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("input[name='user[address]']").val(dados.logradouro);
                    $("input[name='user[district]']").val(dados.bairro);
                    $("input[name='user[city]']").val(dados.localidade);
                    $("input[name='user[state]']").val(dados.uf);
                    $("input[name='user[ibge]']").val(dados.ibge);

                    $("input[name='user[number]']").focus()
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
}