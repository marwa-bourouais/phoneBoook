
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
    <title>Nouveau compte</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Entrer vos coordonnées:</div>
            <div class="panel-body">
                <form method="post"  action="insertuser.php" class="form" >   
            
                     <div class ="form-group">
                    <label for="nome"> Nom:</label>
                    <input type="text" name="nome" placeholder="Veuillez entrer le nom en majuscule" class="form-control"  />  
                    </div>
                    
                    <div class ="form-group">
                    <label for="prenome"> Prénom:</label>
                    <input type="text" name="prenome" placeholder="Veuillez entrer la première lettre du prénom en majuscule" class="form-control"  />  
                    </div>
                    
                      <div class ="form-group">
                    <label for="login"> Nom d'utilisateur:</label>
                    <input type="text" name="login" placeholder="Nom d'utilisateur" class="form-control"  />  
                    </div>
                    
                    <div class ="form-group">
                    <label for="email"> email:</label>
                    <input type="text" name="email" placeholder="E-mail" class="form-control"  />  
                    </div>
                    
                    
                    <div class ="form-group">
                    <label for="pwd">Mot de passe:</label>
                    <input type="password" name="pwd" placeholder="Mot de passe" class="form-control"  />  
                    </div>
                        
                        
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"> </span>
                        Enregister...</button>
                    
                </form>
            </div>
        </div>
        </div>
    </body>
</html>