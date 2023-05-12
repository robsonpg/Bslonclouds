<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 19/02/2018
 * Time: 20:47
 */

?>
<!-- Properties Modal -->
<div class="modal fade" id="clickpoint-modal" tabindex="-1" style="z-index: 3500" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle"><?=lang("CLICK_POINT_TITLE")?></h4>
            </div>
            <div class="container bg-light">
                <div class="row justify-content-between align-items-center border">
                    <div class="col"><?=lang("CLICK_POINT_MSG"); ?></div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="ok_error" class="btn btn-primary" data-bs-dismiss="modal"><?=lang("BTN_OK")?></a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
