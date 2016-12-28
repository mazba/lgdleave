<?php
use Cake\Core\Configure;

$user_status = Configure::read('user_status');
?>
<style>
    label.mandetory:after {
        content: ' *';
        color: red;
        display: inline;
    }

    .padding {
        padding-left: 50px;
    }
</style>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= $this->Url->build(('/Dashboard'), true); ?>"><?= __('Dashboard') ?></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <?= $this->Html->link(__('Applicants'), ['action' => 'index']) ?>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><?= __('Edit Applicant') ?></li>

    </ul>
</div>


<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus-square-o fa-lg"></i><?= __('Edit Applicant') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('Back'), ['action' => 'index'],['class'=>'btn btn-sm btn-success']); ?>
                </div>

            </div>
            <div class="portlet-body">
                <?= $this->Form->create($user,['type' => 'file', 'class'=>'form-horizontal myForm']) ?>
                <div class="tabbable-custom ">
                   
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                            <div class="row whiteWrapper basicWrapper">
                                <div class="col-md-8 col-md-offset-2">


                                    <?php
                                    echo $this->Form->input('username',['required' => 'required','class'=>'form-control','label'=>[__('Username'),'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    //echo $this->Form->input('username',['required' => 'required','class'=>'form-control','label'=>[__('Username','class' => 'mandetory col-sm-3 control-label text-right')]]);
                                    echo $this->Form->input('new_password',['type'=>'password','class'=>'form-control','label'=>__('Password')]);
                                    echo $this->Form->input('status', ['options' => $user_status,'class'=>'form-control','label'=>__('Status')]);

                                    ?>

                                </div>
                            </div>
                        </div>




                        <div class="tab-pane" id="tab_5_9">
                            <div class="row whiteWrapper loginWrapper">
                                <div class="col-md-6 col-md-offset-2">

                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                        <div class="text-center"><?= $this->Form->button(__('Submit'),['class'=>'btn green-seagreen','style'=>'margin:20px 0 10px 0']) ?></div>


                    </div>
                </div>
                <!-- END BORDERED TABLE PORTLET-->
            </div>
        </div>

        <script>
            $(document).ready(function(){

                $('#location-type-id').val('');

                $(document).on('change', '.location_type', function () {

                    $('#district').hide();
                    $('#upazila').hide();
                    $('#city_corporation').hide();
                    $('#city_corporation_ward').hide();
                    $('#municipal').hide();
                    $('#municipal_ward').hide();
                    $('#union').hide();
                    $('#ward').hide();


                    $('.applicantTypes').html('');
                    $('.divisions').val('');
                    var obj = $(this);
                    var location_type_id = $(this).val();

                    $.ajax({
                        url: '<?= $this->Url->build('/Applicants/ajax/get_applicantTypes')?>',
                        type: 'POST',
                        data: {location_type_id: location_type_id},

                        success: function (data, status) {
                            $('.applicant_type').removeAttr('class', 'hide');
                            data = JSON.parse(data);
                            obj.closest('.tab-pane').find('.applicantTypes').append("<option value=''><?= __('Select') ?></option>");
                            $.each(data, function (key, value) {
                                obj.closest('.tab-pane').find('.applicantTypes').append($("<option></option>").attr("value", key).text(value));
                            });
                        },
                        error: function (xhr, desc, err) {
                            console.log("error");
                        }
                    });

                });

                $(document).on('change', '.division', function () {

                    $('#upazila').hide();
                    $('#city_corporation').hide();
                    $('#city_corporation_ward').hide();
                    $('#municipal').hide();
                    $('#municipal_ward').hide();
                    $('#union').hide();
                    $('#ward').hide();

                    $('#district').show();
                    //   $('#district-id').html('');
                    var obj = $(this);

                    var applicantTypes_id = obj.closest('.tab-pane').find('.applicantTypes').val();
                    var division_id = obj.val();


                    if (applicantTypes_id < 100) {
                        $.ajax({
                            url: '<?= $this->Url->build('/Applicants/ajax/get_districts')?>',
                            type: 'POST',
                            data: {division_id: division_id},

                            success: function (data, status) {
                                $('.district').removeAttr('class', 'hide');


                                data = JSON.parse(data);
                                obj.closest('.tab-pane').find('#district-id').find('option')
                                    .remove()
                                    .end()
                                    .append("<option value=''><?= __('Select') ?></option>");
                                $.each(data, function (key, value) {
                                    obj.closest('.tab-pane').find('#district-id').append($("<option></option>").attr("value", key).text(value));
                                });
                            },
                            error: function (xhr, desc, err) {
                                console.log("error");
                            }
                        });
                    }
                });


                $(document).on('change', '.districts', function () {

                    $('#union').hide();
                    $('#ward').hide();

                    $('.upazilas').html('');
                    $('.city_corporations').html('');
                    $('.municipals').html('');
                    var obj = $(this);
                    var applicantTypes_id = obj.closest('#tab_5_1').find('.applicantTypes option:selected').val();

                    var district_id = $(this).val();

                    if (applicantTypes_id > 4 && applicantTypes_id < 8 || applicantTypes_id > 13) {

                        $('#upazila').show();

                        $.ajax({
                            url: '<?= $this->Url->build('/Applicants/ajax/get_upazilas')?>',
                            type: 'POST',
                            data: {district_id: district_id},

                            success: function (data, status) {
                                $('.upazila').removeAttr('class', 'hide');

                                data = JSON.parse(data);
                                obj.closest('.tab-pane').find('.upazilas').append("<option value=''><?= __('Select') ?></option>");
                                $.each(data, function (key, value) {
                                    obj.closest('.tab-pane').find('.upazilas').append($("<option></option>").attr("value", key).text(value));
                                });
                            },
                            error: function (xhr, desc, err) {
                                console.log("error");
                            }
                        });
                    } else if (applicantTypes_id > 7 && applicantTypes_id < 11) {
                        $('#city_corporation').show();
                        $.ajax({
                            url: '<?= $this->Url->build('/Applicants/ajax/get_city_corporations')?>',
                            type: 'POST',
                            data: {district_id: district_id},

                            success: function (data, status) {
                                $('.city_corporation').removeAttr('class', 'hide');
                                data = JSON.parse(data);
                                obj.closest('.tab-pane').find('.city_corporations').append("<option value=''><?= __('Select') ?></option>");
                                $.each(data, function (key, value) {
                                    obj.closest('.tab-pane').find('.city_corporations').append($("<option></option>").attr("value", key).text(value));
                                });
                            },
                            error: function (xhr, desc, err) {
                                console.log("error");
                            }
                        });
                    } else if (applicantTypes_id > 10 && applicantTypes_id < 14) {
                        $('#municipal').show();
                        $.ajax({
                            url: '<?= $this->Url->build('/Applicants/ajax/get_municipals')?>',
                            type: 'POST',
                            data: {district_id: district_id},

                            success: function (data, status) {
                                $('.municipal').removeAttr('class', 'hide');
                                data = JSON.parse(data);
                                obj.closest('.tab-pane').find('.municipals').append("<option value=''><?= __('Select') ?></option>");
                                $.each(data, function (key, value) {
                                    obj.closest('.tab-pane').find('.municipals').append($("<option></option>").attr("value", key).text(value));
                                });
                            },
                            error: function (xhr, desc, err) {
                                console.log("error");
                            }
                        });
                    }
                });

                $(document).on('change', '.upazilas', function () {
                    $('.unions').html('');
                    var obj = $(this);
                    var applicantTypes_id = obj.closest('#tab_5_1').find('.applicantTypes option:selected').val();

                    var district_id = obj.closest('#tab_5_1').find('.districts option:selected').val();

                    var upazila_id = $(this).val();
                    if (applicantTypes_id > 13) {
                        $('#union').show('');
                        $.ajax({
                            url: '<?= $this->Url->build('/Applicants/ajax/get_unions')?>',
                            type: 'POST',
                            data: {upazila_id: upazila_id, district_id: district_id},

                            success: function (data, status) {
                                $('.union').removeAttr('class', 'hide');
                                data = JSON.parse(data);
                                obj.closest('.tab-pane').find('.unions').append("<option value=''><?= __('Select') ?></option>");
                                $.each(data, function (key, value) {
                                    obj.closest('.tab-pane').find('.unions').append($("<option></option>").attr("value", key).text(value));
                                });
                            },
                            error: function (xhr, desc, err) {
                                console.log("error");
                            }
                        });
                    }
                });


                $(document).on('change', '#city-corporation-id', function () {
                    $('.city_corporation_wards').html('');
                    var obj = $(this);
                    var applicantTypes_id = obj.closest('#tab_5_1').find('.applicantTypes option:selected').val();

                    var district_id = obj.closest('#tab_5_1').find(' .districts option:selected').val();

                    var city_corporation_id = $(this).val();
                    if (applicantTypes_id == 9) {
                        $.ajax({
                            url: '<?= $this->Url->build('/Applicants/ajax/get_city_corporation_wards')?>',
                            type: 'POST',
                            data: {city_corporation_id: city_corporation_id, district_id: district_id},

                            success: function (data, status) {
                                $('.city_corporation_ward').removeAttr('class', 'hide');
                                data = JSON.parse(data);
                                obj.closest('.tab-pane').find('.city_corporation_wards').append("<option value=''><?= __('Select') ?></option>");
                                $.each(data, function (key, value) {
                                    obj.closest('.tab-pane').find('.city_corporation_wards').append($("<option></option>").attr("value", key).text(value));
                                });
                            },
                            error: function (xhr, desc, err) {
                                console.log("error");
                            }
                        });
                    }
                });


                $(document).on('change', '.municipals', function () {
                    $('.municipal_wards').html('');
                    var obj = $(this);
                    var applicantTypes_id = obj.closest('#tab_5_1').find('.applicantTypes option:selected').val();

                    var district_id = obj.closest('#tab_5_1').find(' .districts option:selected').val();

                    var municipal_id = $(this).val();
                    if (applicantTypes_id == 12) {
                        $('#municipal_ward').show();
                        $.ajax({
                            url: '<?= $this->Url->build('/Applicants/ajax/get_municipal_wards')?>',
                            type: 'POST',
                            data: {municipal_id: municipal_id, district_id: district_id},

                            success: function (data, status) {
                                $('.municipal_ward').removeAttr('class', 'hide');
                                data = JSON.parse(data);
                                obj.closest('.tab-pane').find('.municipal_wards').append("<option value=''><?= __('Select') ?></option>");
                                $.each(data, function (key, value) {
                                    obj.closest('.tab-pane').find('.municipal_wards').append($("<option></option>").attr("value", key).text(value));
                                });
                            },
                            error: function (xhr, desc, err) {
                                console.log("error");
                            }
                        });
                    }
                });


                $(document).on('change', '#union-id', function () {

                    var obj = $(this);
                    var applicantTypes_id = obj.closest('#tab_5_1').find('.applicantTypes option:selected').val();

                    if (applicantTypes_id == 15) {
                        $('#ward').show();
                        $('.ward').removeAttr('class', 'hide');
                    }
                });


                $(document).on('change','.married',function(){
                    if($(this).prop('checked'))
                    {
                        $('.for_married').removeAttr('readonly');
                    }
                    else
                    {
                        $('.for_married').attr('readonly','readonly');
                    }
                });



                $(document).on("focus",".datepicker", function()
                {
                    $(this).removeClass('hasDatepicker').datepicker({
                        dateFormat: 'dd-mm-yy'
                    });
                });


                // Designation Section Add More & Remove
                $(document).on('click', '.add_more_designation', function () {
                    var index = $('.list_designation').data('index_no');
                    $('.list_designation').data('index_no', index + 1);
                    var html = $('.designationWrapper .col-md-12:last').clone().find('.form-control').each(function () {
                        this.name = this.name.replace(/\d+/, index+1);
                        this.id = this.id.replace(/\d+/, index+1);
                        this.value = '';


                        $(this).closest('.single_list_designation').find('.designation_id').closest('.form-group').hide();
                        $(this).closest('.single_list_designation').find('.des_div').removeClass('hidden');


                        $(this).closest('.single_list_designation').find('.office_unit_id').closest('.form-group').show();
                        $(this).closest('.single_list_designation').find('.office_unit_designation_id').closest('.form-group').show();
                        $(this).closest('.single_list_designation').find('.des_div').addClass('hidden');
                    }).end();

                    $('.designationWrapper').append(html);
                    $.uniform.update();
                });

                $(document).on('click', '.remove', function () {
                    var obj=$(this);
                    var count= $('.single_list_designation').length;
                    if(count > 1){
                        obj.closest('.single_list_designation').remove();
                    }
                });



                // Get office unit designations by office unit AJAX (Designation)
                $(document).on('change','.office_unit_id',function()
                {


                    var obj = $(this);
                    obj.closest('.single_list_designation').find('.office_unit_designation_id').html('<option><?php echo __('Select');?></option>');
                    obj.closest('.single_list_designation').find('.designation_id').html('<option><?php echo __('Select');?></option>');

                    // var office_id = obj.closest('.single_list_designation').find('.office').val();
                    var office_unit_id = obj.val();

                    if(office_unit_id>0)
                    {
                        $.ajax({
                            url: '<?= $this->Url->build('/Users/ajax/get_unit_designation')?>',
                            type: 'POST',
                            data:{office_unit_id:office_unit_id},

                            success: function (data, status)
                            {
                                $.each(JSON.parse(data), function(key, value) {
                                    obj.closest('.single_list_designation').find('.office_unit_designation_id').append($("<option></option>").attr("value",key).text(value));
                                });
                            },
                            error: function (xhr, desc, err)
                            {
                                console.log("error");
                            }
                        });
                    }
                });


            });
        </script>