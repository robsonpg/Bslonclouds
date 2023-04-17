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
                <div class="row justify-content-between align-items-center">
                    <div class="col">
                        <div id="title_msg">
                            <?=lang("MSG_IMAGE_TITLE"); ?>
                            <div>
                                <progress  id="image_process" style="width: 100%;" value="0" max="100"></progress>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <?=lang("NUMBER_POINTS_INPUT"); ?>
                    </div>
                     <div class="col">
                        <input type="number" id="gau_num_points" maxlength="20" value="200"
                               onkeyup="calculateGaussian()" onchange="calculateGaussian()">
                         <span><i class="fa-solid fa-arrow-up"></i>&nbsp;&nbsp;<i class="fa-solid fa-arrow-down"></i></span>
                     </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <?=lang("STD_DEVIATION_INPUT"); ?>
                    </div>
                    <div class="col">
                        <input type="number" id="std_deviation" maxlength="20" value="20"
                               onkeyup="calculateGaussian()" onchange="calculateGaussian()">
                        <span><i class="fa-solid fa-arrow-left"></i>&nbsp;&nbsp;<i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <div class="card mb-3">
                            <h6 class="card-header"><?=lang("GRAPHIC_SPECKLE_TITLE"); ?></h6>
                            <div>
                                <canvas id="graphavd_cvs" style="border:1px solid #d3d3d3;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col" >
                        <div class="card mb-3">
                            <h6 class="card-header"><?=lang("HEATMAP_TITLE"); ?></h6>
                            <img src="../images/heatmap.png" style="width: 40%">
                        </div>
                    </div>
                    <div class="col" >
                        <div class="row">
                            <div class="col align-items-center">
                                <div class="card mb-3">
                                    <h6 class="card-header"><?=lang("DISPERSION_TITLE"); ?></h6>
                                    <canvas id="color_hist" style="border:1px solid #d3d3d3;" width="265px" height="256px"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card mb-3">
                                    <h4 class="card-header">AVD</h4>
                                    <div class="card-body">
                                        <h5 class="card-title" id="avd_number">0.00</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="ok_avd" class="btn btn-default" data-bs-dismiss="modal"><?=lang("BTN_OK")?></a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
