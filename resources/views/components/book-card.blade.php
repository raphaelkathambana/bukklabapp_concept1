<div class="flex flex-col rounded-2xl w-64 bg-[#ffffff] shadow-xl">
    <!--[-->
    <figure class="flex items-center justify-center rounded-2xl overflow-hidden">
        <img src="{{ $cover }}" alt="Card Preview" class="rounded-t-2xl w-full object-cover">
    </figure>
    <!--]-->
    <div class="flex flex-col p-6">
        <div class="text-2xl font-bold text-center text-[#374151] pb-4 break-words">{{ $title }}</div>
        <div class="text-base text-[#6B7280] pb-4 break-words">{{ $author }}</div>
        <!--[-->
        <div class="flex justify-end pt-4">
            <a class="bg-primary-600 text-[#ffffff] w-full font-bold text-base p-3 rounded-lg hover:bg-primary-400 active:scale-95 transition-transform transform text-center"
                href="{{ route('books.show', $id) }}">Jump in</a>
        </div>
        <!--]-->
    </div>
</div>
