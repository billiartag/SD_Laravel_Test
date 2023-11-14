<div>
    @for ($i = 0; $i < count($data); $i++)
        <livewire:post
            :id="$data[$i]['postId']"
            :title="$data[$i]['title']"
            :author="$data[$i]['author']"
            :content="$data[$i]['content']"
        />
    @endfor
</div>
