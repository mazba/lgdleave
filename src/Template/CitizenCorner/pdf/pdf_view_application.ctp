<?php
use Cake\Core\Configure;
$status = array_flip(Configure::read('application_status'));
$religions = Configure::read('religions');
?>

<style>
    table{
        width: 100%;
    }
    #head{
        line-height: 3px;
    }

    .head p{
        line-height: 3px;
    }
    .sincerely p{
        line-height: 5px;

    }


</style>
<div class="col-md-6 col-md-offset-3">


    <br/>
    <table>
        <tr id="head" ">
        <td  class="head" style="width: 70%;"><?php echo $applications['application_head']; ?></td>
        <td style="text-align: right;">SL:<?= $applications['temporary_id']?></td>
        </tr>
        <tr>
            <td colspan="2"><?php echo __('Subject').": ".$applications['application_subject']; ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <?php echo  $applications['application_body']; ?>
            </td>
        </tr>
        <tr>
            <td style="width:50% !important;">
                <?php
                $count=count($applications['applications_files']);
                $i=1;
                if($count):
                    echo __('Attach').':';
                    foreach($applications['applications_files'] as $key=>$file):
                        ?>
                        <?=$file['file_label'];if($i<$count){echo ',';} ?>

                        <?php
                        $i++;
                    endforeach;
                endif
                ?>
            </td>
            <td  style="width: 50%">
                <div class="sincerely" style="text-align: center">
                    <p>  <?php echo  __('Sincerely') ?><br/><br/><br/><br/><br/></p>
                    <p>  <?php echo  $applications['applicant_name_bn']; ?></p>
                    <p>  <?php echo  $applications['applicant_type']['title_bn'].','.$applications['location_type']['title_bn']; ?></p>


                    <p>
                        <?php if ($applications['municipal']): ?>
                            <?php echo $applications['municipal']['municipalname'].','; ?>
                        <?php endif ?>
                        <?php if ($applications['city_corporation']): ?>
                            <?php echo $applications['city_corporation']['citycorporationname'].','; ?>
                        <?php endif ?>
                        <?php if ($applications['area_upazila']): ?>
                            <?php echo $applications['area_upazila']['upazilaname'].','; ?>
                        <?php endif ?>
                        <?php if ($applications['union']): ?>
                            <?php echo $applications['union']['unionname'].','; ?>
                        <?php endif ?>

                        <?php if ($applications['area_district']): ?>
                            <?php echo $applications['area_district']['zillaname'].','; ?>
                        <?php endif ?>

                        <?php echo $applications['area_division']['divname']; ?>
                    </p>
                </div>
            </td>
        </tr>
    </table>

    <br/>

    <br/>
    <br/>



</div>