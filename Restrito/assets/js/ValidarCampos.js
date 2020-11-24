function ValidarCamposCategoria() {
    if ($("#nome").val().trim() == "") {
        $("#nome").focus();
        alert("Por favor , preencha o campo NOME");
        return false;

    }
}

function ValidarCamposEmpresa() {
    if ($("#nomeEmpresa").val().trim() == "") {
        $("#nomeEmpresa").focus();
        alert("Por favor , insira o nome da empresa");

        return false;
    }
    if ($("#enderecoEmpresa").val().trim() == "") {
        $("#enderecoEmpresa").focus();
        alert("Por favor , insira o endereço da empresa");
        return false;
    }
    if ($("#telefoneEmpresa").val().trim() == "") {
        $("#telefoneEmpresa").focus();
        alert("Por favor , insira o telefone da empresa");
        return false;
    }
}

function ValidarCamposConta() {
    if ($("#nomeBanco").val().trim() == "") {
        $("#nomeBanco").focus();
        alert("Por favor , insira o nome do banco");
        return false;
    }
    if ($("#numeroConta").val().trim() == "") {
        $("#numeroConta").focus();
        alert("Por favor , insira o número da conta");
        return false;
    }
    if ($("#saldo").val().trim() == "") {
        $("#saldo").focus();
        alert("Por favor , insira o saldo da conta");
        return false;
    }
}

function ValidarCamposMovimento(){
    if($("#data").val().trim()==""){
        $("data").focus();
        alert("Por favor , insira a data do movimento");
        return false;
    }
    if($("#tipo").val().trim()==""){
        $("#tipo").focus();
        alert("Por favor , selecione o tipo do movimento");
        return false;
    }
    if($("#categoria").val().trim()==""){
        $("#categoria").focus();
        alert("Por favor , selecione a categoria");
        return false;
    }
    if($("#empresa").val().trim()==""){
        $("#empresa").focus();
        alert("Por favor , selecione a empresa");
        return false;
    }
    if($("#conta").val().trim()==""){
        $("#conta").focus();
        alert("Por favor , selecione a conta");
        return false;
    }
    
    if($("#valor").val().trim()==""){
        $("#valor").focus();
        alert("Por favor , insira o valor do movimento");
        return false;
    }
}

function ValidarCamposFiltrar(){
    if($("#tipoPesquisar").val().trim()==""){
        $("#tipoPesquisar").focus();
        alert("Por favor , selecione o tipo que deseja filtrar");
        return false;
    }
    if($("#dataInicial").val().trim()==""){
        $("#dataInicial").focus();
        alert("Por favor , seleciona a data inicial");
        return false;
    }
    if($("#dataFinal").val().trim()==""){
        $("#dataFinal").focus();
        alert("Por favor , seleciona a data final");
        return false;
    }
}