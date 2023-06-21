<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <head>
    </head>
    <title>laravel</title>
    <body>
    
    <div class="card-body">
    
        <div class="container">
            
            <br><br><br>
            
                <form action="store-company" method="POST">
                <?php echo csrf_field(); ?>
                
                <div class="form-group mb-3">
                      <label for="">BRC</label>
                      <input type="text" name="BRC" class="form-control">
                </div>
                
                
                <div class="form-group mb-3">
                      <label for="">Name</label>
                      <input type="text" name="Name" class="form-control">
                </div>
                
                
                <div class="form-group mb-3">
                      <label for="">Contact_Person</label>
                      <input type="text" name="Contact_Person" class="form-control">
                </div>
                
                
                <div class="form-group mb-3">
                      <label for="">Mobile</label>
                      <input type="text" name="Mobile" class="form-control">
                </div>


                <div class="form-group mb-3">
                      <label for="">Email</label>
                      <input type="text" name="Email" class="form-control">
                </div>
                
       
                 <div class="form-group mb-3">
                      <button type="submit" class="btn-btn-primary">Submit</button>
                </div>               
                
                    </form> 
                    
                </div>
    </body>
</html><?php /**PATH /data/RiskRegistry/resources/views/form.blade.php ENDPATH**/ ?>