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
        <a class="nav-link active" aria-current="page" href="<?php echo base_url().'index.php/emploie/index';?>"> Emploies</a>
        </li>
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/serv';?>">Service</a>
        </li>
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/Congeindex';?>">Conge</a>
        </li>
        
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/emploindex';?>">Employeur</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="<?php echo base_url().'index.php/emploie/demande';?>">Demande Congé</a>
        </li>
        
    </ul>
    <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        
    </form>
    </div>
</div>
</nav><br>
<div class="container">
<H4>Demander un congé</H4><hr>
<form method="post" name =" createEmploie" action="<?php echo base_url().'index.php/emploie/dema';?>">
    <div class="row">
        
        <div class="col-md-8 ">
                
        <!--div class="form-floating">
            <input type="text" class="form-control" placeholder=" " value="<!-?php echo set_value('matricule');?>" name="matricule" id="floatingInput" aria-label="First name">
                <label for="floatingInput">Matricule</label>
                <!-?php echo form_error('Matricule');?>
        </div><br-->
        <div class="form-floating">
            <select class="form-select" id="floatingSelect" name="matricule" aria-label="Floating label select example">
                <option >Selectionner</option>
                <?php if($emplo->num_rows() > 0) { foreach($emplo->result() as $row){?>
                <option><?php echo $row->MATRICULE;?></option>
                <?php } }?>
        
            </select>
            <label for="floatingSelect">Matricule</label>
        </div><br>
        <div class="form-floating">
            <select class="form-select" id="floatingSelect" name="codeconge" aria-label="Floating label select example">
                <option >Selectionner</option>
                <?php if($conge->num_rows() > 0) { foreach($conge->result() as $row){?>
                <option><?php echo $row->CODECONGE;?></option>
                <?php } }?>
        
            </select>
            <label for="floatingSelect">Code Congé</label>
        </div><br>
        <div class="form-floating mb-1">
                    <input type="date" class="form-control" placeholder=" " value="<?php echo set_value('libelle');?>" name="datedebut" id="floatingInput" aria-label="First name">
                    <label for="floatingInput">Date Debut</label>
                    <?php echo form_error('libelle');?>
        </div><br>
        <div class="form-floating mb-1">
                    <input type="date" class="form-control" placeholder=" " value="<?php echo set_value('libelle');?>" name="daterep" id="floatingInput" aria-label="First name">
                    <label for="floatingInput">Date Reprendre</label>
                    <?php echo form_error('libelle');?>
        </div><br>
        <div alight="right">
            <button type="submit" id="submit"  name="submit" class="btn btn-dark">Ajouter</button>
            <a href="<?php echo base_url().'index.php/emploie/demande';?>" class="btn btn-danger">Annuler</a>
        </div> 
           
        </div>
            
       
    </div>
</form>
</div>

</body>