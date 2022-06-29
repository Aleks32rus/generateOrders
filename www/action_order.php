<?
require_once "db_conn.php";
$results = $conn->query("select *,
case 
	when type='1' then 'НК-СТ'
	when type='2' then 'КК-СТ'
	when type='3' then 'ИК-СТ'
	when type='4' then 'ИК-СТ (андер)'
	when type='5' then 'НК-НТ (андер)'
end as type,
case 
	when status='1' then 'Оформление'
	when status='2' then 'Принятие решения'
	when status='3' then 'Утверждена'
end as status
from crm_orders where server='" . $_POST['server2'] . "'");
$count_result = mysqli_num_rows($results);

echo $_POST['point_num'];
echo $_POST['status'];
?>
<div class="bar success">Количество найденных заявок: <? echo $count_result ?></div>
<link rel="stylesheet" href="css/style.css" type="text/css"/>
<table>
    <thead>
    <tr>
        <th>Номер заявки</th>
        <th>Тип</th>
        <th>Статус</th>
        <th>Номер точки</th>
        <th>Сервер</th>
        <th>Маршрут проверки</th>
    </tr>
    </thead>
    <tbody>
    <? while ($data = $results->fetch_assoc()): ?>
        <tr>
            <td><? echo $data['num'] ?></td>
            <td><? echo $data['type'] ?></td>
            <td><? echo $data['status'] ?></td>
            <td><? echo $data['point_num'] ?></td>
            <td><? echo $data['server'] ?></td>
            <td><? echo $data['route'] ?></td>
        </tr>

    <? endwhile; ?>
    </tbody>
</table>