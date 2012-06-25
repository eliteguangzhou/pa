<?php
define('NAVBAR_TITLE', 'Foire Aux Questions');
define('HEADING_TITLE', 'Foire Aux Questions');
define('TEXT_INFORMATION', '<b>�C�mo funciona el carn� de socio?</b>
<br /><br />
'.$cards->total.' solicitudes de adhesi�n para ser miembro :
<br /><br />'.
($cards->list['card1']['enabled'] ? '- <span class="blue">miembro SAPHIR</span> : Prueba de la tarjeta '.$cards->list['card1']['duration'].' meses sin engament : <span class="red bold">'.$currencies->format($cards->list['card1']['price']).'</span><br /><br />' : '') .
($cards->list['card2']['enabled'] ? '- <span class="red">miembro RUBIS</span> : tarjeta de afiliaci�n '.$cards->list['card2']['duration'].' meses : <span class="red">'.$currencies->format($cards->list['card2']['price']).'</span> (<span class="fushia">-50% de ahorro</span>)<br /><br />' : '') .
($cards->list['card3']['enabled'] ? '- <span class="gold">miembro GOLD</span> : tarjeta de afiliaci�n '.$cards->list['card3']['duration'].' meses : <span class="red bold">'.$currencies->format($cards->list['card3']['price']).'</span>  (<span class="pink">-80% de ahorro</span>)<br /><br />' : '') .
'<b>Sea cual sea la f�rmula</b>, miembros del club le permite ahorrar hasta un <span class="pink">80%</span> en tiendas de tarifas durante todo el a�o !
<br /><br />
<b>�Cu�l es la diferencia entre las formas?</b>
<br /><br />
La f�rmula es la forma m�s econ�mica <span class="gold">miembro GOLD</span> de <span class="gold bold">'.$currencies->format($cards->list['card3']['price']).'</span>. Usted es miembro del club desde hace '.$cards->list['card3']['duration'].' meses.
<table class="comparatif" cellpadding="0" cellspacing="0" border="1">
    <tr>
        <td align="center">F�rmulas</td>
        <td align="center">Las tasas de</td>
        <td align="center">Duraci�n</td>
        <td align="center">Beneficios</td>
    </tr>'.
	($cards->list['card1']['enabled'] ?
    '<tr>
        <td align="center" class="blue">miembro SAPHIR</td>
        <td align="center" class="red bold">'.$currencies->format($cards->list['card1']['price']).'</td>
        <td align="center">'.$cards->list['card1']['duration'].' meses</td>
        <td align="center" class="pink">�</td>
    </tr>' : '') .
	($cards->list['card2']['enabled'] ?
    '<tr>
        <td align="center" class="red">miembro RUBIS</td>
        <td align="center"><span class="red bold">'.$currencies->format($cards->list['card2']['price']).'</span></td>
        <td align="center">'.$cards->list['card2']['duration'].' meses</td>
        <td align="center" class="pink">-50% de ahorro</td>
    </tr>' : '') .
	($cards->list['card3']['enabled'] ?
    '<tr>
        <td align="center" class="gold">miembro GOLD</td>
        <td align="center"><span class="red bold">'.$currencies->format($cards->list['card3']['price']).'</span></td>
        <td align="center">'.$cards->list['card3']['duration'].' meses</td>
        <td align="center" class="pink">-80% de ahorro, tarjeta multiusuario</td>
    </tr>' : '') .
    '<tr>
        <td colspan="4" align="center">
            <b>Sea cual sea la f�rmula</b>, miembros del club le permite ahorrar hasta un <span class="pink">80%</span> en tiendas de tarifas durante todo el a�o !
        </td>
    </tr>
</table>
<br />        
<b>�Debo tomar la misma f�rmula?</b>
<ul><li>
Usted puede optar por comprar la misma forma u otra.
</li></ul>
La f�rmula es la forma m�s econ�mica <span class="gold">miembro GOLD</span> de <span class="gold bold">'.$currencies->format($cards->list['card3']['price']).'</span>. Usted es miembro del club desde hace '.$cards->list['card3']['duration'].' meses.
');
?>