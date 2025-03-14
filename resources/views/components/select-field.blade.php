<select name="{{ $name }}">
    @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ (string) $selected === (string) $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
