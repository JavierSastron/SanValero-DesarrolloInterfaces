<?php
$conectado = 'publico';
if (isset($_SESSION['user'])) {
    $conectado = 'admin';
}

$T_PERMISSION = 'ambito';
$T_NOMBRE = 'texto';
$T_FUNCTION = 'url';
$public = 'publico';
$admin = 'admin';
$child = 'suboption';
$html = '';
$html .= '<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Menú</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" 
                           aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class=navbar-nav>';
foreach ($data[0] as $option) {
    if ($option[$T_PERMISSION] == $public || $option[$T_PERMISSION] == $conectado) {
        if ($conectado == $option[$T_PERMISSION] || $option[$T_PERMISSION] == $public) {
            if (isset($option[$child])) {
                $html.= '<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                .$option[$T_NOMBRE].
                '</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                foreach ($option[$child] as $submenu) {
                    $html.= '<a class="dropdown-item" onclick="'.$submenu[$T_FUNCTION].'" href="#">
                        '.$submenu[$T_NOMBRE].'
                        </a>';
                }
                $html.= '</div>
                        </li>';
            } else {
                $html .= '<li class="nav-item">
                            <a class="nav-link" href="#">'.$option[$T_NOMBRE].'</a>
                        </li>';
            }
        }
    }
}
$html .=        '</ul>
            </div>
        </nav>';
echo $html;
?>