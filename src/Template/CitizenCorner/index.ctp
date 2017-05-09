<?php
use Cake\Core\Configure;

$religions = \Cake\Core\Configure::read('religions');
?>

<style>
    label.mandetory:after {
        content: ' *';
        color: red;
        display: inline;
    }
    .error{
        color:red;
    }

    .padding {
        padding-left: 50px;
    }
</style>


<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="portlet box blue-hoki" id="form_wizard_1">
            <div class="portlet-title">


            </div>
            <div class="portlet-body form">
                <?= $this->Form->create($applications, ['type' => 'file', 'class' => 'form-horizontal myForm', 'novalidate', 'id' => 'submit_form']) ?>

                <div class="form-wizard">
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">

                            <li>
                                <a href="#tab2" data-toggle="tab" class="step">
												<span class="number">
												১ </span>
												<span class="desc">
												<i class="fa fa-check"></i> <?= __('Profile_Setup') ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab3" data-toggle="tab" class="step active">
												<span class="number">
												২ </span>
												<span class="desc">
												<i class="fa fa-check"></i><?= __('Billing_Setup') ?>  </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab4" data-toggle="tab" class="step">
												<span class="number">
												৩ </span>
												<span class="desc">
												<i class="fa fa-check"></i> <?= __('Application') ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab5" data-toggle="tab" class="step">
												<span class="number">
												৪ </span>
												<span class="desc">
												<i class="fa fa-check"></i> <?= __('Confirm') ?> </span>
                                </a>
                            </li>
                        </ul>
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success">
                            </div>
                        </div>
                        <div class="tab-content">


                            <div class="tab-pane" id="tab2">


                                <h3 class="block"><?= __('Provide your profile details') ?></h3>

                                <?php
                                echo $this->Form->input('applicant_name_bn', ['value'=>$applicant_application_info['applicant_name_bn'],'required' => 'required', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('applicant_name_en',['value'=>$applicant_application_info['applicant_name_en']]);
                                echo $this->Form->input('mother_name_bn', ['value'=>$applicant_application_info['mother_name_bn'],'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('mother_name_en',['value'=>$applicant_application_info['mother_name_en'],]);
                                echo $this->Form->input('father_name_bn', ['value'=>$applicant_application_info['father_name_bn'],'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('father_name_en',['value'=>$applicant_application_info['father_name_en']]);
                                echo $this->Form->input('phone', ['value'=>$applicant_application_info['phone'],'type'=>'text','label' => ['escape' => false, 'class' => 'col-sm-3 control-label text-right']]);

                                echo $this->Form->input('cellphone', ['value'=>$applicant_application_info['cellphone'],'required' => 'required','label' => [__('Cellphone'),'escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('emergency_contact', ['value'=>$applicant_application_info['emergency_contact'],'label' => __('Emergency_contact')]);
                                echo $this->Form->input('email', ['value'=>$applicant_application_info['email'],'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('nid', ['value'=>$applicant_application_info['nid'],'label' => __('Nid')]);
                                //  echo $this->Form->input('brn', ['label' => __('Brn')]);
                                echo $this->Form->input('religion', ['value'=>$applicant_application_info['religion'],'options' => $religions, 'empty' => __('Select'), 'class' => 'form-control', 'label' => __('Religion')]);
                                echo $this->Form->input('present_address', ['value'=>$applicant_application_info['present_address'],'type' => 'textarea', 'escape' => false, 'label' => __('Present_address')]);
                                echo $this->Form->input('permanent_address', ['value'=>$applicant_application_info['permanent_address'],'type' => 'textarea', 'escape' => false, 'label' => __('Permanent_address')]);
                                ?>

                            </div>
                            <div class="tab-pane" id="tab3">
                                <h3 class="block"><?= __('Previous History') ?></h3>
                                <?php
                                echo $this->Form->input('application_type_id', ['options' => $applicationTypes, 'empty' => __('Select'), 'required' => 'required', 'class' => 'form-control division ', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('application_reason', ['label' => __('Application_reason')]);
                                echo $this->Form->input('start_date', ['type' => 'text', 'class' => 'form-control ', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                echo $this->Form->input('end_date', ['type' => 'text', 'class' => 'form-control ', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                ?>
                                <div id="file_wrapper">
                                    <div class="file_div" data-index_no="0">
                                        <div class="form-group input file required" aria-required="true">
                                            <label for="document-file"
                                                   class="mandetory col-sm-3 control-label text-right">ডকুমেন্ট
                                                ফাইল</label>

                                            <div class="col-sm-4 container_file_label[]">
                                                <input id="file-label" class="form-control" type="text"
                                                       name="file_label[]" required="required" aria-required="true">
                                            </div>
                                            <div class="col-sm-3 container_document_file[]">
                                                <input type="file" name="document_file[]" class="" id="document-file"
                                                       required="required" multiple="multiple" aria-required="true">
                                            </div>
                                            <div class="col-sm-1">
                                                <span class='btn btn-success add_file'>+</span>
                                            </div>
                                            <div class="col-sm-1">
                                                <span class='btn btn-danger remove_file'>-</span>
                                            </div>
                                        </div>
                                        <!--                                    --><?php
                                        //                                    echo $this->Form->input('file_label[]', ['required' => 'required', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                        //                                    echo $this->Form->input('document_file[]', ['type' => 'file', 'multiple', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right'], 'required' => 'required']);
                                        //                                     ?>

                                    </div>
                                </div>
                                <?php
                                echo $this->Form->input('is_foregin_tour', ['type' => 'checkbox', 'class' => 'form-control text-right', 'label' => __('is_foregin_tour')]);
                                ?>
                                <div class=" history" style="display: none">
                                    <?php
                                    echo $this->Form->input('pasport_number', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    echo $this->Form->input('applicant_using_passport_validity', ['type' => 'text', 'class' => 'form-control datepicker', 'label' => ['escape' => false, 'class' => ' mandetory col-sm-3 control-label text-right']]);
                                    echo $this->Form->input('using_passport_issue_place', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                    echo $this->Form->input('foregin_tour_country', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);

                                    echo $this->Form->input('have_foregin_tour', ['type' => 'checkbox', 'label' => __('have_foregin_tour')]);
                                    ?>
                                    <div class="last_tour" style="display: none">
                                        <?php
                                        echo $this->Form->input('last_foreign_tour_country', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                        echo $this->Form->input('last_foreign_tour_reason', ['label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                        echo $this->Form->input('last_foreign_tour_time', ['type' => 'text', 'class' => 'form-control  datepicker', 'label' => ['escape' => false, 'class' => 'mandetory col-sm-3 control-label text-right']]);
                                        ?>
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane tab4" id="tab4">


                                <div class="form-group input  required" aria-required="true">
                                    <label for="" class="mandetory col-sm-1 control-label text-right"><?= __('To') ?></label>
                                    <div class="col-sm-9 container_file_label[]">
                                        <textarea class="form-control" name="application_head" rows="2" required>
                                              <p><?= __('To') ?></p>
                                                <p><?= __('HEAD_1') ?></p>
                                                <p><?= __('HEAD_2') ?></p>
                                                <p><?= __('HEAD_3') ?></p>
                                                <p><?= __('HEAD_4') ?></p>
                                        </textarea>
                                    </div>

                                </div>

                                <div class="form-group input  required" aria-required="true">
                                    <label for="" class="mandetory col-sm-1 control-label text-right"><?= __('Subject') ?></label>
                                    <div class="col-sm-9 container_file_label[]">
                                        <textarea class="form-control" name="application_subject" rows="2" id="application_subject" required> বহিঃ বাংলাদেশ ভ্রমনের ছুটি অনুমোদন প্রসঙ্গে ৷
                                        </textarea>
                                    </div>

                                </div>

                                <div class="form-group input file required" aria-required="true">
                                    <label for="" class="mandetory col-sm-1 control-label text-right"><?= __('Body') ?></label>
                                    <div class="col-sm-9 container_file_label[]">
                                        <textarea class="form-control editor1" name="application_body" rows="8" id="" required>
                                                            উপর্যুক্ত বিষয়ের আলোকে তাঁর দৃষ্টি আকর্ষণ পূর্বক জানানো যাচ্ছে যে, আমি প্রশাসক হিসেবে জেলা পরিষদ গোপালগঞ্জ এ কর্মরত রয়েছি।আমার শারীরিক অসুস্ততার চিকিৎসার জন্য ইতোপূর্বে ভারতের ডাক্তারের পরামর্শ এবং ব্যবস্তাপত্র গ্রহণ করা হয়। আমি ভারতের কোলকাতায় টাটা মেডিক্যাল সেন্টারে ডাক্তারের অধীনে চিকিৎসাধীন রয়েছি।আমার পাসপোর্ট নং BB 0338397। উল্লেখ্য যে আমার রক্ত পরিক্ষা করার জন্য নমুনা দাখিলের পর রিপোর্ট প্রাপ্তির জন্য এক সপ্তাহ সময় প্রয়োজন হয়। চিকিৎসার স্বার্থে আমাকে রক্ত দেবার জন্য ০১/১১/২০১৬ ইং তারিখে কোলকাতায় গিয়ে ২/১ দিন পরে ফিরে এসে ডাক্তারের পরামর্শে পুনরায় ০৮/১১।২০১৬ তারিখে কোলকাতায় যাওয়া প্রয়োজন।
<br/>
<br/>
<br/>
উল্লেখিত অবস্থাধীনে আমাকে আগামী ../../.. তারিখ হতে ../../.. ইং তারিখ পর্যন্ত বহিঃ বাংলাদেশ ভ্রমনের জন্য ছুটি অনুমোদন এবং ০১/১১/২০১৬ ইং তারিখ কর্মস্তল ত্যাগ করার অনুমোদনের প্রয়োজনীয় বাবস্থার জন্য অনুরোধ করা হলো।

                                        </textarea>
                                    </div>
                                </div>


                            </div>

                            <div class="tab-pane tab4" id="tab5" >
                                <h3 class="block"><?= __('Confirm your account') ?></h3>

                                <div class="form-group">
                                    <label class="control-label col-md-6"><?= __('Applicant Name Bn') ?>:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="applicant_name_bn">
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6"><?= __('Mother_name_bn') ?>:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="mother_name_bn">
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6"><?= __('Father_name_bn') ?>:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="father_name_bn">
                                        </p>
                                    </div>
                                </div>




                                <div class="form-group">
                                    <label class="control-label col-md-6"><?= __('Cellphone') ?>:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="cellphone">
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6"><?= __('Nid') ?>:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="nid">
                                        </p>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-6"><?= __('Religion') ?>:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="religion">
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6"><?= __('Present_address') ?>:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="present_address">
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6"><?= __('Permanent_address') ?>:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="permanent_address">
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6"><?= __('ApplicationTypes') ?>:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="application_type_id">
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6"><?= __('Application_reason') ?>:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="application_reason">
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6"><?= __('Start Date') ?>:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="start_date">
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6"><?= __('End Date') ?>:</label>

                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="end_date">
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="javascript:;" class="btn default button-previous">
                                    <i class="m-icon-swapleft"></i> <?= __('Back') ?> </a>
                                <a href="javascript:;" class="btn blue button-next">
                                    <?= __('Continue') ?> <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                                <a href="javascript:;" class="btn green button-submit">
                                    <?= __('Submit') ?> <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'application_head');

    CKEDITOR.replace( 'application_body');
</script>

<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            dateFormat: 'dd-mm-yy'
        })

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
                url: '<?= $this->Url->build('/CitizenCorner/ajax/get_applicantTypes')?>',
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
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_districts')?>',
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
            var applicantTypes_id = obj.closest('#tab1').find('.applicantTypes option:selected').val();

            var district_id = $(this).val();

            if (applicantTypes_id > 4 && applicantTypes_id < 8 || applicantTypes_id > 13) {

                $('#upazila').show();

                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_upazilas')?>',
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
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_city_corporations')?>',
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
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_municipals')?>',
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
            var applicantTypes_id = obj.closest('#tab1').find('.applicantTypes option:selected').val();

            var district_id = obj.closest('#tab1').find('.districts option:selected').val();

            var upazila_id = $(this).val();
            if (applicantTypes_id > 13) {
                $('#union').show('');
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_unions')?>',
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
            var applicantTypes_id = obj.closest('#tab1').find('.applicantTypes option:selected').val();

            var district_id = obj.closest('#tab1').find(' .districts option:selected').val();

            var city_corporation_id = $(this).val();
            if (applicantTypes_id == 9) {
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_city_corporation_wards')?>',
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
            var applicantTypes_id = obj.closest('#tab1').find('.applicantTypes option:selected').val();

            var district_id = obj.closest('#tab1').find(' .districts option:selected').val();

            var municipal_id = $(this).val();
            if (applicantTypes_id == 12) {
                $('#municipal_ward').show();
                $.ajax({
                    url: '<?= $this->Url->build('/CitizenCorner/ajax/get_municipal_wards')?>',
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
            var applicantTypes_id = obj.closest('#tab1').find('.applicantTypes option:selected').val();

            if (applicantTypes_id == 15) {
                $('#ward').show();
                $('.ward').removeAttr('class', 'hide');
            }
        });


        $("#is-foregin-tour").on("click", function () {
            if ($(this).is(':checked')) {
                $('.history').show();
                $('#pasport-number').attr('required', 'required');
                $('#applicant-using-passport-validity').attr('required', 'required');
                $('#using-passport-issue-place').attr('required', 'required');
                $('#foregin-tour-country').attr('required', 'required');
            } else {
                $('.history').hide();
                $('#pasport-number').removeAttr('required', 'required');
                $('#applicant-using-passport-validity').removeAttr('required', 'required');
                $('#using-passport-issue-place').removeAttr('required', 'required');
                $('#foregin-tour-country').removeAttr('required', 'required');
            }
        });

        $("#have-foregin-tour").on("click", function () {
            if ($(this).is(':checked')) {
                $('.last_tour').show();
                $('#last-foreign-tour-country').attr('required', 'required');
                $('#last-foreign-tour-reason').attr('required', 'required');
                $('#last-foreign-tour-time').attr('required', 'required');
            } else {
                $('.last_tour').hide();
                $('#last-foreign-tour-country').removeAttr('required', 'required');
                $('#last-foreign-tour-reason').removeAttr('required', 'required');
                $('#last-foreign-tour-time').removeAttr('required', 'required');
            }
        });


        //For add new file option

        $(document).on('click', '.add_file', function () {

            var index = $('.file_div').data('index_no');
            $('.file_div').data('index_no', index + 1);


            $('.file_div:last').clone()
                .find("input:text, input:file").val("").end()
                .appendTo('#file_wrapper');
        });

        $(document).on('click', '.remove_file', function () {
            var obj = $(this);
            var count = $('.file_div').length;
            if (count > 1) {
                obj.closest('.file_div').remove();
            }
        });



        //valudation relatted
//        $.validator.setDefaults({
//////        debug: true,
////            success: "valid",
//            ignore: [],
//        });
        $( "#submit_form" ).validate({
//            ignore: [],
            rules: {
                'document_file[]': {
                    required: true,
                    extension: "jpg|jpeg|png|doc|pdf|xls|xlsx"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        $('[name^="cellphone').rules('add', {
            regex: "^(?:\\+?88)?01[15-9]\\d{8}$"
        });
        //adding new regex method to jquery validator
        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please enter a valid mobile number"
        );
    });

    $(function () {
        $("#start-date").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $("#end-date").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#end-date").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $("#start-date").datepicker("option", "maxDate", selectedDate);
            }
        });


    });

    function isValidForm() {
        var response = true;
        if ($('#tab1').hasClass('active')) {
            var location_type = $('#location-type-id ').val();
            var applicant_type = $('#applicant-type-id').val();
            var divsion_id = $('#divsion-id').val();
            var district_id = $('#district-id').val();
            var upazila_id = $('#upazila-id').val();
            var city_corporation_id = $('#city-corporation-id').val();
            var city_corporation_ward_id = $('#city-corporation-ward-id').val();
            var municipal_id = $('#municipal-id').val();
            var municipal_ward_id = $('#municipal-ward-id').val();
            var union_id = $('#union-id').val();
            var union_ward = $('#union-ward').val();

            if (!location_type) {
                response = false;
                alert('please select location_type');
            }
            if (location_type == 1) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                }
            } else if (location_type == 2) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!upazila_id) {
                    response = false;
                    alert('please select upazila');
                }
            } else if (location_type == 3) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!city_corporation_id) {
                    response = false;
                    alert('please select city_corporation');
                }
            } else if (location_type == 4) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!city_corporation_id) {
                    response = false;
                    alert('please select city_corporation');
                } else if (!city_corporation_ward_id) {
                    response = false;
                    alert('please select city_corporation_ward');
                }
            } else if (location_type == 5) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!municipal_id) {
                    response = false;
                    alert('please select municipal');
                }
            } else if (location_type == 6) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!municipal_id) {
                    response = false;
                    alert('please select municipal');
                } else if (!municipal_ward_id) {
                    response = false;
                    alert('please select municipal_ward');
                }
            } else if (location_type == 7) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!upazila_id) {
                    response = false;
                    alert('please select upazila');
                } else if (!union_id) {
                    response = false;
                    alert('please select union');
                }
            } else if (location_type == 8) {
                if (!applicant_type) {
                    response = false;
                    alert('please select applicant_type');
                } else if (!divsion_id) {
                    response = false;
                    alert('please select divsion');
                } else if (!district_id) {
                    response = false;
                    alert('please select district');
                } else if (!upazila_id) {
                    response = false;
                    alert('please select upazila');
                } else if (!union_id) {
                    response = false;
                    alert('please select union');
                } else if (!union_ward) {
                    response = false;
                    alert('please select union_ward');
                }
            }
        }
        else if ($('#tab2').hasClass('active')) {
            response = true;
        }
        else if ($('#tab3').hasClass('active')) {
            response = true;
        }
        return response;
    }
</script>
<style>
    .ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
        color: #000;
    }
</style>
<!--<script>-->
<!---->
<!--    $.validator.setDefaults({-->
<!--//        debug: true,-->
<!--        success: "valid",-->
<!--        ignore: [],-->
<!--    });-->
<!--    $( "#submit_form" ).validate({-->
<!--        rules: {-->
<!--            'file_label[]': {-->
<!--                required: true,-->
<!--                extension: "jpg|jpeg|png|doc|pdf|xls|xlsx"-->
<!--            }-->
<!--        },-->
<!--        submitHandler: function(form) {-->
<!--            form.submit();-->
<!--        }-->
<!--    });-->
<!--    $('[name^="cellphone').rules('add', {-->
<!--        regex: "^(?:\\+?88)?01[15-9]\\d{8}$"-->
<!--    });-->
<!--    //adding new regex method to jquery validator-->
<!--    $.validator.addMethod(-->
<!--        "regex",-->
<!--        function(value, element, regexp) {-->
<!--            var re = new RegExp(regexp);-->
<!--            return this.optional(element) || re.test(value);-->
<!--        },-->
<!--        "Please enter a valid mobile number"-->
<!--    );-->
<!--</script>-->