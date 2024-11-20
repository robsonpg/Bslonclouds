<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 19/02/2018
 * Time: 20:47
 */

?>
<!-- Properties Modal -->
<div class="modal fade" id="send-images-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabel"><?=lang("MODAL_SEND_IMAGES_TITLE")?></h4>
                <button type="button" class="close" data_bs-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="container bg-light">
                <div class="row">
                    <div class="col my-2">
                        <div class="card card-body p-3"><span class="text-primary" id="message_place">
                                <span class="badge badge-primary float-right">+ 13%</span> XXXXX </span>
                            <div class="progress mt-4">
                                <div class="progress-bar bg-primary" id="progress_bar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="text-info" id="proc_img_place">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container bg-light">
                <div class="col my-2">
                    <div class="text-info" id="messages_place"></div>
                </div>
            </div>
            <div class="container bg-light">
                <div class="row">
                    <div class="col my-2">
                        <div class="alert alert-success">
                            <a rel="license" href="https://creativecommons.org/licenses/by/4.0/">
                            <img alt="Creative Commons Attribution 4.0 International License" 
                                style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png"/></a>
                            <a><?=lang("CC_TEXT1")?><a rel="license" href="https://creativecommons.org/licenses/by/4.0/"><?=lang("CC_TEXT2")?></a>.
                        </div>
                    </div>
                </div>
            </div>            
            <div class="modal-footer">
                <a id="cancel" class="btn btn-default" data-bs-dismiss="modal"><?=lang("BTN_HIDE")?></a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
