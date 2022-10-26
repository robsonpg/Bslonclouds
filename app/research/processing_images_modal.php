<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 19/02/2018
 * Time: 20:47
 */

?>
<!-- Properties Modal -->
<div class="modal fade" id="processing-images-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabel"><?=lang("MODAL_PROCESSING_IMAGES_TITLE")?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="container bg-light">
                <div class="col my-2">
                    <div class="text-info" id="messages_place"><?=lang("MODAL_PROCESSING_IMAGES_MSG")?></div>
                    <img src="../images/progress.gif">
                </div>
            </div>
            <div class="modal-footer">
                <a id="cancel" class="btn btn-default" data-dismiss="modal"><?=lang("BTN_HIDE")?></a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
