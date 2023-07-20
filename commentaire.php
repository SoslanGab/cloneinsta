



<?php include 'header.php' ;?>

<div class="px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Ajouter un commentaire</h3>
            <p class="blue-text">Veuillez remplir ce formulaire pour pouvoir envoyer votre post </p>
            <div class="">
                <!-- <h5 class="text-center mb-4">Powering world-class companies</h5> -->
                <form class="form-card" action="actions/post-comment.php" method="POST" enctype="multipart/form-data">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">First name<span class="text-danger"> *</span></label> <input type="text" id="fname" name="fname" placeholder="Enter your first name">
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Last name<span class="text-danger"> *</span></label> <input type="text" id="lname" name="lname" placeholder="Enter your last name">
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Business email<span class="text-danger"> *</span></label> <input type="text" id="email" name="email" placeholder="" onblur="validate(3)">
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Phone number<span class="text-danger"> *</span></label> <input type="text" id="mob" name="mob" placeholder="" onblur="validate(4)">
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