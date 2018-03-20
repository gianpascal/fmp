<?php

header("Content-type: text/xml");
print '<?xml version="1.0" encoding="iso-8859-1"?>';
        print '<tree  id="0">';
        print '<item  text="Reportes Essalud" id="0" open="1"  call="1" select="1">';
                print '<item text="Mamografia" id="1|Mamografia"></item>';
                print '<item text="Papanicolaou" id="2|Papanicolaou"></item>';
                print '<item text="HCPreventivas" id="3|HCPreventivas"></item>';
                print '<item text="OperacinalVIH" id="4|OperacinalVIH"></item>';
                print '<item text="OperacionalTBC" id="5|OperacionalTBC"></item>';
                print '<item text="NSIG" id="6|NSIG"></item>';
                print '<item text="Embarazadas" id="7|Embarazadas"></item>';
        print '</item>';
print '</tree>';
?>
