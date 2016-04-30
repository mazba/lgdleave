<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Blog Post'), ['action' => 'edit', $blogPost->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Blog Post'), ['action' => 'delete', $blogPost->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blogPost->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Blog Posts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blog Post'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="blogPosts view large-9 medium-8 columns content">
    <h3><?= h($blogPost->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($blogPost->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($blogPost->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($blogPost->status) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Post') ?></h4>
        <?= $this->Text->autoParagraph(h($blogPost->post)); ?>
    </div>
</div>
