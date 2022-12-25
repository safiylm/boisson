<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">

        <a href="../index.php" class="navbar-brand"> Boisson</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                <?php if (!empty($_SESSION['user']['login'])) { ?>
                    <li class="nav-item">
                        <a href="../compte/" class="nav-link active" aria-current="page"><?php echo $_SESSION['user']['login']; ?> </a>
                    </li>

                <?php }  ?>

                <li class="nav-item">
                    <a href="../favori/" class="nav-link " aria-current="page">Mes recettes préférées </a>
                </li>
                <li class="nav-item">
                    <a href="../hierarchie ingredients/" class="nav-link " aria-current="page">Hierarchie des Recettes </a>
                </li>
                

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Compte
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (empty($_SESSION['user']['login'])) { ?>
                            <li><a class="dropdown-item" href="../connexion/">Connexion</a></li>
                            <li><a class="dropdown-item" href="../inscription/">Inscription</a></li>
                        <?php } else {  ?>
                            <li><a class="dropdown-item" href="../deconnexion/"> Deconnexion</a></li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" action="../recherche/" method="post">
                <input name="inputSearch" list='proposals' id="recherche" class="form-control me-2" type="search" onkeyup="showHint(this.value)" placeholder="Search" aria-label="Search" style="max-width: 100%;">
                <datalist id="proposals"></datalist>

                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>

    </div>
</nav>


<script >
    
function showHint(str) {
    if (str.length == 0) {
      document.getElementById("proposals").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("proposals").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "../recherche/proposals.php?q=" + str, true);
      xmlhttp.send();
    }
  }

</script> 