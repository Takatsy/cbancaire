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
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/index';?>"> Emploies</a>
        </li>
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/serv';?>">Service</a>
        </li>
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/Congeindex';?>">Conge</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="<?php echo base_url().'index.php/emploie/emploindex';?>">Employeur</a>
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
<H4>Modifier un Employeur</H4><hr>
<form method="post" name =" createEmploie" action="<?php echo base_url().'index.php/emploie/editEmplo/'.$emplo['MATRICULE'];?>">
    <div class="row">
        
        <div class="col-md-6 ">
                
                <div class="form-floating mb-1">
                    <input type="text" class="form-control" placeholder=" " value="<?php echo set_value('code',$emplo['MATRICULE']);?>" name="matricule" id="floatingInput" aria-label="First name">
                    <label for="floatingInput">Matricule</label>
                    <?php echo form_error('code');?>

                </div><br>
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" name="codeservice" aria-label="Floating label select example">
                        <option ><?php echo set_value('code',$emplo['CODESERVICE']);?></option>
                        <option ></option>
                        <?php if(!empty($service)) { foreach($service as $services){?>
                        <option><?php echo $services['CODESERVICE']?></option>
                        <?php } }?>
                
                    </select>
                    <label for="floatingSelect">Code Service</label>
                </div><br>
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" name="codeemploie" aria-label="Floating label select example">
                        <option ><?php echo set_value('code',$emplo['CODEEMPLOIS']);?></option>
                        <option ></option>
                        <?php if(!empty($emploies)) { foreach($emploies as $emploie){?>
                        <option><?php echo $emploie['CODEEMPLOIS']?></option>
                        <?php } }?>
                
                    </select>
                    <label for="floatingSelect">Code Emploie</label>
                </div><br>
                <div class="form-floating mb-1">
                    <input type="date" class="form-control" placeholder=" " value="<?php echo set_value('libelle',$emplo['DATEENTRE']);?>" name="dateentrer" id="floatingInput" aria-label="First name">
                    <label for="floatingInput">Date d'entrer</label>
                    <?php echo form_error('libelle');?>

                </div><br>
               
        </div>
        <div class="col-md-6 ">
        <div class="form-floating mb-1">
                    <input type="text" class="form-control" placeholder=" " value="<?php echo set_value('libelle',$emplo['NOM']);?>" name="nom" id="floatingInput" aria-label="First name">
                    <label for="floatingInput">Nom</label>
                    <?php echo form_error('libelle');?>
        </div><br>
        <div class="form-floating mb-1">
                    <input type="text" class="form-control" placeholder=" " value="<?php echo set_value('code',$emplo['PRENOM']);?>" name="prenom" id="floatingInput" aria-label="First name">
                    <label for="floatingInput">Prénom</label>
                    <?php echo form_error('code');?>

                </div><br>
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" name="sexe" aria-label="Floating label select example">
                        <option ><?php echo set_value('code',$emplo['SEXE']);?></option>
                        <option ></option>
                        <option>Homme</option>
                        <option>Femme</option>
                
                    </select>
                    <label for="floatingSelect">Sexe</label>
                </div><br>
                
                <div class="form-floating mb-1">
                    <input type="number" class="form-control" placeholder=" " value="<?php echo set_value('libelle',$emplo['TELEPHONE']);?>" name="tel" id="floatingInput" aria-label="First name">
                    <label for="floatingInput">Telephone</label>
                    <?php echo form_error('libelle');?>

                </div><br>

        </div>
               
                <div alight="right">
                    <button type="submit" id="submit"  name="submit" class="btn btn-dark">Modifier</button>
                    <a href="<?php echo base_url().'index.php/emploie/Congeindex';?>" class="btn btn-danger">Annuler</a>
                </div> <br><br>
           
        </div>
            
       
    </div>
</form>
</div>

</body>