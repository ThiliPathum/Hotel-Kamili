<?php
if (isset($_SESSION['message'])):
?>
    <div class="alert alert-success alert-dismissible fade show " role="alert" style="background-color:#d4edda; border:none; padding: 1rem 1rem; font-size: 14px;">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
unset($_SESSION['message']);
endif;

if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])):
?>
    <div class="alert alert-danger alert-dismissible fade show " role="alert" style="background-color:#f8d7da; border:none; padding: 1rem 1rem; font-size: 14px;">
        <?php foreach ($_SESSION['errors'] as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
unset($_SESSION['errors']);
endif;
?>