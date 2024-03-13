<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="<?php echo base_url().'assets/Bootstrap/css/bootstrap.min.css';?>" rel="stylesheet" type="text/css"/>
    <title>Gestion personnel</title>
    
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
<div class="container-fluid">
    <a class="navbar-brand" href="#">Gp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/index';?>">Accueil</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="<?php echo base_url().'index.php/emploie/index';?>"> Etablissement</a>
        </li>
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/serv';?>">Domaine</a>
        </li>
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/Congeindex';?>">Mention</a>
        </li>
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/Congeindex';?>">Parcours</a>
        </li>
        
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/emploindex';?>">Etudiant</a>
        </li>
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/demande';?>">Demande Congé</a>
        </li>
        
    </ul>
    <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        
    </form>
    </div>
</div>
</nav><br>
<div class="container">
<H4>Ajouter un Etablissement</H4><hr>
<form method="post" name =" createEmploie" action="<?php echo base_url().'index.php/emploie/create';?>">
    <div class="row">
        
        <div class="col-md-8 ">
                
                <div class="form-floating mb-1">
                    <input type="text" class="form-control" placeholder=" " value="<?php echo set_value('code');?>" name="code" id="floatingInput" aria-label="First name">
                    <label for="floatingInput">Code Etablissement</label>
                    <?php echo form_error('code');?>

                </div><br>
                <div class="form-floating mb-1">
                    <input type="text" class="form-control" placeholder=" " value="<?php echo set_value('nom');?>" name="nom" id="floatingInput" aria-label="First name">
                    <label for="floatingInput">Nom Etablissement</label>
                    <?php echo form_error('nom');?>

                </div><br>
                <div alight="right">
                    <button type="submit" id="submit"  name="submit" class="btn btn-dark">Ajouter</button>
                    <a href="<?php echo base_url().'index.php/emploie/index';?>" class="btn btn-danger">Annuler</a>
                </div> 
           
        </div>
            
       
    </div>
</form>
</div>

</body>