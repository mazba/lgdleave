<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= $this->Url->build(('/Dashboard'), true); ?>"><?= __('Dashboard') ?></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><?= __('Assign Application Types') ?></li>

    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus-square-o fa-lg"></i><?= __('Assign Application Type') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('Back'), ['action' => 'index'],['class'=>'btn btn-sm btn-success']); ?>
                </div>

            </div>
            <div class="portlet-body">
                <?= $this->Form->create(null,['class' => 'form-horizontal','role'=>'form']) ?>
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="text-align: center"><?php echo $OfficeUnit['name_bn']; ?></h1>
                    </div>
                    <div class="col-md-12">
                        <?php
                        foreach($applicantTypes as $applicantType){
                            ?>
                            <div class="col-md-3" style="margin: 10px">
                            <span class="label label-info" style="font-size: 18px"><input name="application_types[]" type="checkbox" value="<?php echo $applicantType['id']; ?>"/><?php echo $applicantType['title_bn']; ?></span>

                            </div>
                            <?php
                        }

                        ?>
                        <?= $this->Form->button(__('Submit'),['class'=>'btn blue pull-right','style'=>'margin-top:20px']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

