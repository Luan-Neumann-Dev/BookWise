<?php
    require_once 'partials/_book.php'
?>
<h2>Avaliações</h2>
<div class="grid grid-cols-4 gap-4">
    <div class="col-span-3 gap-4 flex flex-col">
        <?php foreach($evaluations as $evaluation): ?>
            <div class="border border-stone-700 rounded min-h-[80px]">
                <?= $evaluation->evaluation ?>
                <?php
                $nota = str_repeat('⭐', $evaluation->note)
                ?>
                <?= $nota ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div>
        <?php if (auth()): ?>
                <div class="border border-stone-700 rounded">
                    <h1 class="border-b border-stnoe-700 text-stone-400 font-bold px-4 py-2">
                        Me conte o que achou!
                    </h1>
                    <form class="p-4 space-y-4" method="POST" action="/avaliacao-criar">
                        <?php if($validations = flash()->get('validations')): ?>
                            <div class="border-red-800 bg-red-900 text-red-400 px-4 py-1 rounded-md border-2 text-sm font-bold">
                                <ul>
                                    <?php foreach($validations AS $validation): ?>
                                        <li><?= $validation ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="flex flex-col">
                            <input name="book_id" value="<?= $book->id ?>" type="hidden">
                            <label class="text-stone-400 mb-1">Avaliação</label>
                            <textarea name="evaluation" class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 w-full"></textarea>
                        </div>

                        <div class="flex flex-col">
                            <label class="text-stone-400 mb-1">Nota</label>
                            <select name="note" class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 w-full">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5" selected>5</option>
                            </select>
                        </div>
                        <button type="submit" class="border-stone-800 bg-stone-900 text-stone-400 px-4 py-1 rounded-md border-2 hover:bg-stone-700">
                            Salvar
                        </button>
                    </form>
                </div>
        <?php endif; ?>
    </div>
</div>