



<?php include 'header.php' ;?>

<form action="actions/post-picture.php" method="POST" enctype="multipart/form-data">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">titre</label>
      <input type="text" class="form-control" id="validationDefault01" name="title" placeholder="title" value="Mark" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Text</label>
      <input type="text" class="form-control" id="validationDefault02" name="text" placeholder="Text" value="Otto" required>
    </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault03">image</label>
      <input type="file" class="form-control" id="validationDefault03" name="uploadPicture" placeholder="image" required>
    </div>
</div>
  <button class="btn btn-primary" type="submit">Submit form</button>
</form>

