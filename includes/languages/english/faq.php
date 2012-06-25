<?php
define('NAVBAR_TITLE', 'FAQ');
define('HEADING_TITLE', 'FAQ');
define('TEXT_INFORMATION', 'How work the <b> membership card </b>
<br /><br />
Two applications for membership to become a member:
<br /><br />'.
($cards->list['card1']['enabled'] ? '- <span Class="blue"> Member SAPHIR </span>: Card test '.$cards->list['card1']['duration'].' months without engament : <span class="red bold">'.$currencies->format($cards->list['card1']['price']).'</span><br /><br />' : '') .
($cards->list['card2']['enabled'] ? '- <span Class="red"> Member RUBY </span>: Map Member '.$cards->list['card2']['duration'].' months : <span class="red">'.$currencies->format($cards->list['card2']['price']).'</span> (<span class="fushia"> -50% savings </span>)<br /><br />' : '') .
($cards->list['card3']['enabled'] ? '- <span Class="gold"> GOLD Member </span>: Card Member '.$cards->list['card3']['duration'].' months : <span class="red bold">'.$currencies->format($cards->list['card3']['price']).'</span> (<span class="pink"> -80% savings </span>)<br /><br />' : '') .
'Whatever the formula <b></b>, the subscription club allows you to save up to 80% <span class="pink"></span> on tariffs shops all year round!
<br /><br />
<b> What is the difference between the formulas </b>
<br /><br />
The most economical formula is <span class="gold"> GOLD Member </span><span class="gold bold">'.$currencies->format($cards->list['card3']['price']).'</span>. You are a member of the club for '.$cards->list['card3']['duration'].' months.
<table class="comparatif" cellpadding="0" cellspacing="0" border="1">
    <tr>
        <td align="center">Formulas</td>
        <td align="center">Prices</td>
        <td align="center">Duration</td>
        <td align="center">Benefits</td>
    </Tr>' .
	($cards->list['card1']['enabled'] ?
    '<tr>
        <td align="center" class="blue">Member SAPHIR</td>
        <td align="center" class="red bold">'.$currencies->format($cards->list['card1']['price']).'</td>
        <td align="center">'.$cards->list['card1']['duration'].' months</td>
        <td align="center" class="pink">&nbsp;</td>
    </Tr>' : '') .
	($cards->list['card2']['enabled'] ?
    '<tr>
        <td align="center" class="red"> Member RUBY</td>
        <td align="center"><span class="red bold">'.$currencies->format($cards->list['card2']['price']).'</span></td>
        <td align="center">'.$cards->list['card2']['duration'].' months</td>
        <td align="center" class="pink">-50% savings</td>
    </Tr>' : '') .
	($cards->list['card3']['enabled'] ?
    '<tr>
        <td align="center" class="gold">GOLD Member</td>
        <td align="center"><span class="red bold">'.$currencies->format($cards->list['card3']['price']).'</span></td>
        <td align="center">'.$cards->list['card3']['duration'].' months</td>
        <td align="center" class="pink">Up -80% savings</td>
    </Tr>' : '') .
    '<tr>
        <td align="center" colspan="4">
            <b>Whatever the formula</b>, the subscription club allows you to save up to <span class="pink">80%</span> on tariffs shops all year round!
       </td>
    </Tr>
</Table>
<br />
<b>Can I take the same formula ?</b>
<ul><li>
You can choose to buy the same formula or another.
</Li></ul>
The most economical formula is the <span class="gold">GOLD Member</span>  <span class="gold bold">'.$currencies->format($cards->list['card3']['price']).'</span>. You are a member of the club for '.$cards->list['card3']['duration'].' months.');
?>