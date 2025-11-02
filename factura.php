<?php
// Biblioteca FPDF
require('fpdf186/fpdf.php');
require('php/conexion.php');
session_start();

// Verificar que se haya proporcionado un ID de pedido
if (!isset($_GET['id'])) {
    die("Error: No se proporcionó un ID de pedido.");
}
$id_pedido = intval($_GET['id']);

// Clase personalizada para el PDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('img/log.png',10,6,30);
        
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(80); // Mover a la derecha
        $this->Cell(30, 10, 'Factura AfterXGames', 0, 0, 'C'); // Título
        $this->Ln(20); // Salto de línea
    }

    // Pie de pagina
    function Footer()
    {
        $this->SetY(-15); // Posición a 1.5 cm del final
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C'); // Número de página
    }
}


// Datos de usuario y pedido desde la base de datos
// Si el usuario no está logueado, se asume como invitado
$sql_pedido = "SELECT p.id, p.fecha, p.total, u.nombre, u.correo, u.telefono
               FROM pedidos p
               LEFT JOIN usuarios u ON p.id_usuario = u.id
               WHERE p.id = ?";
               
$stmt_pedido = $conexion->prepare($sql_pedido);
$stmt_pedido->bind_param("i", $id_pedido);
$stmt_pedido->execute();
$resultado_pedido = $stmt_pedido->get_result();

if ($resultado_pedido->num_rows == 0) {
    die("Error: Pedido no encontrado.");
}
$pedido = $resultado_pedido->fetch_assoc();


// Crear PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Informacion de factura y cliente
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Detalles del Pedido', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(40, 7, 'ID Pedido:', 0, 0);
$pdf->Cell(0, 7, $pedido['id'], 0, 1);

$pdf->Cell(40, 7, 'Fecha:', 0, 0);
$pdf->Cell(0, 7, $pedido['fecha'], 0, 1);

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Informacion del Cliente', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);

// Verificacion de usuario, si no se asigna como invitado
if ($pedido['nombre']) {
    $pdf->Cell(40, 7, 'Nombre:', 0, 0);
    $pdf->Cell(0, 7, utf8_decode($pedido['nombre']), 0, 1);
    
    $pdf->Cell(40, 7, 'Correo:', 0, 0);
    $pdf->Cell(0, 7, $pedido['correo'], 0, 1);
    
    $pdf->Cell(40, 7, 'Telefono:', 0, 0);
    $pdf->Cell(0, 7, $pedido['telefono'], 0, 1);
} else {
    $pdf->Cell(0, 7, 'Compra de Invitado', 0, 1);
}

$pdf->Ln(10);

// Tabla de productos
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(230, 230, 230); // Color de fondo gris claro para el encabezado
$pdf->Cell(90, 10, 'Producto', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Precio Unit.', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Subtotal', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 12);

// Detalles del pedido
$sql_detalles = "SELECT nombre_producto, precio, cantidad
                 FROM detalles_pedido
                 WHERE id_pedido = ?";
$stmt_detalles = $conexion->prepare($sql_detalles);
$stmt_detalles->bind_param("i", $id_pedido);
$stmt_detalles->execute();
$resultado_detalles = $stmt_detalles->get_result();

while ($item = $resultado_detalles->fetch_assoc()) {
    $subtotal = $item['precio'] * $item['cantidad'];
    $pdf->Cell(90, 10, utf8_decode($item['nombre_producto']), 1, 0, 'L');
    $pdf->Cell(30, 10, $item['cantidad'], 1, 0, 'C');
    $pdf->Cell(30, 10, '$' . number_format($item['precio'], 2), 1, 0, 'R');
    $pdf->Cell(40, 10, '$' . number_format($subtotal, 2), 1, 1, 'R');
}

// Formato del total
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(150, 10, 'Total Pagado:', 1, 0, 'R');
$pdf->Cell(40, 10, '$' . number_format($pedido['total'], 2), 1, 1, 'R');


// 6. PDF al navegador
$pdf->Output('I', 'Factura_Pedido_' . $id_pedido . '.pdf'); // 'I' para mostrar en navegador

// Cerrar conexiones
$stmt_pedido->close();
$stmt_detalles->close();
$conexion->close();
?>