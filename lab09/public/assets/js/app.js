$(document).ready(function() {
    loadList();

    // 1. Load danh sách
    function loadList() {
        $.get('index.php?url=student/api&action=list', function(res) {
            let html = '';
            if (res.data && res.data.length > 0) {
                res.data.forEach((sv, index) => {
                    html += `<tr>
                        <td>${index + 1}</td>
                        <td>${sv.code}</td>
                        <td>${sv.full_name}</td>
                        <td>${sv.email}</td>
                        <td>${sv.dob || ''}</td>
                        <td>
                            <button onclick="editSv(${sv.id})">Sửa</button>
                            <button onclick="deleteSv(${sv.id})">Xóa</button>
                        </td>
                    </tr>`;
                });
            } else {
                html = '<tr><td colspan="6" align="center">Chưa có dữ liệu</td></tr>';
            }
            $('#studentTableBody').html(html);
        });
    }

    // 2. Thêm mới hoặc Cập nhật
    $('#studentForm').submit(function(e) {
        e.preventDefault();
        $.post('index.php?url=student/api&action=save', $(this).serialize(), function(res) {
            alert(res.message);
            if (res.success) {
                $('#studentForm')[0].reset();
                $('#student_id').val('');
                $('#btnSubmit').text('Thêm mới');
                loadList();
            }
        });
    });

    // 3. Xóa
    window.deleteSv = function(id) {
        if (confirm('Bạn có chắc chắn muốn xóa sinh viên này?')) {
            $.post('index.php?url=student/api&action=delete', { id: id }, function(res) {
                alert(res.message);
                if (res.success) loadList();
            });
        }
    };

    // 4. Đổ dữ liệu lên form để sửa
    window.editSv = function(id) {
        $.get('index.php?url=student/api&action=get&id=' + id, function(res) {
            if (res.success) {
                const sv = res.data;
                $('#student_id').val(sv.id);
                $('#code').val(sv.code);
                $('#full_name').val(sv.full_name);
                $('#email').val(sv.email);
                $('#dob').val(sv.dob);
                $('#btnSubmit').text('Cập nhật');
                window.scrollTo(0,0);
            }
        });
    };
});