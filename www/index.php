<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Получение тестовых данных</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <script type="text/javascript" src="js/linkedselect.js"></script>
    <script src="js/jquery.js"></script>
</head>
<body>
<form id="orderForm" method="POST" class="form-style">
    <div class="center">
        <label for="serverlbl2">Koнтyp:</label>
        <select id="server2" name="server2" class="select-css">
            <option value="TEST">TEST</option>
            <option value="PREPROD">PREPROD</option>
        </select>

        <fieldset>
            <legend>Получение заявки из пула данных</legend>
            <div id="type_box">
                <label for="orderTypelbl">Tnn заявки:</label>
                <select id="order_types" name="order_types" class="select-css">
                    <option value="1">HK-CT</option>
                    <option value="2">KK-CT</option>
                    <option value="3">ИK-CT</option>
                    <option value="4">ИK-CT (андер)</option>
                    <option value="5">НK-НT (андер)</option>
                </select>
            </div>

            <div id="status_box">
                <label for="orderStatuslbl">Статус заявки:</label>
                <select id="status" name="status" class="select-css"></select>
            </div>

            <div id="point_box">
                <label for="orderPoinNumtlbl">Toчка заявки:</label>
                <select id="point_num" name="point_num" class="select-css">
                </select>
            </div>

            <div id="route_box">
                <label for="orderRoutelbl">Маршрут проверки:</label>
                <select id="route_check" name="route_check" class="select-css">
                </select>
            </div>

            <div id='loading'>
                <img src='loader.gif'/>
            </div>
            <div id="orderResult">
            </div>

        </fieldset>
        <button type="submit" value="Submit" id="getOrder" class="floating-button">Получить заявки</button>
</form>

<script type="text/javascript">
    var syncListl = new syncList;
    syncListl.dataList = {
        '1': {
            'making': 'Оформление',
            'decision': 'Принятие решения',
            'approved': 'Утверждена'
        },
        '2': {
            'making': 'Оформление',
            'decision': 'Принятие решения',
            'approved': 'Утверждена'
        },
        '3': {
            'making': 'Оформление',
            'decision': 'Принятие решения',
            'approved': 'Утверждена'
        },
        '4': {'decision': 'Принятие решения'},
        '5': {'decision': 'Принятие решения'},

        'making': {
            'pre-scor': '15 - перед Пре-скорингом',
            'scor': '2 - перед скорингом'
        },
        'decision': {
            'decisionAnalist': '3 - перед Принять решение под АНАЛИТИКОМ',
            'actualAnalist': '25 - перед Актуализировать под АНАЛИТИКОМ',
            'decisionLPR': '4 - перед Принять решение Под ЛПР'
        },
        'approved': {'acceptManager': '5 - перед Ацепт под менеджером'},

        'decisionAnalist': {
            '1': 'Рассмотрение РВ ОАНЗ',
            '2': 'Рассмотрение ОАНЗ',
            '3': 'Согласование ОАНЗ',
        }

    };
    // Включаем синхронизацию связанных списков
    syncListl.sync("order_types", "status", "point_num", "route_check");
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#getOrder").click(
            function () {
                $.ajax({
                    url: "action_order.php",
                    cache: false,
                    beforeSend: function () {
                        $("#loading").show()
                    },
                    type: "POST",
                    dataType: "html",
                    data: $("#orderForm").serialize(),
                    success: function (data) {
                        $("#orderResult").html(data);
                        $("#loading").hide();
                    }

                });
                return false;
            }
        );
    })
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#getClient").click(
            function () {
                $.ajax({
                    url: "action_client.php",
                    cache: false,
                    beforeSend: function () {
                        $("#loading1").show()
                    },
                    type: "POST",
                    dataType: "html",
                    data: $("#orderForm").serialize(),
                    success: function (data) {
                        $("#clientResult").html(data);
                        $("#loading1").hide();
                    }
                });
                return false;
            }
        );

        $("select").change(function () {
            $(this).find("option:selected")
                .each(function () {
                    var optionValue = $(this).attr("value");
                    if (optionValue == '4') {
                        $("#status_box").hide();
                        $("#status option").remove();
                        $("#point_box").hide();
                        $("#point_num option").remove();
                        $("#route_box").hide();
                        $("#route_check option").remove();
                    } else if (optionValue == '5') {
                        $("#status_box").hide();
                        $("#status option").remove();
                        $("#point_box").hide();
                        $("#point_num option").remove();
                        $("#route_box").show();

                    } else {
                        $("#status_box").show();
                        $("#point_box").show();
                        $("#route_box").hide();
                        $("#route_check option").remove();
                    }
                });
        }).change();

    })
</script>

<form id="clientForm" method="POST">
    <div class="center">
        <label for="serverlbl2">Koнтyp:</label>
        <select id="server2" name="server2" class="select-css">
            <option value="TEST">TEST</option>
            <option value="PREPROD">PREPROD</option>
        </select>
    </div>
    <fieldset>
        <legend>Получение кода АБС клиента из пула</legend>
        <label for="clientTypelbl">Tnn клиента:</label>
        <select id="clientTypeSelect" name="client_type" class="select-css">
            <option selected="selected" value="l">Резидент</option>
        </select>
        <div id='loading1'>
            <img src='loader.gif'/>
        </div>
        <div id="clientResult">
        </div>
    </fieldset>
    <button type="submit" value="Submit" id="getClient" class="floating-button">Получить код AБC</button>
</form>
<a href="servers_status.php" class="floating-button">Гpaфик доступности серверов</a>
</body>
</html>