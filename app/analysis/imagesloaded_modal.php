<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 19/02/2018
 * Time: 20:47
 */

?>
<!-- Properties Modal -->
<div class="modal fade" id="imagesloaded-modal" tabindex="-1" style="z-index: 3500" role="alert" aria-labelledby="modalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle"><?=lang("LOADED_IMAGES_TITLE")?></h4>
            </div>
            <div class="container bg-light">
                <div class="row justify-content-between align-items-center border">
                    <div class="col"><?=lang("LOADED_IMAGES_MSG"); ?></div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="ok_images" class="btn btn-primary" data-bs-dismiss="modal"
                   onclick="function bf(){ document.getElementById('graphavd-modal').style.zIndex = 1100}; bf()">
                    <?=lang("BTN_OK")?>
                </a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
