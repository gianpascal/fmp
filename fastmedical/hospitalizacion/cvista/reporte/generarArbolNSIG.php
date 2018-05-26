<?php

/*
 * //descomentar si kieres ke salga en arbolito NECTAR
  print "<?xml version='1.0' encoding='iso-8859-1'?>";
  print'<tree id="0">';
  print '<item text="Asegurados Centro Asistencial" id="aca" open="1" im0="tombs.gif" im1="tombs.gif" im2="iconSafe.gif" call="1">';
  foreach ($arrayGrupo as $keyGRupo => $valueGrupo) {
  print '<item text="' . utf8_decode(ltrim(rtrim($valueGrupo[1]))) . '" open="1" id="grupo_' . utf8_decode(ltrim(rtrim($valueGrupo[0]))) . '"   im0="tombs.gif" im1="tombs.gif" im2="iconSafe.gif">';
  foreach ($arrayActividad as $keyActividad => $valueActividad) {
  if ('actividad_' . utf8_decode(ltrim(rtrim($valueActividad[0]))) == 'actividad_' . utf8_decode(ltrim(rtrim($valueGrupo[0])))) {
  print '<item text="'.htmlspecialchars(utf8_decode(ltrim(rtrim($valueActividad[2])))).'"  open="1" id="actividad_' . utf8_decode(ltrim(rtrim($valueGrupo[0]))) . '_' . utf8_decode(ltrim(rtrim($valueActividad[1]))) . '"    im0="tombs.gif" im1="tombs.gif" im2="iconSafe.gif">';
  foreach ($arrayServicio as $keyServicio => $valueServicio) {
  if ('grupo_' . utf8_decode(ltrim(rtrim($valueServicio[0]))) == 'grupo_' . utf8_decode(ltrim(rtrim($valueActividad[0])))) {
  if ('actividad_' . utf8_decode(ltrim(rtrim($valueServicio[1]))) == 'actividad_' . utf8_decode(ltrim(rtrim($valueActividad[1])))) {
  if (utf8_decode(ltrim(rtrim($valueServicio[3]))) != '') {
  print '<item text="' . utf8_decode(ltrim(rtrim($valueServicio[3]))) . '" id="actividad_' . utf8_decode(ltrim(rtrim($valueGrupo[0]))) . '_' . utf8_decode(ltrim(rtrim($valueActividad[1]))) . 'servicio_' . utf8_decode(ltrim(rtrim($valueServicio[2]))) . '"  im0="folderClosed.gif" im1="folderOpen.gif" im2="folderClosed.gif"></item>';
  }
  }
  }
  }
  print '</item>';
  }
  }
  print '</item>';
  }
  print '</item>';
  print '</tree>'; */


print '<rows>';
foreach ($arrayGrupo as $keyGRupo => $valueGrupo) {
    print '<row id="grupo_' . utf8_decode(ltrim(rtrim($valueGrupo[0]))) . '" >';
    print '<cell image="../../../fastmedical_front/imagen/csh_bluebooks_simedh/book.gif">' . htmlspecialchars(utf8_decode(ltrim(rtrim($valueGrupo[1])))) . '</cell>';
    print '<cell></cell>';
    print '<cell></cell>';
    print '<cell></cell>';
    print '<cell></cell>';
    print '<cell></cell>';
    print '<cell></cell>';
    print '<cell></cell>';
    print '<cell></cell>';
    print '<cell></cell>';
    print '<cell></cell>';
    print '<cell></cell>';
    print '<cell></cell>';
    print '<cell></cell>';
    foreach ($arrayActividad as $keyActividad => $valueActividad) {
        if ('actividad_' . utf8_decode(ltrim(rtrim($valueActividad[0]))) == 'actividad_' . utf8_decode(ltrim(rtrim($valueGrupo[0])))) {
            print '<row id="actividad_' . utf8_decode(ltrim(rtrim($valueGrupo[0]))) . '_' . utf8_decode(ltrim(rtrim($valueActividad[1]))) . '">';
            print '<cell image="../../../fastmedical_front/imagen/csh_bluebooks_simedh/book.gif">' . htmlspecialchars(utf8_decode(ltrim(rtrim($valueActividad[2])))) . '</cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            print '<cell></cell>';
            foreach ($arrayServicio as $keyServicio => $valueServicio) {
                if ('grupo_' . utf8_decode(ltrim(rtrim($valueServicio[0]))) == 'grupo_' . utf8_decode(ltrim(rtrim($valueActividad[0])))) {
                    if ('actividad_' . utf8_decode(ltrim(rtrim($valueServicio[1]))) == 'actividad_' . utf8_decode(ltrim(rtrim($valueActividad[1])))) {
                        if (utf8_decode(ltrim(rtrim($valueServicio[3]))) != '') {
                            print '<row id="actividad_' . utf8_decode(ltrim(rtrim($valueGrupo[0]))) . '_' . utf8_decode(ltrim(rtrim($valueActividad[1]))) . 'servicio_' . utf8_decode(ltrim(rtrim($valueServicio[2]))) . '" >';
                            print '<cell image="../../../fastmedical_front/imagen/csh_bluebooks_simedh/book.gif">' . htmlspecialchars(utf8_decode(ltrim(rtrim($valueServicio[3])))) . '</cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '<cell></cell>';
                            print '</row>';
                        }
                    }
                }
            }
            print '</row>';
        }
    }
    print '</row>';
}
print '</rows>';
?>