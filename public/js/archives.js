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
    colonne2.innerHTML += '<span class="col-md-6">'+'<input type="text" class="form-control" placeholder="description fichier">'+'</span>'+
                        '<span class="col-md-3">'+'<input type="file" name="fichier[]"></span><br>';

}

