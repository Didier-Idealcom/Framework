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

    <?php if ($options['url_show']): ?>
    <iframe src="<?= $options['url_show'] ?>" width="100%" height="600" frameborder="0"></iframe>
    <?php endif; ?>
    <visual-editor name="{{ $name }}" class="{{ $options['attr']['class'] }}" value="{{ $options['value'] }}" preview="{{ $options['url_preview'] }}" hidden></visual-editor>
    <button type="button" class="open_visual_editor">Afficher l'éditeur</button>

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

    <?php //include realpath(__DIR__ . '/../vendor/laravel-form-builder/help_block.php') ?>
    @include('vendor.laravel-form-builder.help_block')
<?php endif; ?>

<?php //include realpath(__DIR__ . '/../vendor/laravel-form-builder/errors.php') ?>
@include('vendor.laravel-form-builder.errors')

<?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
    </div>
    <?php endif; ?>
<?php endif; ?>
