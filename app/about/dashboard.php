<?php

// Path: app/about/dashboard.php
// Requisito: o usuário deve estar logado para acessar a página.
// Objetivo: exibir uma página com informações sobre o sistema.
require_once '../../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!$user->isLoggedIn()) {
    header('Location: /index.php');
    exit;
}

require_once '../database_layer.php'; // Inclua seu arquivo de conexão com o banco de dados

$visitors = getTotalVisitors();

$downloadsResult = getDownloads();

$usersResult = getUsers();

?>

<!DOCTYPE html>
<style>
    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 500px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
    }   
    
    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }
    .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }

    
</style>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    
    <h4>Número de Acessos</h4>
    <table class="styled-table" border="1">
        <tbody>
            <tr>
                <td><?php echo $visitors; ?></td>
            </tr>
        </tbody>
    </table>
    <h4>Downloads</h4>
        <table class="styled-table" border="1">
            <thead>
                <tr>
                    <th>Autor do Download</th>
                    <th>Número de Downloads</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($downloadsResult as $row) { ?>
                <tr>
                    <td><?php echo $row->username; ?></td>
                    <td><?php echo $row->total_downloads; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    <h4>Lista de Usuários</h4>
    <table class="styled-table" border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Location</th>
            <th>Institution</th>
        </tr>
        <?php foreach ($usersResult as $row) { ?>
        <tr>
            <td><?php echo $row->id; ?></td>
            <td><?php echo $row->username; ?></td>
            <td><?php echo $row->email; ?></td>
            <td><?php echo $row->locale; ?></td>
            <td><?php echo $row->institution; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>


<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>