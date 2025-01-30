<x-authlayout>
    <h1 class="title">User List</h1>
    <div class="border p-4 rounded-lg mt-4">
        <table class="table-auto w-full">
            <thead class="border-b text-left">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-authlayout>
