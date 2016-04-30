<?php
$item_withdrawal_type = \Cake\Core\Configure::read('item_withdrawal_type');
$item_withdrawal_type=array_flip($item_withdrawal_type);
$item_assign_type = \Cake\Core\Configure::read('item_assign_type');
$item_assign_type=array_flip($item_assign_type);
?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet green-haze box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bank"></i><?= __('Recently Assigned Items') ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?= __('Item') ?></th>
                                <th><?= __('Assigned Type') ?></th>
                                <th><?= __('Assigned Date') ?></th>
                                <th><?= __('Item Office') ?></th>
                                <th><?= __('Item Manufacturer') ?></th>
                                <th><?= __('Quantity') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($recently_assigned_items as $item): ?>
                                <tr>
                                    <td><?php echo $item->item->title_bn.'('.$item->item->office_serial_number.')'; ?></td>
                                    <td><?php echo $item_assign_type[$item->assign_type]; ?></td>
                                    <td><?php echo $item->formatted_assign_date; ?></td>
                                    <td><?php echo $item->item->office->name_bn; ?></td>
                                    <td><?php echo $item->item->manufacturer->name_bn; ?></td>
                                    <td><?php echo $item->quantity; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="portlet green-haze box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bank"></i><?= __('Recently Withdrawal Items') ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?= __('Item') ?></th>
                                <th><?= __('Assigned Type') ?></th>
                                <th><?= __('Withdrawal Date') ?></th>
                                <th><?= __('Office') ?></th>
                                <th><?= __('Quantity') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($recently_withdrawal_items as $item): ?>
                                <tr>
                                    <td><?php echo $item->item_assign->item->title_bn.'('.$item->item_assign->item->office_serial_number.')'; ?></td>
                                    <td><?php echo $item_withdrawal_type[$item->withdrawal_type]; ?></td>
                                    <td><?php echo $item->formatted_withdrawal_time ?></td>
                                    <td><?php echo $item->office->name_bn; ?></td>
                                    <td><?php echo $item->item_assign->item->quantity; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>