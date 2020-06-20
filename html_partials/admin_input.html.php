<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="<?= $name ?>">
            <?= $label; ?>
        </label>
        <input class="appearance-none block w-full bg-gray-200 
            text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 
            leading-tight focus:outline-none  focus:border-gray-500 focus:bg-white" id="<?= $name ?>" name="<?= $name ?>" type="<?= $type ?? 'text' ?>" value="<?= get_previous_input('name') ?? $model->{$name} ?? ''; ?>" placeholder="Jane">
        <?php if (get_previous_error('name')) : ?>
            <p class="text-red-500 text-xs italic p-1 mb-3 ">
                <?= get_previous_error('name'); ?>
            </p>
        <?php endif; ?>
    </div>
</div>