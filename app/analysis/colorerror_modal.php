<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 19/02/2018
 * Time: 20:47
 */

?>
<!-- Properties Modal -->
<div class="modal fade modal-lg" id="colorerror-modal" style="z-index: 9999" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-dialog-centered">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle"><?=lang("COLOR_ERROR_MODAL_TITLE")?></h4>
            </div>
            <div class="container bg-light">
                <div class="row justify-content-between align-items-center border">
                    <div class="col"><?=lang("COLOR_ERROR_MSG"); ?></div>
                    <div class="col" id="image_name_color">XXXXXXX</div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="ok_error_color" class="btn btn-primary" data-bs-dismiss="modal"><?=lang("BTN_OK")?></a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
