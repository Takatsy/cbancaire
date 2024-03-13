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
        <a class="nav-link active" aria-current="page" href="<?php echo base_url().'index.php/emploie/Congeindex';?>">Conge</a>
        </li>
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/emploie/emploindex';?>">Employeur</a>
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
<div class="row">
    <div class ="col-md-12">
        <!--?php 
            $success = $this->session->data('Success');
            if($success !=""){
            ?>
            <div class=" alert alert-success"><-?php echo $success;?></div>
          <-?php 
            }
        ?>
        <_?php 
            $failure = $this->session->userdata('failure');
            if($failure !=""){
            ?>
            <div class=" alert alert-success"><-?php echo $failure;?></div>
          <-?php 
            }
        ?-->
    </div>
</div>
    <div class ="col-md-6">
    
        <a href="<?php echo base_url().'index.php/emploie/conge';?>" ><button class="btn btn-dark">Ajouter type congé</button></a>
    </div><br>
    <div class ="col-md-12"><H4>Liste des congés</H4></div>
    <hr>

<div class="row">
        
        <div class="col ">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Libelle</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($conge->num_rows() > 0) { foreach($conge->result() as $row){?>
                    <tr>
                        <td><?php echo $row->CODECONGE;?></td>
                        <td><?php echo $row->LIBELLECONGE;?></td>
                        <td><a href="<?php echo base_url().'index.php/emploie/editConge/'.$row->CODECONGE;?>"><button type="button" class="btn btn-outline-dark">Modifier</button></a></td>
                        <td><a href="<?php echo base_url().'index.php/emploie/deleteConge/'.$row->CODECONGE;?>"><button type="button" class="btn btn-outline-danger">Supprimer</button></a></td>
                    </tr>

                    <?php } } else {?>
                    <tr>
                        <td colspan="5">congé non trouvé</td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
      
</body>