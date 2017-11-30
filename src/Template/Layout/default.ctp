<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->element('Layout/head') ?>
</head>
<body>
    <?= $this->element('Layout/navbar') ?>
    <div class="container">
        <h1><?= $this->fetch('title') ?></h1>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <?= $this->element('Layout/footer') ?>
</body>
</html>
