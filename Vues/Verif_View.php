<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Téléchargement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .logo {
            max-width: 300px;
            margin: 0 auto 20px;
        }

        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .custom-file-upload:hover {
            background-color: #2980b9;
        }

        .submit-button {
            background-color: #27ae60;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #1e8449;
        }

        .file-info {
            margin: 10px 0;
        }
    </style>


</head>
<body>
    <div class="container">
        <img class="logo" src="">
        <h2>Formulaire de Téléchargement</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td width="25%">schema</td>
                    <td><label for="file1" class="custom-file-upload">Parcourir</label>
                    <input type="file" id="file1" name="file1">
                    <p class="file-info" id="file-info1">Aucun fichier sélectionné</p></td>
                </tr>
                <tr>
                    <td>data</td>
                    <td><label for="file2" class="custom-file-upload">Parcourir</label>
                    <input type="file" id="file2" name="file2">
                    <p class="file-info" id="file-info2">Aucun fichier sélectionné</p></td>
                </tr>
            </table>
            <button type="submit" class="submit-button" name="btnVerif">Envoyer</button>
        </form>
    </div>
</body>
</html>

<!-- JavaScript pour afficher le nom du fichier sélectionné -->
<script>
    document.getElementById("file1").addEventListener("change", function() {
        var fileName = this.value.split("\\").pop();
        document.getElementById("file-info1").textContent = this.value;
    });

    document.getElementById("file2").addEventListener("change", function() {
        var fileName = this.value.split("\\").pop();
        document.getElementById("file-info2").textContent = fileName;
    });
</script>