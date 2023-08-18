<?php
include('header.php');
include('menu.php');
?>
<?php if (!empty($_GET['succ'])): ?>
					  
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php  echo $_GET['succ'] ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                                        <?php endif ?>
                                        <?php if (!empty($_GET['err'])): ?>
                                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?php  echo $_GET['err'] ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>  
                                        <?php endif ?>
<div class="main-box">
    <h2 class="mb-3">Create User</h2>
    <hr>
    <form class="forms-sample" method="post" action="create-user-post.php">
        <div class="row">
            <div class="col-6">

                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder="Name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputEmail3">Username</label>
                    <input type="text" class="form-control" name="username" id="exampleInputEmail3" placeholder="Username">
                </div>

            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="exampleInputPassword4">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword4" placeholder="Password">
                </div>

            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleSelectGender">Role</label>
                    <select class="form-control" id="exampleSelectGender" name="role">
                        <option value="Admin">Admin</option>
                        <option value="Branch Manager">Branch Manager</option>
                        <option value="Store Manager">Store Manager</option>
                        <option value="Kitchen Manager">Kitchen Manager</option>
                    </select>
                </div>

            </div>
            <div class="col-6">
            <div class="form-group">
                    <label for="exampleSelectGender">Branch</label>
                    <select class="form-control" id="exampleSelectGender" name="branch">
                        <option value="Main Branch">Main Branch</option>
                        <option value="Branch 1">Branch 1</option>
                        <option value="Branch 2">Branch 2</option>
                        <option value="Branch 3">Branch 3</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
    </form>
</div>

<?php
include('footer.php');
?>
