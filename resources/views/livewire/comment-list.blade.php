<div>
    @for ($i = 0; $i < count($data); $i++)
        <livewire:comment
            :id="$data[$i]['id']"
            :author="$data[$i]['author']"
            :comment="$data[$i]['comment']"
        />
    @endfor
</div>
