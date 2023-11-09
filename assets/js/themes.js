function publieDepuis(datePublication) {
    const datePubliee = new Date(datePublication);

    if (isNaN(datePubliee)) {
        return "Format de date invalide";
    }

    const maintenant = new Date();
    const difference = maintenant - datePubliee;

    const intervalles = [
        { unit: 'an', diviseur: 31536000000 },
        { unit: 'mois', diviseur: 2592000000 },
        { unit: 'jour', diviseur: 86400000 },
        { unit: 'heure', diviseur: 3600000 },
        { unit: 'minute', diviseur: 60000 },
        { unit: 'seconde', diviseur: 1000 }
    ];

    for (const intervalle of intervalles) {
        const valeur = Math.floor(difference / intervalle.diviseur);
        if (valeur > 0) {
            const pluriel = valeur > 1 ? 's' : '';
            return `Publié il y a ${valeur} ${intervalle.unit}${pluriel}`;
        }
    }

    return "Publié il y a moins d'une seconde";
}


async function onChangeThemes() {
    fetch('api.php?id_theme='+$("#select_theme").val())
        .then(res => res.text())
        .then((data) => {
            data = JSON.parse(data);
            console.log(data);
            let htmlData = '';
            for (let i = 0; i < data.length; i++) {
                console.log(data[i]);
                htmlData += 
            '<a class="card rounded-5 mb-5 w-100 p-4 text-decoration-none grey-dark" href="view-post.php?id_impression='+data[i]['id_imp']+'">'+
                '<section class="d-flex flex-row justify-content-between align-items-center">'+
                    '<object>'+
                        '<a href="profil.php?id='+data[i]['id_user']+'">'+
                            '<img src="'+data[i]['img_user']+'" alt="image de profil" class="rounded-circle" style="width:5em; height:5em;">'+
                        '</a>'+
                    '</object>'+
                    '<h3 class="border-bottom border-dark">'+data[i]['titre_imp']+'</h3>'+
                    '<span style="width:5em; height:5em;"></span>'+
                '</section>'+
                '<section class="mx-content-imp">'+data[i]['contenu_imp']+'</section>'+
                '<section class="d-flex justify-content-end">'+
                    data[i]['nom_user']+" "+data[i]['prenom_user']+" - "+publieDepuis(data[i]['date_imp'])+
                '</section>'+
            '</a>'
            }

            $('#impression-by-theme').html(htmlData)

        });
}