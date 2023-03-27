<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 19/02/2018
 * Time: 20:47
 */

?>
<!-- Properties Modal -->
<div class="modal fade" id="accept-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle"><?=lang("ACCEPT_MODAL_TITLE")?></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="container bg-light">
                <div class="row justify-content-between align-items-center border">
                    <div class="col"><?=lang("SAMPLE_IDENTIFICATION_MSG"); ?></div>
                    <div class="col" id="accept_uid">XXXXXXX</div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="btn_research_accept_confirm" class="btn btn-primary" style="color: whitesmoke">
                    <?=lang("BTN_CONFIRM")?></a>
                <a id="cancel_accept" class="btn btn-default" data-bs-dismiss="modal"><?=lang("BTN_CANCEL")?></a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
