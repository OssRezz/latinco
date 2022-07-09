<?php

namespace App\Custom;

class Modal
{
    public function modalAlerta($color, $tituloModal, $contenido)
    {
        $modal = "<!-- Modal -->";
        $modal .= "<div class='modal fade' id='modalAlerta' tabindex='-1' aria-labelledby='alertaModal' aria-hidden='true'>";
        $modal .= "  <div class='modal-dialog modal-dialog-centered'>";
        $modal .= "    <div class='modal-content'>";
        $modal .= "      <div class='modal-header  border-0' id='alertaModal'>";
        $modal .= "        <h5 class='modal-title text-$color'>$tituloModal</h5>";
        $modal .= "                <button type='button' class='btn-close' id='close' data-bs-dismiss='modal' aria-label='Close'></button>";
        $modal .= "      </div>";
        $modal .= "      <div class='modal-body'>";
        $modal .=        $contenido;
        $modal .= "       </div>";
        $modal .= "      </div>";
        $modal .= "    </div>";
        $modal .= "  </div>";
        $modal .= "</div>";
        $modal .= "<script>$('#modalAlerta').modal('show')</script>";

        return $modal;
    }

    public function modalAlertaReaload($color, $tituloModal, $contenido)
    {
        $modal = "<!-- Modal -->";
        $modal .= "<div class='modal fade' id='modalAlerta' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>";
        $modal .= "  <div class='modal-dialog modal-dialog-centered'>";
        $modal .= "    <div class='modal-content'>";
        $modal .= "      <div class='modal-header  border-0'>";
        $modal .= "        <h5 class='modal-title text-$color'>$tituloModal</h5>";
        $modal .= "                <button type='button' class='btn-close' id='close' data-bs-dismiss='modal' aria-label='Close'></button>";
        $modal .= "      </div>";
        $modal .= "      <div class='modal-body'>";
        $modal .=        $contenido;
        $modal .= "       </div>";
        $modal .= "      </div>";
        $modal .= "    </div>";
        $modal .= "  </div>";
        $modal .= "</div>";
        $modal .= "<script>$('#modalAlerta').modal('show')</script>";
        $modal .= "<script>$('#close').click(function(){location.reload()});</script>";
        return $modal;
    }
}
