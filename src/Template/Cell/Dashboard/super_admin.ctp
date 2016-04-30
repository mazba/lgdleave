<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-chambray">
            <div class="visual">
                <i class="fa fa-bank"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php echo $office_number; ?>
                </div>
                <div class="desc">
                   <?= __('Total Office') ?>
                </div>
            </div>
            <?php
            echo $this->Html->link(__('View More'), ['action' => 'index','controller'=>'offices'], ['class' => 'more']);
            ?>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison ">
            <div class="visual">
                <i class="fa fa-users"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php echo $user_number; ?>
                </div>
                <div class="desc">
                    <?= __('Total User') ?>
                </div>
            </div>
            <?php
            echo $this->Html->link(__('View More'), ['action' => 'index','controller'=>'users'], ['class' => 'more']);
            ?>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense ">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php echo $item_number; ?>
                </div>
                <div class="desc">
                    <?= __('Number Of Item') ?>
                </div>
            </div>
            <?php
            echo $this->Html->link(__('View More'), ['action' => 'index','controller'=>'items'], ['class' => 'more']);
            ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="portlet green-haze box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i><?= __('Office Info') ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?= __('Office') ?></th>
                                <th><?= __('Number of Items') ?></th>
                                <th><?= __('Number of Rooms') ?></th>
                                <th><?= __('Number of Buildings') ?></th>
                                <th><?= __('Number of Committees') ?></th>
                                <th><?= __('Number of Units') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($office_items as $office): ?>
                                <tr>
                                    <th><?php echo $office->name_bn; ?></th>
                                    <td><?php echo count($office->items); ?></td>
                                    <td><?php echo count($office->office_rooms); ?></td>
                                    <td><?php echo count($office->office_buildings); ?></td>
                                    <td><?php echo count($office->committees); ?></td>
                                    <td><?php echo count($office->office_units); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>