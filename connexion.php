<!DOCTYPE HTML>
<html>
	<head>
		<title>Connexion</title>
        <?php include "include/head.php"; ?>
	</head>	
	<body>
<?php
    include "include/bdd.php";

    if(isset($_POST['mail']) && isset($_POST['password'])){
        $mail = $_POST['mail'];
        $mdp = hash('sha256', $_POST['password']);
        $req_co = "SELECT mail_user, mdp_user FROM user WHERE mail_user = '$mail' AND mdp_user = '$mdp'";
        $co = $bdd->prepare($req_co);
        $co->execute();
        $user_exist = $co->rowCount();

        if($user_exist == 1){
        //* Verifiaction du role du compte (si banni)
            $req = $bdd->prepare("SELECT id_user, role_user FROM user WHERE mail_user = '$mail'");
            $req->execute();
            $data = $req->fetch(\PDO::FETCH_OBJ);
            $id_user = $data->id_user;
            $role_user = $data->role_user;

            if($role_user == 2){
                $mess = 'Votre comte à été banni.';
            } else {
                //* Si le compte est valid
                session_start();
                $_SESSION['id_user'] = intval($id_user);
                $_SESSION['role_user'] = intval($role_user);
                header("location:index.php");
            }
        }
    }

?>
        <section class="row vh-100 vw-100 mx-0 px-0">
            <section class="col-6 d-none bg-grey d-xl-flex justify-content-center align-items-center">
                <section>
                    <img src="assets/img/logoFondTransparent.png" alt="logo UNEA" class="img-fluid">
                </section>
            </section>
            <section class="col-xl-6 col-12 p-0">
                <section class="row bg-grey-light mx-0">
                    <a href="inscription.php" class="col-6 text-decoration-none text-center fs-3 py-3 grey-dark">INSCRIPTION</a>
                    <a href="connexion.php" class="col-6 text-decoration-none text-center fs-3 py-3 grey-dark login-active">CONNEXION</a>
                </section>
                <section class="d-md-block d-none">
                    <p class="text-center my-5">Découvrez la plateforme qui mets en relation les étudiants</p>
                </section>
                <section class="d-md-none d-block">
                    <img src="assets/img/logoFondTransparent.png" alt="logo UNEA" class="img-fluid w-50 my-4" style="margin-left: 25%;"/>
                </section>
                <form method="post" class="d-flex flex-column align-items-center fs-4">
                    <section class="p-2 mb-5">
                        <svg class="position-absolute" height="24" viewBox="0 0 8 8" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="m4 0c-1.1 0-2 1.12-2 2.5s.9 2.5 2 2.5 2-1.12 2-2.5-.9-2.5-2-2.5zm-2.09 5c-1.06.05-1.91.92-1.91 2v1h8v-1c0-1.08-.84-1.95-1.91-2-.54.61-1.28 1-2.09 1s-1.55-.39-2.09-1z"/>
                        </svg>
                        <input type="email" name="mail" placeholder="alexis@unea.com" class="ps-input-svg border-bottom border-0 border-focus-bot">
                    </section>
                    <section class="p-2 my-5">
                        <svg class="position-absolute" height="24" viewBox="0 0 8 8" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="m3 0c-1.1 0-2 .9-2 2v1h-1v4h6v-4h-1v-1c0-1.1-.9-2-2-2zm0 1c.56 0 1 .44 1 1v1h-2v-1c0-.56.44-1 1-1z" transform="translate(1)"/>
                        </svg>
                        <input type="password" name="password" placeholder="***********" class="ps-input-svg border-bottom border-0 border-focus-bot">
                    </section>
                    <button type="submit" class="btn btn-primary py-2 px-5 mt-2">Connexion</button>
                </form>
                <?php if(isset($mess)){echo $mess.'<hr/>';} ?>
                
                <section class="position-absolute py-3 bg-grey-light w-100 w-xl-50 d-flex flex-row justify-content-center" style="bottom: 0;">
                    <svg class="mx-2" width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="m18.59 5.89c-1.23-.57-2.54-.99-3.92-1.23-.17.3-.37.71-.5 1.04-1.46-.22-2.91-.22-4.34 0-.14-.33-.34-.74-.51-1.04-1.38.24-2.69.66-3.92 1.23-2.48 3.74-3.15 7.39-2.82 10.98 1.65 1.23 3.24 1.97 4.81 2.46.39-.53.73-1.1 1.03-1.69-.57-.21-1.11-.48-1.62-.79.14-.1.27-.21.4-.31 3.13 1.46 6.52 1.46 9.61 0 .13.11.26.21.4.31-.51.31-1.06.57-1.62.79.3.59.64 1.16 1.03 1.69 1.57-.49 3.17-1.23 4.81-2.46.39-4.17-.67-7.78-2.82-10.98zm-9.75 8.78c-.94 0-1.71-.87-1.71-1.94s.75-1.94 1.71-1.94 1.72.87 1.71 1.94c0 1.06-.75 1.94-1.71 1.94zm6.31 0c-.94 0-1.71-.87-1.71-1.94s.75-1.94 1.71-1.94 1.72.87 1.71 1.94c0 1.06-.75 1.94-1.71 1.94z"/>
                    </svg>
                    <svg class="mx-2" fill="none" height="36" viewBox="0 0 24 24" width="36" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" d="m7.46494 1.066c1.17334-.05378 1.54734-.066 4.53506-.066 2.9883 0 3.3617.01283 4.5344.066 1.1715.05317 1.9715.23956 2.6712.5115.7339.27631 1.3987.70924 1.9482 1.26867.5595.54943.9925 1.21429 1.2687 1.94822.2719.69972.4577 1.49967.5115 2.67055.0538 1.17334.066 1.54734.066 4.53506 0 2.9877-.0128 3.3617-.066 4.5351-.0532 1.1708-.2396 1.9708-.5115 2.6705-.2811.723-.6576 1.3371-1.2687 1.9482-.5494.5595-1.2143.9925-1.9482 1.2687-.6997.2719-1.4997.4577-2.6705.5115-1.1734.0538-1.5474.066-4.5351.066-2.98772 0-3.36172-.0128-4.53506-.066-1.17088-.0532-1.97083-.2396-2.67055-.5115-.72295-.2811-1.33711-.6576-1.94822-1.2687-.55953-.5494-.99249-1.2143-1.26867-1.9482-.27194-.6997-.45772-1.4997-.5115-2.6705-.05378-1.1734-.066-1.5468-.066-4.5351 0-2.98833.01283-3.36172.066-4.53444.05317-1.1715.23956-1.97145.5115-2.67117.27631-.73388.70924-1.39871 1.26867-1.94822.54942-.55953 1.21428-.99249 1.94822-1.26867.69972-.27194 1.49967-.45772 2.67055-.5115zm8.98026 1.98c-1.1599-.05256-1.5082-.06417-4.4452-.06417s-3.28533.01161-4.44522.06417c-1.0725.04889-1.65489.22794-2.04234.37889-.51333.19922-.88.43755-1.265.82255-.38438.385-.62333.75167-.82255 1.265-.15095.38745-.33.96984-.37889 2.04234-.05256 1.15989-.06417 1.50822-.06417 4.44522s.01161 3.2853.06417 4.4452c.04889 1.0725.22794 1.6549.37889 2.0424.17622.4778.4573.91.82255 1.265.3549.3652.78717.6463 1.265.8225.38745.151.96984.33 2.04234.3789 1.15989.0526 1.50761.0642 4.44522.0642 2.9376 0 3.2853-.0116 4.4452-.0642 1.0725-.0489 1.6549-.2279 2.0424-.3789.5133-.1992.88-.4375 1.265-.8225.3652-.3549.6463-.7872.8225-1.265.151-.3875.33-.9699.3789-2.0424.0526-1.1599.0642-1.5082.0642-4.4452s-.0116-3.28533-.0642-4.44522c-.0489-1.0725-.2279-1.65489-.3789-2.04234-.1992-.51333-.4375-.88-.8225-1.265-.385-.38438-.7517-.62333-1.265-.82255-.3875-.15095-.9699-.33-2.0424-.37889zm-5.8497 12.3449c.4453.1845.9225.2794 1.4045.2794.9735 0 1.907-.3867 2.5953-1.075.6884-.6883 1.0751-1.6219 1.0751-2.5953s-.3867-1.907-1.0751-2.59532c-.6883-.68832-1.6218-1.07502-2.5953-1.07502-.482 0-.9592.09494-1.4045.27939-.4454.18445-.84997.4548-1.19079.79563-.34082.34082-.61118.74542-.79563 1.19072s-.27938.9226-.27938 1.4046.09493.9593.27938 1.4046.45481.8499.79563 1.1907.74539.6112 1.19079.7956zm-2.59345-7.38889c1.06033-1.06033 2.49845-1.65602 3.99795-1.65602 1.4996 0 2.9377.59569 3.998 1.65602s1.656 2.49849 1.656 3.99799-.5957 2.9376-1.656 3.998c-1.0603 1.0603-2.4984 1.656-3.998 1.656-1.4995 0-2.93762-.5957-3.99795-1.656-1.06033-1.0604-1.65602-2.4985-1.65602-3.998s.59569-2.93766 1.65602-3.99799zm10.90565-.81363c.2506-.25065.3914-.59059.3914-.94505 0-.35447-.1408-.69441-.3914-.94505-.2507-.25064-.5906-.39145-.9451-.39145-.3544 0-.6944.14081-.945.39145-.2507.25064-.3915.59058-.3915.94505 0 .35446.1408.6944.3915.94505.2506.25064.5906.39145.945.39145.3545 0 .6944-.14081.9451-.39145z" fill="#000" fill-rule="evenodd"/>
                    </svg>
                </section>
            </section>
        </section>
	</body>
</html>