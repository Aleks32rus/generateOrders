<?
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orders";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$results = $conn->query("select * from crm_clients where server='" . $_POST['server2'] . "'");
if (mysqli_num_rows != 0) {
    ?>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <table>
        <thead>
        <tr>
            <th>Номер клиента</th>
            <th>Тип</th>
        </tr>
        </thead>
        <tbody>
        <? while ($data = $results->fetch_assoc()): ?>
            <tr>
                <td><? echo $data['num'] ?></td>
                <td><? echo $data['server'] ?></td>
            </tr>

        <? endwhile; ?>
        </tbody>
    </table>
<? } else { ?>
    <div class="bar error">Клиенты не найдены</div>
<? } ?>