<div class="wrapper">
        <!--Top menu -->
        <div class="sidebar">
           <!--profile image & text-->
           <div class="profile">
                <img src="assets/img/logoFondTransparent.png" alt="profile_picture">
                <h3></h3>
                <p></p>
            </div>
            <!--menu item-->
            <ul>
                <li class="nav-item">
                    <a href="admin.php"  class="nav-link d-flex align-items-center">
                        <div class="icon"><i class="fa-solid fa-house" ></i></div>
                        <span class="item">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="user.php"class="nav-link d-flex align-items-center">
                        <div class="icon"><img src="icone/person.svg"></div>
                        <span class="item">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="etablissement.php" class="nav-link d-flex align-items-center">
                        <div class="icon"><img src="icone/briefcase.svg"></i></div>
                        <span class="item">Etablissement</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="participer.php" class="nav-link d-flex align-items-center">
                        <div class="icon"><img src="icone/people.svg"></i></div>
                        <span class="item">Participation</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="impression.php" class="nav-link d-flex align-items-center">
                        <div class="icon"><img src="icone/globe.svg"></div>
                        <span class="item">Impressions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="commentaire.php" class="nav-link d-flex align-items-center">
                        <div class="icon"><img src="icone/share.svg"></div>
                        <span class="item">Commentaire</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="theme.php" class="nav-link d-flex align-items-center">
                        <div class="icon"><i class="fa-solid fa-bookmark"></i></div>
                        <span class="item">Theme</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="cursus.php" class="nav-link d-flex align-items-center">
                        <div class="icon"><img src="icone/folder.svg"></div>
                        <span class="item">Cursus</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="home.php" class="nav-link d-flex align-items-center">
                        <div class="icon"><img src="icone/enter-entrance.svg"></div>
                        <span class="item">Deco</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>

    </div>
</div>
<script type="text/javascript">

// * Gestion nav-link active 
var current = window.location;
var listLink = document.querySelectorAll('.nav-item a');
var listIcon = document.querySelectorAll('.nav-item a div');
var listSpan = document.querySelectorAll('.nav-item a span');
console.log(listLink);
for (i = 0; i < listLink.length; i++){
    if(listLink[i].href == current){
        listLink[i].className = "nav-link d-flex align-items-center active";
        listIcon[i].className = "grey-light";
        listSpan[i].className = "grey-light";
    }
}
</script>

