$(function() {
    $("#section-whith-width-double").css("width", $("#take-width-here").width() * 2 + "px");
}); 

//* script pour le choix de l'établissement
function onChangeEndCursus() {
  if ($("#cursus_fini").is(':checked')) {
    $("#onCursusEnd").html(
        '<svg class="position-absolute" height="24" viewBox="0 0 8 8" width="24" xmlns="http://www.w3.org/2000/svg">'+
            '<path d="m0 0v2h7v-2zm0 3v4.91c0 .05.04.09.09.09h6.81c.05 0 .09-.04.09-.09v-4.91h-7zm1 1h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm-4 2h1v1h-1zm2 0h1v1h-1z"/>'+
        '</svg>'+
        '<input class="ps-input-svg border-bottom border-0 border-focus-bot" placeholder="Date de début"  type="text" name="password2" required>'
    );
  } else {
    $("#onCursusEnd").html("");
  }
}

function onOtherEtab() {
    if ($("#select_etab").val() === 'null') {
        $("#onOtherEtab").html(
            
            '<section class="d-flex flex-row">'+
                '<section class="d-flex flex-column">'+
                    '<section class="p-2 mb-3">'+
                        '<svg class="position-absolute" height="24" viewBox="0 0 8 8" width="24" xmlns="http://www.w3.org/2000/svg">'+
                            '<path d="m3 0c-1.66 0-3 1.34-3 3 0 2 3 5 3 5s3-3 3-5c0-1.66-1.34-3-3-3zm0 1c1.11 0 2 .9 2 2 0 1.11-.89 2-2 2-1.1 0-2-.89-2-2 0-1.1.9-2 2-2z" transform="translate(1)"/>'+
                        '</svg>'+
                        '<input class="ps-input-svg border-bottom border-0 border-focus-bot" placeholder="Etablissement"  type="text" class="form-control" name="nom_etab" pattern="[a-zA-Zéè]{3,128}" required>'+
                    '</section>'+
                    '<section class="p-2 mb-3">'+
                        '<svg class="position-absolute" height="24" viewBox="0 0 8 8" width="24" xmlns="http://www.w3.org/2000/svg">'+
                            '<path d="m3 0c-1.66 0-3 1.34-3 3 0 2 3 5 3 5s3-3 3-5c0-1.66-1.34-3-3-3zm0 1c1.11 0 2 .9 2 2 0 1.11-.89 2-2 2-1.1 0-2-.89-2-2 0-1.1.9-2 2-2z" transform="translate(1)"/>'+
                        '</svg>'+
                        '<input class="ps-input-svg border-bottom border-0 border-focus-bot" placeholder="ville"  type="text" class="form-control" name="nom_ville" pattern="[a-zA-Zéè]{3,32}" required>'+
                    '</section>'+
                '</section>'+
                '<section class="d-flex flex-column">'+
                    '<section class="p-2 mb-3">'+
                        '<svg class="position-absolute" height="24" viewBox="0 0 8 8" width="24" xmlns="http://www.w3.org/2000/svg">'+
                            '<path d="m3 0c-1.66 0-3 1.34-3 3 0 2 3 5 3 5s3-3 3-5c0-1.66-1.34-3-3-3zm0 1c1.11 0 2 .9 2 2 0 1.11-.89 2-2 2-1.1 0-2-.89-2-2 0-1.1.9-2 2-2z" transform="translate(1)"/>'+
                        '</svg>'+
                        '<input class="ps-input-svg border-bottom border-0 border-focus-bot" placeholder="Code postale"  type="text" class="form-control" name="cp_ville" pattern="[0-9]{5,5}" required>'+
                    '</section>'+
                    '<section class="p-2 mb-3">'+
                        '<svg class="position-absolute" height="24" viewBox="0 0 8 8" width="24" xmlns="http://www.w3.org/2000/svg">'+
                            '<path d="m3 0c-1.66 0-3 1.34-3 3 0 2 3 5 3 5s3-3 3-5c0-1.66-1.34-3-3-3zm0 1c1.11 0 2 .9 2 2 0 1.11-.89 2-2 2-1.1 0-2-.89-2-2 0-1.1.9-2 2-2z" transform="translate(1)"/>'+
                        '</svg>'+
                        '<input class="ps-input-svg border-bottom border-0 border-focus-bot" placeholder="Complement d\'adresse"  type="text" class="form-control" name="adresse_etab" pattern="[a-zA-Z0-9À-ÿ'+"'"+'-]*{3,128}" required>'+
                    '</section>'+
                '</section>'+
            '</section>'
        );
    } else {
        $("#onOtherEtab").html("");
    }
    console.log($("body").height());
}