/*
 * introduition des codes js dans le programme
 */

var attribut_i = 0;
function addDoc() {
    //on increment la variable globale i, numero de produit
    attribut_i++;

    var obj_tableau = document.getElementById("tableau_doc");
    var arrayLignes = obj_tableau.rows;
    var nbr_de_lignes = arrayLignes.length;
    var nouvelleLigne = obj_tableau.insertRow(nbr_de_lignes - 1);
    var colonne1 = nouvelleLigne.insertCell(0);
    //colonne1.innerHTML = "document " + i;
    var colonne2 = nouvelleLigne.insertCell(1);
    colonne2.innerHTML += '<span class="col-md-6">' + '<input type="text" class="form-control" placeholder="description fichier">' + '</span>' +
            '<span class="col-md-3">' + '<input type="file" name="fichier[]"></span><br>';

}


$(document).ready(function () {
    $('#addDoc').click(function (e) {
        e.preventDefault();
        attribut_i++;
        //alert(attribut_i);
        if (attribut_i === "10") {
            $('#bloc-button').empty();
        }

    });


    /*
     * fonction d'ajout du modele de message
     */

    $('.inserer').click(function (e) {
        e.preventDefault();

        var smsmodel = this.name;
        $('#message').val("" + smsmodel + "");
    });
    
    /*
     * fonction d'ajout d'un groupe
     */

    $('#newGroupe').on('submit', function (e) {
        e.preventDefault();
       
       var nomgroup = $('#nomgroupe').val();
       if(nomgroup === ""){
           $('.notification').empty();
           $('.notification').html("<div class='alert alert-danger'> Le champ classe ne peut être vide </div>");
       }else{
           $.ajax({
              url:$(this).attr('action'),
              type:$(this).attr('method'),
              data: $(this).serialize(),
              dataType:"json",
           }).success(function (data) {
                var isSuccess = data.success !== undefined ? data.success : false;
                var msg = data.msg !== undefined ? data.msg : "";
                var idgroupe = data.id !== undefined ? data.id : null;
                if (isSuccess) {
                    $(".notification").empty();
                    $(".notification").html("<div class='alert alert-success col-md-12'>" + msg + "</div>");                
                    $('.select-goup').append('<option value='+ idgroupe +'>'+ nomgroup+'</option>').add();
                    $('.tabl-groupe').append("<tr class='table-responsive table-striped'>"+
                                   " <td class='col-md-8'>"+ nomgroup + "</td>"+
                                    "<td class='col-md-2'>"+
                                        "<a href='#' class='btn btn-sm btn-default'><i class='fa fa-pencil'></i>&nbsp;modifier</a>"+
                                    "</td>"+
                                    "<td class='col-md-2'>"+
                                        "<a href='#' class='btn btn-sm btn-danger'><i class='fa fa-remove'></i>&nbsp; supprimer</a>"+
                                   " </td>"+
                                "</tr> "+ 
                                "<tr><td colspan='3'>&nbsp;</td></tr>").add();
                    $("#nomgroupe").val(" ");
                    
                    
                } else if (msg.length > 0) {
                    $(".notification").html("<div class='alert alert-danger col-md-12'>" + msg + "</div>");
                }
            }).error(function (xhr) {
                alert(xhr.responseText);
                console.log(xhr.responseText);
            });
       }
    });

});
