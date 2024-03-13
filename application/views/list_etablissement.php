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
    
        <a href="<?php echo base_url().'index.php/emploie/create';?>" ><button class="btn btn-dark">Ajout Etablissement</button></a>
    </div><br>
    <div class ="col-md-12"><H4>Listes Etablissements</H4></div>
    <hr>

<div class="row">
        
        <div class="col ">
            <table class="table">
                <thead>
                    <tr>
                    
                    <th scope="col">Code</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($etablissement->num_rows() > 0) { foreach($etablissement->result() as $row){?>
                    <tr>
                          
                        
                        <td><?php echo $row->CodeEtab;?></td>
                        <td><?php echo $row->NomEtab;?></td>
                        <td><a href="<?php echo base_url().'index.php/emploie/edit/'.$row->IDEtab;?>"><button type="button" class="btn btn-outline-dark">Modifier</button></a></td>
                        <td><a href="<?php echo base_url().'index.php/emploie/delete/'.$row->IDEtab;?>"><button type="button" class="btn btn-outline-danger">Supprimer</button></a></td>
                    </tr>

                    <?php } } else {?>
                    <tr>
                        <td colspan="5">Etablissement non trouvé</td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
      
</body>