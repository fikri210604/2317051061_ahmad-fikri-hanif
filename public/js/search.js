$(document).ready(function () {
    function fetchUsers() {
        let search = $('#search').val();
        let kelas_id = $('#kelas_id').val();

        $.ajax({
            url: "/user",
            type: "GET",
            data: { search: search, kelas_id: kelas_id },
            success: function (response) {
                let html = "";
                if (response.users.length > 0) {
                    response.users.forEach(user => {
                        html += `<tr class="border-b hover:bg-indigo-50 transition">
                                    <td class="px-6 py-4">${user.id}</td>
                                    <td class="px-6 py-4">${user.nama_mahasiswa}</td>
                                    <td class="px-6 py-4">${user.nim}</td>
                                    <td class="px-6 py-4 ">
                                    <span class="px-3 py-1 rounded-full text-white bg-indigo-500">${user.kelas ? user.kelas.nama_kelas : '-'}</span></td>
                                    <td class="px-6 py-4 space-x-2">
                                        <button class="btn btn-sm btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEdit${user.id}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalDelete${user.id}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>                                </tr>`;
                    });
                } else {
                    html = `<tr><td colspan="4" class="text-center text-gray-500 py-4">Data tidak ditemukan</td></tr>`;
                }
                $('#userTableBody').html(html);
            }
        });
    }

    // Trigger saat ketik atau pilih kelas
    $('#search').on('keyup', fetchUsers);
    $('#kelas_id').on('change', fetchUsers);
});
