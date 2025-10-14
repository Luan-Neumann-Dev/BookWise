<div class="p-2 rounded border-stone-800 border-2 bg-stone-900">
    <div class="flex gap-2">
        <div class="w-1/3">
            <img src="<?= $book->image ?>" alt="Imagem do Livro" class="w-60 rounded">
        </div>

        <div class=" flex flex-col gap-1">
            <a href="/livro?id=<?= $book->id ?>" class="font-semibold hover:underline"><?= $book->title ?></a>
            <div class="text-xs italic"><?= $book->author ?></div>
            <div class="text-xs italic"><?= str_repeat('⭐', $book->evaluation_note) ?>(<?= $book->evaluation_count ?> Avaliações)</div>
        </div>
    </div>
    <div class="text-sm mt-2"><?= $book->description ?></div>
</div>