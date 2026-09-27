@props(['rows', 'columns', 'emptyMessage' => 'Belum ada data pengguna.'])

<div class="table-scroll">
    <table class="data-table">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th scope="col">{{ $column['label'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr>
                    @foreach ($columns as $column)
                        <td>{{ data_get($row, $column['key']) }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td class="empty-state" colspan="{{ count($columns) }}">{{ $emptyMessage }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>