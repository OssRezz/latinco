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
        $modal .= "            <div class='col mt-3'>";
        $modal .= "                 <div class='d-grid'>";
        $modal .= "                     <button class='btn btn-dark' data-bs-dismiss='modal'>Cerrar</button>";
        $modal .= "                 </div>";
        $modal .= "            </div>";
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
        $modal .=              $contenido;
        $modal .= "       </div>";
        $modal .= "      <div class='modal-footer justify-content-end border-0'>";
        $modal .= "           <button class='btn btn-dark' data-bs-dismiss='modal' id='closeButton'>Cerrar</button>";
        $modal .= "      </div>";
        $modal .= "      </div>";
        $modal .= "    </div>";
        $modal .= "  </div>";
        $modal .= "</div>";
        $modal .= "<script>$('#modalAlerta').modal('show')</script>";
        $modal .= "<script>$('#close').click(function(){location.reload()});</script>";
        $modal .= "<script>$('#closeButton').click(function(){location.reload()});</script>";
        return $modal;
    }


    public function modalReporte($color, $icono, $tituloModal, $contenido, $contador)
    {
        $modal = "<!-- Modal -->";
        $modal .= "<div class='modal fade' id='modalAlerta' tabindex='-1' aria-labelledby='alertaModal' aria-hidden='true'>";
        $modal .= "  <div class='modal-dialog modal-lg modal-dialog-centered'>";
        $modal .= "    <div class='modal-content'>";

        $modal .= "      <div class='modal-header' id='alertaModal'>";
        $modal .= "        <h5 class='modal-title text-$color'><i class='$icono'></i> <b>$tituloModal</b></h5>";
        $modal .= "        <button type='button' class='btn-close' id='close' data-bs-dismiss='modal' aria-label='Close'></button>";
        $modal .= "      </div>";
        if ($contador > 9) {
            $altura = 'height: 30em;';
        } else {
            $altura = '';
        }
        $modal .= "      <div class='modal-body p-1' style='overflow-y: scroll;tabindex:0;$altura'>";
        $modal .=              $contenido;
        $modal .= "      </div>";
        $modal .= "      <div class='modal-footer justify-content-end'>";
        $modal .= "           <button class='btn btn-dark' data-bs-dismiss='modal'>Cerrar</button>";
        $modal .= "      </div>";

        $modal .= "    </div>";
        $modal .= "  </div>";
        $modal .= "</div>";
        $modal .= "<script>$('#modalAlerta').modal('show')</script>";

        return $modal;
    }

    public function modalTable($icono, $tituloModal, $header, $body)
    {
        $modal = "<!-- Modal -->";
        $modal .= "<div class='modal fade' id='modalAlerta' tabindex='-1' aria-labelledby='alertaModal' aria-hidden='true'>";
        $modal .= "  <div class='modal-dialog modal-xl modal-dialog-centered'>";
        $modal .= "    <div class='modal-content'>";

        $modal .= "      <div class='modal-header' id='alertaModal'>";
        $modal .= "        <h5 class='modal-title text-latinco'><i class='$icono'></i> <b>$tituloModal</b></h5>";
        $modal .= "        <button type='button' class='btn-close' id='close' data-bs-dismiss='modal' aria-label='Close'></button>";
        $modal .= "      </div>";
        $modal .= "      <div class='modal-body p-1'>";

        $modal .= '<div class="table-responsive">';
        $modal .=    '<table class="table table-bordered table-hover table-sm"  id="tableModal" class="display" style="width: 100%">';
        $modal .=        '<thead>';
        $modal .=            '<tr>';
        $modal .=              $header;
        $modal .=            '</tr>';
        $modal .=       '</thead>';
        $modal .=       '<tbody>';
        $modal .=              $body;
        $modal .=       '</tbody>';
        $modal .=   '</table>';
        $modal .= '</div>';
        $modal .=  "<script>$('#tableModal').DataTable({ responsive: true,";
        $modal .=  "language: {";
        $modal .=  "decimal: '',";
        $modal .=  "emptyTable: 'No hay información',";
        $modal .=  "info: 'Mostrando _START_ a _END_ de _TOTAL_ Entradas',";
        $modal .=  "infoEmpty: 'Mostrando 0 to 0 of 0 Entradas',";
        $modal .=  "infoFiltered: '(Filtrado de _MAX_ total entradas)',";
        $modal .=  "infoPostFix: '',";
        $modal .=  "thousands: ',',";
        $modal .=  "lengthMenu: 'Mostrar _MENU_ Entradas',";
        $modal .=  "loadingRecords: 'Cargando...',";
        $modal .=  "processing: 'Procesando...',";
        $modal .=  "search: 'Buscar:',";
        $modal .=  "zeroRecords: 'Sin resultados encontrados',";
        $modal .=  "paginate: {";
        $modal .=  "first: 'Primero',";
        $modal .=  "last: 'Ultimo',";
        $modal .=  "next: 'Siguiente',";
        $modal .=  "previous: 'Anterior',";
        $modal .=  "}, }, });</script>";

        $modal .= "      </div>";
        $modal .= "      <div class='modal-footer justify-content-end'>";
        $modal .= "           <button class='btn btn-dark' data-bs-dismiss='modal'>Cerrar</button>";
        $modal .= "      </div>";

        $modal .= "    </div>";
        $modal .= "  </div>";
        $modal .= "</div>";
        $modal .= "<script>$('#modalAlerta').modal('show')</script>";

        return $modal;
    }
}

