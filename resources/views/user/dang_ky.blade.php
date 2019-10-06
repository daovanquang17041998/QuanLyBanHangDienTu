<div class="view-dang-ky">
    <form action="" method="post">
        <table border="1">
            <tr>
                <td>Full name</td>
                <td><input type="text" name="full_name"></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="user_name"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Đăng ký</button>
                </td>
            </tr>
        </table>
        {{csrf_field()}}
    </form>
</div>