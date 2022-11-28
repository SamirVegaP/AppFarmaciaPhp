<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Css/report_style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="Reportes/reports.php" method="post">
            <img src="../../Img/Empleados.png" alt="">
            <input type="text" class = "texthidden">
            <input type="submit" value="Reportes de Empleados" name = "ReportEmployee">
        </form>
        <form action="Reportes/reports.php">
            <img src="../../Img/Ventas.png" alt="">
            <input type="text" class = "texthidden">
            <input type="submit" value="Reportes de Ventas" name = "ReportSeal">
        </form>
        <form action="Reportes/reports.php">
            <img src="../../Img/DetallesVenta.png" alt="">
            <input type="text" name="IDSeal">
            <input type="submit" value="Detalles de Venta" name = "ReportDetailSeal">
        </form>
        <form action="Reportes/reports.php">
            <img src="../../Img/Compras.png" alt="">
            <input type="text" class = "texthidden">
            <input type="submit" value="Reportes de Compras" name = "ReportBuyout">
        </form>
        <form action="Reportes/reports.php">
            <img src="../../Img/DetallesCompra.png" alt="">
            <input type="text" name="IDBuyout">
            <input type="submit" value="Detalles de Compra" name = "ReportDetailBuyout">
        </form>
        <form action="Reportes/reports.php">
            <img src="../../Img/Clientes.png" alt="">
            <input type="text" class = "texthidden">
            <input type="submit" value="Reportes de Clientes" name = "ReportClient">
        </form>
        <form action="Reportes/reports.php">
            <img src="../../Img/Productos.png" alt="">
            <input type="text" class = "texthidden">
            <input type="submit" value="Reportes de Productos" name = "ReportProducts">
        </form>
        <form action="Reportes/reports.php">
            <img src="../../Img/Laboratorio.png" alt="">
            <input type="text" class = "texthidden">
            <input type="submit" value="Reportes de Laboratorios" name = "ReportLabs">
        </form>
    </div>
</body>
</html>