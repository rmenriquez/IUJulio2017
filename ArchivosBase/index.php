<?php

include '../pruebasVarias/views/ARTICULO_SHOWALL_View.php';

$field_list = ["CodigoA","AutoresA", "TituloA", "ISSN", "VolumenR", "PagIniA", "PagFinA", "FechaPublicacionR", "EstadoA"];
$ar = [["CodigoA"=> "01",
    "AutoresA" => "Raquel Marcos",
    "TituloA" => "Como aprobar IU",
    "ISSN"=>"0987654321",
    "VolumenR"=>"R15",
    "PagIniA"=>"2",
    "PagFinA"=>"16",
    "FechaPublicacionR"=>"15/02/2015",
    "EstadoA"=>"Publicado"],

    ["CodigoA" => "07",
        "AutoresA" => "Marcos Peiteado",
        "TituloA" => "Como aprobar BDII",
        "ISSN"=>"09876832514",
        "VolumenR"=>"M4",
        "PagIniA"=>"7",
        "PagFinA"=>"12",
        "FechaPublicacionR"=>"21/03/2013",
        "EstadoA"=>"Enviado"]];

$view = new ARTICULO_SHOWALL_View($field_list, $ar);
$view->render();
