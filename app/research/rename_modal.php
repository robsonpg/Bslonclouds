<div class="modal fade" id="rename-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle"><?=lang("RENAME_MODAL_TITLE")?></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="container bg-light">
                <div class="row justify-content-between align-items-center border">
                    <div class="col"><?=lang("SAMPLE_IDENTIFICATION_MSG"); ?></div>
                    <div class="col" id="rename_uid">XXXXXXX</div>
                </div>
            </div>
            <div class="container bg-light">
                <div class="row justify-content-between align-items-center border">
                    <div class="col"><?=lang("NEW_NAME_MSG"); ?></div>
                    <div class="col"><input type="text" id="sample_id" onkeyup="uniqueIDValidation()" onkeydown="return alphaOnly(event);"
                        onblur="uniqueIDValidation()" maxlength="45" pattern="[a-zA-Z_]+">
                    </div>
                    <div class="row justify-content-between align-items-center border">
                        <div class="col" id="unique_id_help"><?=lang("MISSING_UNIQUE_ID"); ?></div>
                    </div>                    
                </div>
                <div class="text-info" id="messages_place">
                </div>
            </div>
            <div class="modal-footer">
                <a id="btn_research_rename_confirm" class="btn btn-primary" style="color: whitesmoke" onclick="clickRename()">
                    <?=lang("BTN_CONFIRM")?></a>
                <a id="cancel_rename" class="btn btn-default" data-bs-dismiss="modal"><?=lang("BTN_CANCEL")?></a>
            </div>
        </div>
    </div>
</div> <!-- /.modal -->
