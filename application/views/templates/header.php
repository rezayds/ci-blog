<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CodeIgniter Blog</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/master.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert.css">
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a href="<?php echo base_url()?>" class="navbar-brand">CodeIgniter 3 Blog</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url() ?>posts">Posts</a></li>
                    <li><a href="<?php echo base_url() ?>categories">Categories</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(!$this->session->userdata('logged_in')) : ?>
                    <li><a href="<?php echo base_url() ?>users/register">Register</a></li>
                    <li><a href="<?php echo base_url() ?>users/login">Login</a></li>
                    <?php endif; ?>
                    <?php if($this->session->userdata('logged_in')) : ?>
                    <li><a href="<?php echo base_url() ?>posts/create">Create Post</a></li>
                    <li><a href="<?php echo base_url() ?>categories/create">Create Category</a></li>
                    <li><a href="<?php echo base_url() ?>users/logout">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <div class="container">
            <?php  
            $success_message = $this->session->flashdata('success_message');
            $error_message = $this->session->flashdata('error_message');  
            if (!empty($success_message)) {
                echo '<div class=\'alert alert-success text-center\' role=\'alert\'>'.$success_message.'</div>'; 
            }elseif (!empty($error_message)) {
                echo '<div class=\'alert alert-danger text-center\' role=\'alert\'>'.$error_message.'</div>'; 
            } 
            ?>
