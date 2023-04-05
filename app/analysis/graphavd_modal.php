<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 19/02/2018
 * Time: 20:47
 */

?>
<!-- Properties Modal -->
<div class="modal fade modal-lg" id="graphavd-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle"><?=lang("GRAPHAVD_MODAL_TITLE")?></h4>
            </div>
            <div class="container bg-light">
                <div class="row justify-content-between align-items-center border">
                    <div class="col"  >
                        <div id="title_msg">
                            <?=lang("MSG_IMAGE_TITLE"); ?>&nbsp;<img src="../images/progress.gif">
                        </div><br>
                        <div>
                            <canvas id="graphavd_cvs" style="border:1px solid #d3d3d3;"></canvas>
                        </div>
                    </div>
                    <div class="col" >
                        <canvas id="heatmap" width="100" height="256"></canvas>
                    </div>
                    <div class="col" >
                        <div class="alert" id="hovered-color">
                            <strong>Hovered Color</strong>
                        </div>
                        <div class="alert" id="selected-color">
                            <strong>Selected Color</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="ok_error_color" class="btn btn-default" data-bs-dismiss="modal"><?=lang("BTN_OK")?></a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
