<section class="register-section">
    <h1>Create Account</h1>

    <?php if (!empty($formConfig['config']['errorMessage'])): ?>
        <div class="error">
            <?= $formConfig['config']['errorMessage'] ?>
        </div>
    <?php endif; ?>

    <form action="<?= $formConfig['config']['action'] ?>" method="<?= $formConfig['config']['method'] ?>" class="<?= $formConfig['config']['class'] ?>" id="<?= $formConfig['config']['id'] ?>">
        <?php foreach ($formConfig['inputs'] as $name => $input): ?>
            <div class="form-group">
                <label for="<?= $input['id'] ?>"><?= $input['label'] ?></label>
                <input type="<?= $input['type'] ?>" name="<?= $name ?>" id="<?= $input['id'] ?>" placeholder="<?= $input['placeholder'] ?>" <?= $input['required'] ? 'required' : '' ?>>
            </div>
        <?php endforeach; ?>
        <button type="submit"><?= $formConfig['config']['submit'] ?></button>
    </form>
</section>
