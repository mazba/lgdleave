<?php
use Cake\Core\Configure;
$status = array_flip(Configure::read('application_status'));
$religions = Configure::read('religions');
?>
<div class="col-md-6 col-md-offset-3">

   <?php echo $application['application_head']; ?>
    <br/>
    <table>
        <tr>
            <td><?php echo __('Subject').": "; ?></td>
            <td><?php echo $application['application_subject']; ?></td>
        </tr>
    </table>

    <br/>
    <?php echo  $application['application_body']; ?>
    <br/>
    <br/>
    <?php
    if(count($application['applications_files'])):
        echo __('Attach').':';
        foreach($application['applications_files'] as $key=>$file):
            ?>
                <?=$file['file_label'].',' ?>

            <?php
        endforeach;
    endif
    ?>
   <div style="float: right; text-align: center">
       <?php echo  __('Sincerely') ?><br/><br/><br/>
       <?php echo  $application['applicant_name_bn']; ?>
   </div>

</div>