<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo tableau</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-
                T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "chambord";
//On essaie de se connecter
try {
    $conn = new PDO(
        "mysql:host=$servername;dbname=$dbname",
        $username,
        $password
    );
    //On définit le mode d'erreur de PDO sur Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connexion réussie';
}
/*On capture les exceptions si une exception est lancée et on affiche *les
informations relatives à celle-ci*/ catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<?php

try {
    /*Sélectionne toutes les valeurs dans la table contact*/
    $sql = "SELECT * FROM contact";
    $stmt = $conn->query($sql);
    /*Retourne un tableau associatif pour chaque entrée de notre table
                    *avec le nom des colonnes sélectionnées en clefs*/
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    /*
    # print_r permet un affichage lisible des résultats,<pre> rend le tout 
    # un peu plus lisible, permet de visualiser le contenu du tableau
     
    echo '<pre>';
    print_r($resultat);
    echo '</pre>';
    */
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                databs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" ariaexpanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" arialabel="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="col-md-7 my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="container my-5">
                    <table class="table table-hover">
                        <th style="background-color: black; color:white;">id</th>
                        <th style="background-color: black; color:white;">nom</th>
                        <th style="background-color: black; color:white;">prenom</th>
                        <th style="background-color: black; color:white;">date-naissance</th>
                        <th style="background-color: black; color:white;">sujet</th>
                        <th style="background-color: black; color:white;">Edit</th>
                        <th style="background-color: black; color:white;">Delete</th>
                        <?php foreach ($resultat as $leContact): ?>
                            <tr>
                                <td><?php echo $leContact['ID']; ?></td>
                                <td><?php echo $leContact['NOM']; ?></td>
                                <td><?php echo $leContact['PRENOM']; ?></td>
                                <td><?php echo $leContact['NAISSANCE']; ?></td>
                                <td><?php echo $leContact['OBJET']; ?></td>
                                <td>
                                    <button class="btn btn-primary">
                                        <a href="editContact.php?ID=<?= $leContact['ID']; ?>" style="color: white; list-style: none;">Edit</a>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger">
                                        <a href="deleteContact.php?ID=<?= $leContact['ID']; ?>" style="color: white; list-style: none;">Delete</a>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="container my-5">
        <p>Copyright &copy; Mon application 2026</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>

</html>