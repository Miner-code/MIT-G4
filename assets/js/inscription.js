//* script pour le choix de l'établissement
function onChangeEndCursus() {
  if ($("#cursus_fini:checked").val() === "cursus_fini") {
    $("#onCursusEnd").html(
      '<div class="mb-2">' +
        '<label for="date_obtention" class="form-label">Date d\'obtention</label>' +
        '<input type="date" class="form-control datepicker_input" name="date_obtention" required>' +
        "</div>"
    );
  } else {
    $("#onCursusEnd").html("");
  }
}

function onOtherEtab() {
    if ($("#select_etab").val() === 'null') {
        $("#onOtherEtab").html(
            '<div class="mb-2">'+
                '<label for="nom_etab" class="form-label">Nom de l\'établissement</label>'+
                '<input type="text" class="form-control" name="nom_etab" pattern="[a-zA-Zéè]{3,128}" required>'+
            '</div>'+
            '<div class="mb-2">'+
                '<label for="nom_ville" class="form-label">Ville</label>'+
                '<input type="text" class="form-control" name="nom_ville" pattern="[a-zA-Zéè]{3,32}" required>'+
            '</div>'+
            '<div class="mb-2">'+
                '<label for="cp_ville" class="form-label">code postale</label>'+
                '<input type="text" class="form-control" name="cp_ville" pattern="[0-9]{5,5}" required>'+
            '</div>'+
            '<div class="mb-2">'+
                '<label for="adresse_etab" class="form-label">Complement d\'adresse</label>'+
                '<input type="text" class="form-control" name="adresse_etab" pattern="[a-zA-Z0-9À-ÿ'+"'"+'-]*{3,128}" required>'+
            '</div>'
        );
    } else {
        $("#onOtherEtab").html("");
    }
}
