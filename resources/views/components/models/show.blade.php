<div>
    <dl class="row">
        @foreach($fields as $field)
        <dd class="col-3 text-right">{{ __(sprintf('models.%s.fields.%s', $class, $field)) }}</dd>
        <dt class="col-9">{{ \Illuminate\Support\Arr::get($model, $field) ?: '--' }}</dt>
        @endforeach
    </dl>
</div>
