SELECT cor.codigo_barras, cor.destinatario, cor.direccion, com.comunasCol, r.regiones, d.departamento, CONCAT(u.nombre_usuario," ", u.apellido_p, " ", u.apellido_m) as nombre_creador, mov.fecha, mov.hora, e.estado 
FROM movimiento as mov
INNER JOIN correspondencia as cor on cor.codigo_barras = mov.Correspondencia_codigo_barras
INNER JOIN comunas as com on com.idComunas = cor.Comunas_idComunas
INNER JOIN regiones as r on r.idRegiones = com.Regiones_idRegiones
INNER JOIN usuario as u on u.idUsuario = cor.Usuario_idUsuario
INNER JOIN departamento as d on u.tipo_departamento = d.iddepartamento
INNER JOIN estado as e on mov.Estado_idEstado = e.idEstado
WHERE fecha  BETWEEN '$f_desde' AND '$f_hasta'


SELECT encomienda, COUNT(*) FROM correspondencia as cor
INNER JOIN tipo_encomienda as te on cor.Tipo_encomienda_idTipo_encomienda = te.idTipo_encomienda
WHERE encomienda = '$_encomienda'
