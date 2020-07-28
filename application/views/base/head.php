<?php
defined('BASEPATH') or exit('No direct script access allowed');
$actual_link = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$og_titulo = 'Quick Sales';
$og_img = base_url('assets/ai/default.jpg');
if (isset($base_og))
    if (!$base_og) {
        $og_titulo = $pagina['titulo'];
    }
?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Site configs  -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/ai/quick mini red.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/ai/quick mini red.png'); ?>">
    <title>
        <?php
        if (isset($titulo)) :
            echo $titulo;
        else :
            echo $pagina['titulo'];
        endif;
        ?>
    </title>
    <?php
    if (isset($description)) {
        echo '<meta name="description" content="' . $description . '" >';
    }else{
        $description = '';
    }
    ?>

    <meta property="og:title" content="<?php echo $og_titulo; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo $actual_link; ?>" />
    <meta property="og:image" content="<?php echo $og_img ?>" />
    <meta property="og:site_name" content="Quick Sales" />
    <meta property="og:description" content="<?php echo $description; ?>" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sweetalert2/sweetalert2.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom/main.css'); ?>" />
    <?php
    if (isset($links)) {
        foreach ($links as $link) {
            echo '<link rel="stylesheet" href=' . base_url($link) . ' >
                ';
        }
    }
    ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167036208-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-167036208-1');
    </script>

</head>

<body>
    <input type="hidden" id="base" value="<?php echo base_url(); ?>">