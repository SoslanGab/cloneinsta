



<?php include 'header.php' ;?>


<div class="px-1 py-5 mx-auto border">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-12 text-center">
            <h2>Ajouter un post</h2>
            <p class="blue-text">Veuillez remplir ce formulaire pour pouvoir envoyer votre post </p>
            <div class="">
                <!-- <h5 class="text-center mb-4">Powering world-class companies</h5> -->
                <form class="form-card" action="actions/post-picture.php" method="POST" enctype="multipart/form-data">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-12 flex-column d-flex"> 
                            <label class="form-control-label px-3">Titre<span class="text-danger"> *</span></label> <input type="text" id="validationDefault01" name="title" placeholder="Entrer votre titre">
                        </div>
                        <div class="form-group col-sm-12 flex-column d-flex"> 
                            <label class="form-control-label px-3">Text<span class="text-danger"> *</span></label> <textarea name="text" id="validationDefault02" cols="30" rows="10" placeholder="Entrer votre text"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-12 flex-column d-flex"> 
                            <label class="form-control-label px-3">Image<span class="text-danger"> *</span></label> <input type="file"  id="validationDefault03" name="uploadPicture" placeholder="image" onblur="validate(3)">
                        </div>
                    </div>   
                    <div class="row justify-content-center">
                        <div class="form-group col-sm-12"> <button type="submit" class="btn-block btn-primary">Publier</button> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
 include 'footer.php';
 ?>