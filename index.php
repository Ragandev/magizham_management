<?php
include('header.php');
?>
<div class="log-box">
    <div class="log-box-inn">
        <div class="main-box">
            <!-- Php for error handling -->
            <?php if (!empty($_GET['succ'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>
                        <?php echo $_GET['succ'] ?>
                    </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php if (!empty($_GET['err'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>
                        <?php echo $_GET['err'] ?>
                    </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <h2 class="mb-3">Login</h2>
            <hr>
            <form class="forms-sample" method="post" action="login-post.php">
                <div class="form-group">
                    <label for="#username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="#pass">Password</label>
                    <input type="password" class="form-control" name="password" id="pass" placeholder="Password">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>