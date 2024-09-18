<section class="register-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-12">
                <h1>Create Account</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-12">
                <?php if (!empty($formConfig['config']['errorMessage'])): ?>
                    <div class="error"><?= $formConfig['config']['errorMessage'] ?></div>
                <?php endif; ?>
                <form action="<?= $formConfig['config']['action'] ?>" method="<?= $formConfig['config']['method'] ?>"
                    class="<?= $formConfig['config']['class'] ?>" id="form-register">
                    <?php foreach ($formConfig['inputs'] as $name => $input): ?>
                        <div class="form-group">
                            <label for="<?= $input['id'] ?>"><?= $input['label'] ?></label>
                            <input type="<?= $input['type'] ?>" name="<?= $name ?>" id="<?= $input['id'] ?>"
                                placeholder="<?= $input['placeholder'] ?>" <?= $input['required'] ? 'required' : '' ?>>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-primary"><?= $formConfig['config']['submit'] ?></button>
                </form>
            </div>
        </div>
    </div>
</section>