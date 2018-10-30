<style>
    .bblue
    {
        border-radius: 100px;
        padding: 10px;
      
    }
    
    .navbar {
      margin-bottom: 0px;
        
      background-color: ghostwhite;
      z-index: 9999;
      border: 0;
      font-family: sans-serif;
      font-size: 50px !important;
      
    
    }
    
    .navbar li a,
    .navbar .navbar-brand 
    {
      color: black;
       margin-top: 5px;
       margin-bottom: 5px;
        
        
    }
    
    .navbar-nav li a:hover,
    .navbar-nav li.active a {
      color: bisque!important;
        
       
       
      background-color:   darkblue !important ;
      border-radius: 50px;
        border-width: thick;
       
        
       
    
        
    }
    
    .navbar-default .navbar-toggle {
      border-color: transparent;
      
    }
    
    #hamburger .icon-bar {
      background: transparent;
    }
    
    #hamburger:hover,
    #hamburger.is-active {
      background: darkblue !important;
    }
    
    
    

    
   
</style>

<div  class="navbar navbar-default navbar-fixed_top ">
    <div class="container-fluid">
 <button type="button" class="navbar-toggle"   data-target="#myNavbar" id="hamburger">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        
 
        
     <ul class="nav navbar-nav navbar-left">
    <li><img src="../images/Algerie_Presse_Service.svg.png" height=85px width=110px/></li>
</ul>
      <div class="collapse navbar-collapse" id="my-navbar">
<ul class="nav navbar-nav navbar-left">
    <li ><a href="accueil.php"><h4 class="bblue" text-align="center">Accueil</h4>
        </a></li>
     <li ><a href="chercherservice.php"><h4 class="bblue" text-align="center">Directions et services</h4>
        </a></li>
     <li><a href="chercherbureau.php"><h4 class="bblue" text-align="center">Bureaux</h4>
        </a></li>
    <li><a href="chercheremploye.php"><h4 class="bblue" text-align="center">Employés</h4>
        </a></li>
    
</ul>
    <ul class="nav navbar-nav navbar-right">
    <li> <a  href="login.php" ><h4 class="bblue" text-align="center"><span class="glyphicon glyphicon-user"></span>Se connecter</h4></a></li>

    
</ul>
          </div>
       
</div>
</div>

