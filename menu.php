<style>
    .bblue
    {
        border-radius: 100px;
        padding: 10px;
    }
    
    .navbar {
      margin-bottom: 0;
      background-color: ghostwhite;
      z-index: 9999;
      border: 0;
      font-family: sans-serif;
      font-size: 80px !important;
      border-radius: 0;
    
    }
    
    .navbar li a,
    .navbar .navbar-brand {
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
      color: #ffffff;
    }
    
    #hamburger .icon-bar {
      background: white;
    }
    
    #hamburger:hover,
    #hamburger.is-active {
      background: skyblue !important;
    }
    
    #hamburger:hover .icon-bar,
    #hamburger.is-active .icon-bar {
      background: #F4511e !important;
    }
    
    #hamburger:focus {
      background: #F4511e;
    }
    
    #hamburger:focus .icon-bar {
      background: #FFF;
    }

    
   
</style>

<div  class="navbar navbar-default navbar-fixed_top ">
    <div class="container-fluid">
 <button type="button" class="navbar-toggle"  data-target="#myNavbar" id="hamburger">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        
 
        
     <ul class="nav navbar-nav navbar-left">
    <li><img src="../images/Algerie_Presse_Service.svg.png" height=85px width=110px/></li>
</ul>
      <div class="collapse navbar-collapse" id="my-navbar">
<ul class="nav navbar-nav navbar-left">
   
     <li ><a href="services.php"><h4 class="bblue" text-align="center">Directions et services</h4>
        </a></li>
     <li><a href="bureaux.php"><h4 class="bblue" text-align="center">Bureaux</h4>
        </a></li>
    
    <li><a href="employes.php"><h4 class="bblue" text-align="center">Employés</h4>
        </a></li>
     <li ><a href="externe.php"><h4 class="bblue" text-align="center"> Externe </h4>
        </a></li>
    
    <li ><a href="utilisateurs.php"><h4 class="bblue" text-align="center"> Utilisateurs </h4>
        </a></li>
</ul>
    <ul class="nav navbar-nav navbar-right">
    <li> <a   href="sedeconnecter.php" onclick="return confirm('Etes vous sur de vouloir vous déconnecter?')"><h4 class="bblue" text-align="center"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</h4></a></li>

    
</ul>
          </div>
       
</div>
</div>

