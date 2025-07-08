<?php 

/**
 * Modelo Estadisticas  — versión autocontenida
 *
 * ➜ Cada método abre y cierra su propia conexión (como tu diseño original)
 * ➜ Devuelve SIEMPRE dos arrays: [$labels, $data] listos para json_encode
 * ➜ Mantiene los nombres que ya usas en tu controlador:
 *     - unidadesVendidasPorCategoria()
 *     - topProductosVendidos()
 *     - ingresosPorCategoria()
 */
class Estadisticas
{
    /**
     * Crea y abre una conexión nueva.
     */
    private function connect(): Conexion
    {
        $c = new Conexion();
        $c->abrir();
        return $c;
    }

    /**
     * Ejecuta una consulta y devuelve [$labels, $data]
     * @param string  $sql       Consulta SQL
     * @param string  $labelCol  Columna para labels
     * @param string  $dataCol   Columna numérica para datos
     * @param bool    $castInt   true = (int) | false = (float)
     */
    private function getPairs(string $sql, string $labelCol, string $dataCol, bool $castInt = true): array
    {
        $db = $this->connect();
        $db->consulta($sql);
        $res = $db->obtenerResultado();

        $labels = [];
        $data   = [];
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $labels[] = $row[$labelCol];
                $data[]   = $castInt ? (int)$row[$dataCol] : (float)$row[$dataCol];
            }
        }
        $db->cerrar();
        return [$labels, $data];
    }

    /* --------------------------------------------------------------
       MÉTODOS PÚBLICOS
       --------------------------------------------------------------*/

    /** Unidades vendidas por categoría */
    public function unidadesVendidasPorCategoria(): array
    {
        $sql = "SELECT c.nombre AS categoria, SUM(dp.cantidad) AS unidades
                FROM   detalle_pedido dp
                JOIN   productos      p ON dp.id_producto  = p.id
                JOIN   categorias     c ON p.id_categoria = c.id
                GROUP  BY c.nombre
                ORDER  BY unidades DESC";
        return $this->getPairs($sql, 'categoria', 'unidades');
    }

    /** Top‑N productos más vendidos */
    public function topProductosVendidos(int $limite = 10): array
    {
        $sql = sprintf("SELECT p.nombre AS producto, SUM(dp.cantidad) AS unidades
                         FROM   detalle_pedido dp
                         JOIN   productos p ON dp.id_producto = p.id
                         GROUP  BY p.nombre
                         ORDER  BY unidades DESC
                         LIMIT  %d", $limite);
        return $this->getPairs($sql, 'producto', 'unidades');
    }

    /** Ingresos por categoría (COP) */
    public function ingresosPorCategoria(): array
    {
        $sql = "SELECT c.nombre AS categoria, SUM(dp.subtotal) AS ingresos
                FROM   detalle_pedido dp
                JOIN   productos      p ON dp.id_producto  = p.id
                JOIN   categorias     c ON p.id_categoria = c.id
                GROUP  BY c.nombre
                ORDER  BY ingresos DESC";
        return $this->getPairs($sql, 'categoria', 'ingresos', /* castInt? */ false);
    }
}
