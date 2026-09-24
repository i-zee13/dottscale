<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Allomate Solutions Pagebuilder</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=0.9, user-scalable=no">

    <link rel="stylesheet" href="<?= phpb_asset('pagebuilder/grapes.min.css') ?> ">
    <link rel="stylesheet" href="<?= phpb_asset('pagebuilder/bootstrap.min.css') ?> ">
    <link rel="stylesheet" href="<?= phpb_asset('pagebuilder/bootstrap-select.min.css') ?> ">
    <link rel="stylesheet" href="<?= phpb_asset('pagebuilder/font-awesome.min.css') ?> ">
    <link rel="stylesheet" href="<?= phpb_asset('pagebuilder/toastr.min.css') ?> ">
    <link rel="stylesheet" href="<?= phpb_asset('pagebuilder/app.css') ?>">
    <?= $pageBuilder->customStyle(); ?>

    <script src="<?= phpb_asset('pagebuilder/grapes.min.js') ?>"></script>
    <script src="<?= phpb_asset('pagebuilder/underscore-min.js') ?>"></script>
    <script src="<?= phpb_asset('pagebuilder/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?= phpb_asset('pagebuilder/popper.min.js') ?>"></script>
    <script src="<?= phpb_asset('pagebuilder/bootstrap.min.js') ?>"></script>
    <script src="<?= phpb_asset('pagebuilder/bootstrap-select.min.js') ?>"></script>
    <script src="<?= phpb_asset('pagebuilder/toastr.min.js') ?>"></script>
    <script src="<?= phpb_asset('pagebuilder/beautify-html.min.js') ?>"></script>
    <?= $pageBuilder->customScripts('head'); ?>
</head>

<body>

<?php
require __DIR__ . '/pagebuilder.php';
?>

<script src="<?= phpb_asset('pagebuilder/app.js') ?>"></script>
<?= $pageBuilder->customScripts('body'); ?>
</body>
</html>
