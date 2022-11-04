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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalPropTitle"><?=lang("MODAL_PROPERTIES_TITLE")?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="container bg-light">
                <div class="row justify-content-between align-items-center border">
                    <div class="col">
                        <div class="row justify-content-between align-items-center border">
                            <div class="col"><?=lang("SAMPLE_IDENTIFICATION"); ?></div>
                            <div class="col"><input type="text" id="sample_id" onkeyup="uniqueIDValidation()"
                                                    onblur="uniqueIDValidation()" maxlength="20"></div>
                        </div>
                        <div class="row justify-content-between align-items-center border">
                            <div class="col" id="unique_id_help"><?=lang("MISSING_UNIQUE_ID"); ?></div>
                        </div>
                        <div class="row justify-content-between align-items-center border">
                            <div class="col-1">
                                <i style="color: orangered" class="fa fa-long-arrow-up fa-2x"></i>
                            </div>
                            <div class="col">
                                <div role="alert" class="mt-1 alert alert-primary show">
                                    <span class="font-weight-bold"><?=lang("SAMPLE_ID_ESPECS"); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between align-items-center border">
                            <div class="col"><?=lang("ILLUMINATED_SAMPLE"); ?></div>
                            <div class="col"><input type="text" id="sample_name" maxlength="20"></div>
                        </div>
                        <div class="row justify-content-between align-items-center border">
                            <div class="col"><?=lang("TIME_RATE"); ?></div>
                            <div class="col"><input type="number" id="sample_frames" maxlength="3"></div>
                        </div>
                        <div class="row justify-content-between align-items-center border">
                            <div class="col" id="sample_config_label"><?=lang("SAMPLE_CONFIG"); ?></div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <input class="form-check-input" id="sample_config1" type="radio" name="sample_config"
                                               value="1"/>
                                        <label class="form-check-label" for="sample_config1">
                                            <?=lang("BACKSCATTERING"); ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input class="form-check-input" id="sample_config2" type="radio" name="sample_config" value="2" />
                                        <label class="form-check-label" for="sample_config2"><?=lang("FWD_SCATTERING"); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row justify-content-between align-items-center border">
                            <div class="col" id="sample_laser_type_label"><?=lang("LASER_TYPE"); ?></div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <input class="form-check-input" id="sample_laser_type1" type="radio"
                                               name="sample_laser_type" value="1" onclick="enableOtherType()"/>
                                        <label class="form-check-label" for="sample_laser_type1"><?=lang("HENE"); ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input class="form-check-input" id="sample_laser_type2" type="radio"
                                               name="sample_laser_type" value="2" onclick="enableOtherType()"/>
                                        <label class="form-check-label" for="sample_laser_type2"><?=lang("DIODE"); ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input class="form-check-input" id="sample_laser_type3" type="radio"
                                               name="sample_laser_type" value="3" onclick="enableOtherType()"/>
                                        <label class="form-check-label" for="sample_laser_type3"><?=lang("OTHER"); ?></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" id="other_laser_type" disabled maxlength="10">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between align-items-center border">
                            <div class="col"><?=lang("LASER_WAVELENGTH"); ?></div>
                            <div class="col"><input type="number" id="sample_wavelength"></div>
                        </div>
                        <div class="row justify-content-between align-items-center border">
                            <div class="col" id="sample_permission_label"><?=lang("IMAGES_PERMISSION"); ?></div>
                            <div class="col">
                                <div class="row">
                                    <div class="form-check ">
                                        <input class="form-check-input" id="sample_permission1" type="radio" name="sample_permission"
                                               value="1"/>
                                        <label class="form-check-label" for="sample_permission1">
                                            <?=lang("PERMISSION_PUBLIC"); ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <a><?=lang("PUBLIC_MESSAGE"); ?></a>
                                </div>
                                <div class="row">
                                    <div class="form-check ">
                                        <input class="form-check-input" id="sample_permission2" type="radio" name="sample_permission" value="2" />
                                        <label class="form-check-label" for="sample_permission2"><?=lang("PERMISSION_PRIVATE"); ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <a><?=lang("PRIVATE_MESSAGE"); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between align-items-center border">
                            <div class="col"><?=lang("RESEARCH_PUBLIC_ID"); ?></div>
                            <div class="col"><input type="text" id="research_public_id" maxlength="512"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="sample_data_confirm" class="btn btn-primary" style="color: whitesmoke" data-dismiss="modal"><?=lang("BTN_ACCEPT")?></a>
                <a id="cancel" class="btn btn-default" data-dismiss="modal"><?=lang("BTN_CANCEL")?></a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
