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
                    <div class="col"><?=lang("ILLUMINATED_SAMPLE"); ?></div>
                    <div class="col"><input type="text" id="sample_name"></div>
                </div>
                <div class="row justify-content-between align-items-center border">
                    <div class="col"><?=lang("TIME_RATE"); ?></div>
                    <div class="col"><input type="number" id="sample_frames"></div>
                </div>
                <div class="row justify-content-between align-items-center border">
                    <div class="col" id="sample_config_label"><?=lang("SAMPLE_CONFIG"); ?></div>
                    <div class="col">
                        <div class="row">
                            <div class="form-check ">
                                <input class="form-check-input" type="radio" name="sample_config" value="1" />
                                <label class="form-check-label" for="sample_config"><?=lang("BACKSCATTERING"); ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-check ">
                                <input class="form-check-input" type="radio" name="sample_config" value="2" />
                                <label class="form-check-label" for="sample_config"><?=lang("FWD_SCATTERING"); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between align-items-center border">
                    <div class="col"><?=lang("LASER_TYPE"); ?></div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <input class="form-check-input" type="radio" name="sample_laser_type" value="1"
                                       onclick="enableOtherType()"/>
                                <label class="form-check-label" for="sample_laser_type"><?=lang("HENE"); ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="form-check-input" type="radio" name="sample_laser_type" value="2"
                                       onclick="enableOtherType()"/>
                                <label class="form-check-label" for="sample_laser_type"><?=lang("DIODE"); ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="form-check-input" type="radio" name="sample_laser_type" value="3"
                                  onclick="enableOtherType()"/>
                                <label class="form-check-label" for="sample_laser_type"><?=lang("OTHER"); ?></label>
                            </div>
                            <div class="col">
                                <input type="text" id="other_laser_type" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between align-items-center border">
                    <div class="col"><?=lang("LASER_WAVELENGTH"); ?></div>
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
