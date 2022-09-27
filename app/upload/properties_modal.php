<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 19/02/2018
 * Time: 20:47
 */

?>
<!-- Properties Modal -->
<div class="modal fade" id="properties-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabel"><?=lang("MODAL_PROPERTIES_TITLE")?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="container bg-light">
                <div class="row justify-content-between align-items-center border">
                    <div class="col">Sample illuminated</div>
                    <div class="col"><input type="text" id="sample_name"></div>
                </div>
                <div class="row justify-content-between align-items-center border">
                    <div class="col">Time rate (frames-per-second)</div>
                    <div class="col"><input type="number" id="sample_frames"></div>
                </div>
                <div class="row justify-content-between align-items-center border">
                    <div class="col">Configuration</div>
                    <div class="col">
                        <select type="text" id="sample_config">
                            <option value="0" selected></option>
                            <option value="1">Backscattering</option>
                            <option value="2">Forward Scattering</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-between align-items-center border">
                    <div class="col">Type of laser: HeNe, Diode, etc.</div>
                    <div class="col"><input type="text" id="sample_laser_type"></div>
                </div>
                <div class="row justify-content-between align-items-center border">
                    <div class="col">Laser wavelength</div>
                    <div class="col"><input type="number" id="sample_wavelength"></div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="sample_data_confirm" class="btn btn-primary delete" href="#"><?=lang("BTN_ACCEPT")?></a>
                <a id="cancel" class="btn btn-default" data-dismiss="modal"><?=lang("BTN_CANCEL")?></a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
