<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 19/09/16
 * Time: 21:28
 */
?>
<div class="modal fade modal-information"
     id="information-modal"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="myModalLabel"><?= $modal_title; ?></h1>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-10 col-xs-push-1 col-sm-8 col-sm-push-2">
                        <?= $modal_content; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer tb-pad-lg">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
