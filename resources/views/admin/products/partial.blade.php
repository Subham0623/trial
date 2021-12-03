<table>
            @foreach($licenses as $license)
            <tr>
                <td><input {{ $license->value ? 'checked' : null }} data-id="{{ $license->id }}" type="checkbox" class="license-enable"></td>
                <td>{{ $license->name }}</td>
                <td><input value="{{ $license->value ?? null }}" {{ $license->value ? null : 'disabled' }} data-id="{{ $license->id }}" name="licenses[{{ $license->id }}]" type="text" class="license-amount form-control" placeholder="Price"></td>
            </tr>
            @endforeach
</table>

