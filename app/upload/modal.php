<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 19/02/2018
 * Time: 20:47
 */
?>
<!-- Modal de Delete-->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel">Excluir Item</h4>
            </div>
            <div class="modal-body">
                Deseja realmente excluir este item?
            </div>
            <div class="modal-footer">
                <a id="confirm" class="btn btn-primary delete" href="#">Sim</a>
                <a id="cancel" class="btn btn-default" data-dismiss="modal">N&atilde;o</a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
