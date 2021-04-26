function deletar(id, tabela){
	if(confirm("Tem certeza que deseja remover este registro? Esta ação não tem volta.")){
		window.location.href="http://achairprofessional.com.br/funcoes.php?deletar=sim&id="+id+"&tabela="+tabela;
	}

}

function deletarVenda(id, tabela){
    if(confirm("Tem certeza que deseja remover este registro? Esta ação não tem volta.")){
        window.location.href="http://achairprofessional.com.br/funcoes.php?deletarvenda=sim&id="+id+"&tabela="+tabela;
    }

}

function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});



$(document).ready(function () {
    var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><select name="produtos' + counter + '" id="produto" class="form-control"><?php foreach ($produtos as $key) {?><option value=" <?php echo $key["id"]; ?> "><?php echo $key["nome"]." R$".$key["preco"]; ?></option><?php  } ?></select></td>';
        cols += '<td><input type="number" class="form-control" name="qtd' + counter + '"/></td>';

        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });

});

$(document).ready(function(){
  $('#cep').mask('99999-999');
  $('.dindin').mask('R$0.00', {reverse: true});
  $("#telefone_cliente").mask("(00)90000-0000");               
});

var options = {
    onKeyPress: function (cpf, ev, el, op) {
        var masks = ['000.000.000-000', '00.000.000/0000-00'],
            mask = (cpf.length > 14) ? masks[1] : masks[0];
        el.mask(mask, op);
    }
}

$('#cpf_cliente').mask('000.000.000-000', options);