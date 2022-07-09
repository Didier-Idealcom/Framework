<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
    <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
<?php endif; ?>

<?php if ($showField): ?>
    <?php if (isset($options['translatable']) && $options['translatable'] === true): ?>
    <div class="input-group justify-content-end">
    <?php endif; ?>

    <?= Form::textarea($name, $options['value'], $options['attr']) ?>

    <?php if (isset($options['translatable']) && $options['translatable'] === true): ?>
        <div class="input-group-append">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $options['attr']['data-lang-libelle']; ?></button>
            <div class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-175px py-4">
                <div class="menu-item px-3">
                    <a class="menu-link px-3 lang-change" href="#" data-lang="fr">Français</a>
                </div>
                <div class="menu-item px-3">
                    <a class="menu-link px-3 lang-change" href="#" data-lang="en">Anglais</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="grapesjs_container" id="<?php echo $name; ?>_grapesjs" data-textarea="<?php echo $name; ?>">
        <?= $options['value'] ?>
    </div>

    <?php include realpath(__DIR__ . '/../vendor/laravel-form-builder/help_block.php') ?>
<?php endif; ?>

<?php include realpath(__DIR__ . '/../vendor/laravel-form-builder/errors.php') ?>

<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    </div>
    <?php endif; ?>
<?php endif; ?>
